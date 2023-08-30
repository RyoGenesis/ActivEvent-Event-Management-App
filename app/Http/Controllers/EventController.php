<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
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
            $imageName = time().'_'.str_replace(' ', '-',$request->name).'.'.$imageFile->getClientOriginalExtension();
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
        $community = $event->community;
        $majors = !$community->majors->isEmpty() ? Major::whereIn('id', $community->majors->pluck('id')) :  Major::all();
        $categories = Category::all();
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
            $imageName = time().'_'.str_replace(' ', '-',$request->name).'.'.$imageFile->getClientOriginalExtension();
            Storage::putFileAs('public/images/event_images/', $imageFile, $imageName);
            $imageUrl = 'images/event_images/'.$imageName;
            Storage::delete('public/'.$event->image);
            $updateData['image'] = $imageUrl;
        }

        $event->fill($updateData);

        //if date is changed, then send notification
        if($event->isDirty('date') || $event->isDirty('location')) {
            //wip
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

        if($event->status == 'Active') {
            //send notification to participants
        }

        $event->update(['status' => 'Cancelled']);
        Event::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted event!');
    }

    public function search(Request $request){
        $validation = [
            "search"=>'string|max:60',
        ];

        $search = strip_tags($request->search);
        $category = Category::all();
        $events = Event::where('name', 'like', "%".$search."%") //search name
                ->orWhere('topic', 'like', "%".$search."%") //search topic
                ->orWhere('description', 'like', "%".$search."%") //search description
                ->orWhereRelation('category','display_name', 'like', "%".$search."%") //search category name
                ->orWhereHas('community', function (Builder $query) use ($search){ //search community name
                    $query->where('name', 'like', '%'.$search.'%')->orWhere('display_name','like','%'.$search.'%');
                })
                ->get();
        if($request->checkcomserv){
            $sat=$request->checkcomserv;
            $events = Event::where('has_comserv', true)->get();
        }
        return view('search', compact('events', 'search', 'category'));
    }

    function eventdetail($id){
        $event=Event::find($id);
        if(Auth::check()){
            $user_event = $event->users->find(Auth::user()->id);
            if($user_event !== NULL){
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
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];

        $request->validate($validation);
        Event::where('id',$request->id)->update(['is_highlighted' => true]);
        
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

        $participant = User::where('id', $request->id)->first();
        // Mail::to($participant->email)->send(new RejectedParticipationMail($event, $request->reason));
        if($participant->personal_email) {
            // Mail::to($participant->personal_email)->send(new RejectedParticipationMail($event, $request->reason));
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
            ];
        });
    }

    public function latestevent(){
        $latestevents=Event::where('status', 'Active')->orderBy('created_at', 'DESC')->paginate(10);
        return view('latestevent', compact('latestevents'));
    }

    public function featuredevent(){
        $featuredevents=Event::where([['status', 'Active'], ['is_highlighted', true]])->paginate(10);
        return view('featuredevent', compact('featuredevents'));
    }

    public function popularevent(){
        $popularevents=Event::with('community')->withCount('users')
                        ->where('status', 'Active')
                        // ->whereDate('date','>',now())
                        ->orderBy('users_count','DESC')->orderBy('created_at', 'DESC')->paginate(10);
        return view('popularevent', compact('popularevents'));
    }

    public function recommendedevent(){
        // dd('abc');
        $user = User::find(Auth::user()->id);

        $recommendedEvents = Event::with('community')->where('status','Active')->whereDate('date','>',now());

        //get by user communities

        //get by user major

        //get by user category interest

        //get by interest topics
        $topicInterests = explode(',',$user->topics);
        foreach($topicInterests as $interest){
            $recommendedEvents = $recommendedEvents->orWhere('topic', 'like', "%".$interest."%");
        }
        $recommendedEvents = $recommendedEvents->orderBy('created_at', 'DESC')->paginate(10);
        return view('recommendedevent', compact('recommendedEvents', 'topicInterests'));    
    }

    function register(Request $request) {
        $validation = [
            "id"=>'required|integer|exists:events,id,deleted_at,NULL',
        ];
        $event = Event::with(['users','majors','community'])->find($request->id);
        $user = User::with(['events','communities','major'])->find(Auth::user()->id);

        //check eligibility
        if($this->checkEligibility($user, $event)) {
            return redirect()->back()->with('successful', false)->with('error', 'You\'re not eligible to register for this event!');
        }

        //registering to event
        $user->events()->attach($request->id, ['status' => 'Registered']);

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
