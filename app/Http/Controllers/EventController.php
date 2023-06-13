<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    function indexList() {
        $events = Event::all();
        return view('admin.event.index', compact(['events']));
    }

    function create() {
        return view('admin.event.create');
    }

    function insert(EventRequest $request) {

        $imageFile = $request->file('image');

        $imageUrl = null;

        if($imageFile) {
            $imageName = time().'_'.$request->name;
            Storage::putFileAs('public/images/event_images/', $imageFile, $imageName);
            $imageUrl = 'images/event_images/'.$imageName;
        }

        $event = Event::create([
            'name' => $request->name,
            'community_id' => $request->community_id,
            'description' => $request->description,
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
            'images' => $imageUrl,
            'price' => $request->price ?? 0,
            'max_slot' => $request->max_slot ?? -1,
        ]);

        if($request->majors) { //if majors array not empty
            $event->majors()->attach($request->majors);
        }

        if($request->bgas) { //if bgas array not empty
            $event->bgas()->attach($request->bgas);
        }

        return view('admin.event.index')->with('success','Successfully added new event!');
    }

    function edit($id) {
        $event = Event::find($id);
        return view('admin.event.edit', compact(['event']));
    }

    function update(EventRequest $request, $id) {

        $event = Event::find($id);
        if(!$event) {
            return Redirect::back()->with('error','Event data not found!');
        }

        $updateData = [
            'name' => $request->name,
            'community_id' => $request->community_id,
            'description' => $request->description,
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
            'price' => $request->price ?? 0,
            'max_slot' => $request->max_slot ?? -1,
        ];

        $imageFile = $request->file('image');

        if($imageFile) {
            $imageName = time().'_'.$request->name;
            Storage::putFileAs('public/images/event_images/', $imageFile, $imageName);
            $imageUrl = 'images/event_images/'.$imageName;
            Storage::delete('public/'.$event->image);
            $updateData['image'] = $imageUrl;
        }

        $event->fill($updateData);

        //if date is changed, then send notification
        if($event->isDirty('date')) {
            //wip
        }

        $event->save();

        //update majors association
        $majors = $request->majors ?? []; //if null then empty array
        $event->majors()->sync($majors);

        //update bga association
        $bgas = $request->bgas ?? []; //if null then empty array
        $event->bgas()->sync($bgas);

        //wip if majors changed and exclusive major is true(?)

        return view('admin.event.index')->with('success','Successfully update event information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:events,id',
        ];

        $request->validate($validation);
        Event::destroy($request->id);

        return view('admin.event.index')->with('success','Successfully deleted event!');
    }
}
