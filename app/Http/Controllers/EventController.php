<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Jobs\ApprovalRequestReminder;
use App\Jobs\SendEmailEventCancelled;
use App\Jobs\SendEmailEventChanged;
use App\Mail\RegisterEventMail;
use App\Mail\RejectedParticipationMail;
use App\Models\Bga;
use App\Models\Category;
use App\Models\Community;
use App\Models\Event;
use App\Models\Major;
use App\Models\SatLevel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Ladmin\Datatables\ApprovalDatatables;
use Modules\Ladmin\Datatables\EventDatatables;
use Modules\Ladmin\Datatables\HighlightEventDatatables;
use Modules\Ladmin\Datatables\ParticipantDatatables;
use Modules\Ladmin\Models\Admin;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class EventController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return EventDatatables::renderData();
        }

        return ladmin()->view('event.index');
    }

    function create() {
        $community = Community::with(['majors'])->where('id', auth()->user()->community_id)->first();
        $majors = !$community->majors->isEmpty() ? Major::whereIn('id', $community->majors->pluck('id')) :  Major::all();
        $categories = Category::all();
        $sat_levels = SatLevel::all();
        $bgas = Bga::all();
        return ladmin()->view('event.create', compact(['majors','community','categories','sat_levels','bgas']));
    }

    function insert(EventRequest $request) {
        $imageFile = $request->file('image');

        $imageUrl = null;
        
        if($imageFile) {
            $imageName = time().'_'.str_replace(' ', '-', preg_replace("/[^a-zA-Z0-9() ]/", "", $request->name)).'.'.$imageFile->getClientOriginalExtension();
            Storage::putFileAs('public/images/event_images/', $imageFile, $imageName);
            $imageUrl = 'images/event_images/'.$imageName;
        }

        $event = Event::create([
            'name' => $request->name,
            'community_id' => $request->community_id,
            'description' => $request->description,
            'status' => 'Draft',
            'location' => $request->location,
            'date' => $request->date,
            'registration_end' => $request->registration_end,
            'category_id' => $request->category_id,
            'topic' => $request->topic,
            'has_certificate' => $request->has_certificate ?? false,
            'has_comserv' => $request->has_comserv ?? false,
            'has_sat' => $request->has_sat ?? false,
            'sat_level_id' => $request->sat_level_id,
            'speaker' => $request->speaker,
            'contact_person' => $request->contact_person,
            'additional_form_link' => $request->additional_form_link,
            'exclusive_major' => $request->exclusive_major ?? false,
            'exclusive_member' => $request->exclusive_member ?? false,
            'image' => $imageUrl,
            'price' => $request->price ?? 0,
            'max_slot' => $request->max_slot ?? -1,
        ]);

        if($request->majors) { //if majors array not empty
            $event->majors()->attach($request->majors);
        }

        if($request->bgas) { //if bgas array not empty
            $event->bgas()->attach($request->bgas);
        }

        //send email reminder to all super admin user about waiting approval
        // ApprovalRequestReminder::dispatchSync($event);

        return redirect()->route('ladmin.event.index')->with('success','Successfully added new event!');
    }

    function showView($id) {
        $event = Event::with(['majors','community','category','bgas','sat_level'])->where('id',$id)->first();
        if(!$event) {
            abort(404);
        }
        return ladmin()->view('event.view', compact(['event']));
    }

    function edit($id) {
        $event = Event::with(['majors','community','category','bgas','sat_level'])->where('id',$id)->first();
        if(!$event) {
            return redirect()->route('ladmin.event.index')->with('danger','Event data not found!');
        }
        if(now() > $event->date) { //if already past date cannot edit anymore
            return redirect()->back()->with('danger', 'Not allowed to edit this event anymore because event already happened!');
        }
        $community = $event->community;
        //get majors option based on community and currently selected majors
        $majors = !$community->majors->isEmpty() ? Major::withTrashed()->where( function($q) use ($community) {
                                                        $q->whereNull('deleted_at')->whereIn('id', $community->majors->pluck('id'));
                                                    })->orWhereIn('id', $event->majors->pluck('id'))->get()
                                                :  Major::withTrashed()->whereNull('deleted_at')->orWhereIn('id', $event->majors->pluck('id'))->get();
        $categories = Category::withTrashed()->whereNull('deleted_at')->orWhere('id', $event->category_id)->get();
        $sat_levels = SatLevel::all();
        $bgas = Bga::all();
        $eventBgas = $event->bgas->pluck('id')->toArray();
        $eventMajors = $event->majors->pluck('id')->toArray();
        return ladmin()->view('event.edit', compact(['event','community','majors','categories','sat_levels','bgas','eventBgas','eventMajors']));
    }

    function update(EventRequest $request, $id) {

        $event = Event::find($id);
        if(!$event) {
            return Redirect::back()->with('danger','Event data not found!');
        }
        if(now() > $event->date) { //if already past date cannot update anymore, for safety net
            return redirect()->back()->with('danger', 'Not allowed to update this event anymore because event already happened!');
        }
        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'registration_end' => $request->registration_end,
            'category_id' => $request->category_id,
            'topic' => $request->topic,
            'has_certificate' => $request->has_certificate ?? false,
            'has_comserv' => $request->has_comserv ?? false,
            'has_sat' => $request->has_sat ?? false,
            'sat_level_id' => $request->sat_level_id,
            'speaker' => $request->speaker,
            'contact_person' => $request->contact_person,
            'additional_form_link' => $request->additional_form_link,
            'price' => $request->price ?? 0,
        ];

        //rule to decide whether certain attribute can be changed or not
        //exclusivity trait cannot be changed when already active
        if($event->status == 'Active') { 
            //when set to no max slot, but trying to set a new one after approved or new slot lower than current slot
            if($request->max_slot && ($event->max_slot == -1 || $request->max_slot < $event->max_slot)) {
                return redirect()->back()->withErrors(['max_slot' => 'Can not set maximum slot lower than previous slot when event is already approved']);
            } else {
                $updateData['max_slot'] = $request->max_slot ?? -1;
            }
        } else {
            $updateData['max_slot'] = $request->max_slot ?? -1;
            $updateData['exclusive_major'] = $request->exclusive_major ?? false;
            $updateData['exclusive_member'] = $request->exclusive_member ?? false;
        }

        $imageFile = $request->file('image');
       
        if($imageFile) {
            $imageName = time().'_'.str_replace(' ', '-',preg_replace("/[^a-zA-Z0-9() ]/", "", $request->name)).'.'.$imageFile->getClientOriginalExtension();
            Storage::putFileAs('public/images/event_images/', $imageFile, $imageName);
            $imageUrl = 'images/event_images/'.$imageName;
            Storage::delete('public/'.$event->image);
            $updateData['image'] = $imageUrl;
        }

        $event->fill($updateData);

        //if date is changed, then send notification
        if($event->isDirty('date') || $event->isDirty('location')) {
            SendEmailEventChanged::dispatch($event)->delay(now()->addMinutes(1));
        }

        $event->save();

        if($event->status != 'Active') { // only update when still draft
            //update majors association
            $majors = $request->majors ?? []; //if null then empty array
            $event->majors()->sync($majors);
        }

        //update bga association
        $bgas = $request->bgas ?? []; //if null then empty array
        $event->bgas()->sync($bgas);

        return redirect()->route('ladmin.event.index')->with('success','Successfully update event information!');
    }

    function destroy(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];

        $request->validate($validation);
        $event = Event::where('id',$request->id)->first();
        if(now() > $event->date) { //if already past date cannot cancel the event
            return redirect()->back()->with('danger', 'Not allowed to cancel this event anymore because event already happened!');
        }
        if($event->status == 'Active') {
            //send notification to participants
            SendEmailEventCancelled::dispatch($event);
        }

        $event->update(['status' => 'Cancelled']);
        Event::destroy($request->id);

        return redirect()->back()->with('success','Successfully cancelled the event!');
    }

    public function search(Request $request){
        $validation = [
            "search"=>'nullable|string|max:100',
        ];
        $request->validate($validation);

        $search = strip_tags($request->search);
        $availCategories = Category::all();
        $availCommunities = Community::all();
        $events = Event::with('community')->where('status', 'Active')->whereDate('date','>',now())
                ->filterBy($request)
                ->search($search)
                ->paginate(10)->withQueryString();

        $selectedCategories = null;
        $selectedCommunities = null;

        if($request->categories) {
            $selectedCategories = Category::whereIn('id',$request->categories)->get();
        }

        if($request->communities) {
            $selectedCommunities = Community::whereIn('id',$request->communities)->get();
        }

        return view('search', compact('events', 'search', 'availCommunities', 'availCategories','request','selectedCategories','selectedCommunities'));
    }

    function eventdetail($id){
        $event=Event::find($id);
        if(Auth::check()){
            $user_event = $event->users->find(Auth::user()->id);
            if($user_event !== NULL && $user_event->pivot->status == 'Registered'){
                return view('eventdetail')->with('event', $event)->with('registered', true);
            }
            else{
                return view('eventdetail')->with('event',$event)->with('registered', false);
            }
        }
        else{
            return view('eventdetail')->with('event',$event);
        }
    }

    function approveIndex() {
        if( request()->has('datatables') ) {
            return ApprovalDatatables::renderData();
        }

        return ladmin()->view('event.approval-index');
    }

    function approve(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $request->validate($validation);
        Event::where('id',$request->id)
            ->update(['status' => 'Active']);

        return redirect()->route('ladmin.event.approval.index');
    }

    function highlightIndex() {
        if( request()->has('datatables') ) {
            return HighlightEventDatatables::renderData();
        }

        return ladmin()->view('highlight.index');
    }

    function highlightCreate() {
        $events = Event::with(['community'])
                ->where('is_highlighted',false)->where('status','Active')
                ->whereDate('date','>', now())->get();
        return ladmin()->view('highlight.create', compact(['events']));
    }

    function highlightInsert(Request $request) {
        $validation = [
            "event_id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $request->validate($validation);

        Event::where('id',$request->event_id)->update(['is_highlighted' => true]);
        
        return redirect()->route('ladmin.event.highlight.index')->with('success','Successfully highlight selected event!');
    }

    function highlightRemove(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $request->validate($validation);

        Event::where('id',$request->id)->update(['is_highlighted' => false]);
        
        return redirect()->route('ladmin.event.highlight.index')->with('success','Successfully remove highlight from event!');
    }

    function viewParticipant($id) {
        $event = Event::with(['users'])->where('id',$id)->first();

        if( request()->has('datatables') ) {
            $data['id'] = $id;
            return ParticipantDatatables::renderData($data);
        }

        return ladmin()->view('event.participants', compact('event'));
    }

    function rejectParticipant($id, Request $request) {
        $validation = [
            "id" => 'required|integer|exists:users,id,deleted_at,NULL',
            "reason" => 'required|string',
        ];
        $request->validate($validation);

        $event = Event::with(['users'])->where('id',$id)->first();
        $event->users()->updateExistingPivot($request->id, [
            'status' => 'Rejected',
            'reasoning' => $request->reason,
        ]);

        //Sending notification
        $participant = User::where('id', $request->id)->first();
        Mail::to($participant->email)->send(new RejectedParticipationMail($event, $request->reason));
        if($participant->personal_email) {
            Mail::to($participant->personal_email)->send(new RejectedParticipationMail($event, $request->reason));
        }

        return redirect()->back()->with('success', 'Rejected participant registration');
    }

    function downloadData($id) {
        $event = Event::with(['users' => ['campus','faculty','major']])->where('id',$id)->first();
        $participants = $event->users()->where('status','!=','Rejected')->get();
        $header_style = (new Style())->setFontBold();

        return (new FastExcel($participants))->headerStyle($header_style)->download('Participants Data - '. $event->name .'.xlsx',function ($participant) {
            return [
                'NIM' => $participant->nim,
                'Name' => $participant->name,
                'Email' => $participant->email,
                'Personal Email' => $participant->personal_email ?? '-',
                'Phone' => $participant->phone,
                'Campus' => $participant->campus->name,
                'Faculty' => $participant->faculty->name,
                'Major' => $participant->major->name,
                'Attendance' => '',
            ];
        });
    }

    public function latestevent(){
        $latestevents = Event::with('community')->where('status', 'Active')
                        ->whereDate('date','>',now())
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);
        return view('latestevent', compact('latestevents'));
    }

    public function featuredevent(){
        $featuredevents = Event::with('community')->where([['status', 'Active'], ['is_highlighted', true]])
                        ->whereDate('date','>',now())
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);
        return view('featuredevent', compact('featuredevents'));
    }

    public function popularevent(){
        $popularevents = Event::with('community')->withCount('users')
                        ->where('status', 'Active')
                        ->whereDate('date','>',now())
                        ->orderBy('users_count','DESC')->orderBy('created_at', 'DESC')->paginate(10);
        return view('popularevent', compact('popularevents'));
    }

    public function recommendedevent(){
        $user = User::find(Auth::user()->id);

        $recommendedEvents = Event::with('community')->where('status','Active')->whereDate('date','>',now());

        $recommendedEvents = $this->userBasedEventRecommendation($user, $recommendedEvents);
        $recommendedEvents = $recommendedEvents->orderBy('created_at', 'DESC')->paginate(10);
        return view('recommendedevent', compact('recommendedEvents'));
    }

    private function userBasedEventRecommendation($user, $events) {
        $recommendations = $events->where(function ($q) use ($user) {

            $topicInterests = explode(',',$user->topics);

            //get by user communities
            $q = $q->whereIn('community_id', $user->communities->pluck('id'))
                //get by user major
                ->orWhereHas('majors', function (Builder $qu) use ($user){
                    $qu->where('id', $user->major_id);
                })
                //get by user category interest
                ->orWhereIn('category_id', $user->categories->pluck('id'));
            
            //get by interest topics
            foreach($topicInterests as $interest){
                $q = $q->orWhere('topic', 'like', "%".$interest."%")->orWhere('name', 'like', "%".$interest."%");
            }
        });
        
        return $recommendations;
    }

    function register(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $request->validate($validation);

        $event = Event::with(['users','majors','community'])->find($request->id);
        $user = User::with(['events','communities','major'])->find(Auth::user()->id);

        //check eligibility
        if(!$this->checkEligibility($user, $event)) {
            return redirect()->back()->with('successful', false)->with('error', 'You\'re not eligible to register for this event!');
        }

        //registering to event
        $user_event = $user->events->find($event->id);
        if($user_event != NULL && $user_event->pivot->status == 'Rejected'){ //when registered before but got rejected & want to register again
            $user->events()->updateExistingPivot($request->id, [
                'status' => 'Registered',
            ]);
        }
        else { //if not rejected before then register as new
            $user->events()->attach($request->id, ['status' => 'Registered']);
        }

        // send mail notification about registration success
        Mail::to($user->email)->send(new RegisterEventMail($event, $user->email));
            
        if($user->personal_email) {
            Mail::to($user->personal_email)->send(new RegisterEventMail($event, $user->personal_email));
        }

        //if event has additional form link
        if($event->additional_form_link){
            session()->flash('form_link', true);
        }

        return redirect()->back()->with('successful', true)->with('registered', true);
    }

    function cancelRegistration(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $request->validate($validation);

        $user = User::find(Auth::user()->id);
        //cancel registration
        $user->events()->detach($request->id);

        return redirect()->back()->with('success_cancel', true)->with('registered', false);
    }

    private function checkEligibility(User $student, Event $event) {

        //check register date
        if($event->registration_end->isPast()) {
            return false;
        }

        //check available slot
        if($event->max_slot != -1 && $event->users->count() >= $event->max_slot) {
            return false;
        }
       
        //exclusive member check
        if($event->exclusive_member && !$student->communities->contains($event->community)) {
            return false;
        }
        //exclusive major check
        if($event->exclusive_major && !$event->majors->contains($student->major)) {
            return false;
        }

        return true;
    }
}
