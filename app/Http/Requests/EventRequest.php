<?php

namespace App\Http\Requests;

use App\Models\Event;
use App\Rules\EventDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //used for updating event date and end registration date
        $id = $this->route('id') ?? null;
        $event = Event::find($id);

        return [
            'name' => 'required|string',
            'community_id' => 'required|integer|exists:communities,id',
            'description' => 'required|string',
            'location' => 'required|string',
            'registration_end' => ['required','date','date_format:Y-m-d\TH:i', new EventDateRule($event)],
            'date' => ['required','date','date_format:Y-m-d\TH:i','after:registration_end' , new EventDateRule($event)],
            'status' => 'sometimes|required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'topic' => 'nullable|string',
            'has_certificate' => 'nullable|boolean',
            'has_comserv' => 'nullable|boolean',
            'has_sat' => 'nullable|boolean',
            'sat_level_id' => 'sometimes|nullable|integer|required_if:has_sat,1|exists:sat_levels,id',
            'speaker' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'additional_form_link' => 'nullable|url',
            'exclusive_major' => 'sometimes|nullable|boolean',
            'exclusive_member' => 'sometimes|nullable|boolean',
            'image' => 'nullable|file|image',
            'price' => 'required|numeric|min:0',
            'max_slot' => 'nullable|integer|min:1',
            'majors' => 'nullable|array|required_if:exclusive_major,1|exists:majors,id',
            'majors.*' => 'required|integer',
            'bgas' => 'nullable|array|required_if:has_sat,1|exists:bgas,id|min:1|max:3',
            'bgas.*' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'event name',
            'community_id' => 'associated community',
            'registration_end' => 'registration end date',
            'category_id' => 'category',
            'has_certificate' => 'provide certificate',
            'has_comserv' => 'provide community service hour',
            'has_sat' => 'provide SAT points',
            'sat_level_id' => 'SAT level',
            'contact_person' => 'contact person',
            'additional_form_link' => 'additional form link',
            'exclusive_major' => 'major exclusive',
            'exclusive_member' => 'community member exclusive',
            'max_slot' => 'maximum slot',
            'bgas' => 'selected BGA',
            'majors' => 'associated majors',
            'date' => 'event date',
        ];
    }
}
