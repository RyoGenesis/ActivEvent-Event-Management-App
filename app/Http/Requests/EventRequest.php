<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|string',
            'community_id' => 'required|integer|exists:communities,id',
            'description' => 'required|string',
            'registration_end' => 'required|date|after:tomorrow',
            'date' => 'required|date|after:registration_end',
            'status' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'topic' => 'nullable|string',
            'has_certificate' => 'nullable|boolean',
            'has_comserv' => 'nullable|boolean',
            'has_sat' => 'nullable|boolean',
            'sat_level_id' => 'nullable|integer|exists:sat_levels,id',
            'speaker' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'additional_form_link' => 'nullable|url',
            'exclusive_major' => 'nullable|boolean',
            'exclusive_member' => 'nullable|boolean',
            'image' => 'nullable|file|image',
            'price' => 'required|numeric|min:0',
            'max_slot' => 'nullable|integer|min:1',
            'majors' => 'nullable|array|exists:majors,id',
            'majors.*' => 'required|integer',
            'bgas' => 'nullable|array|exists:bgas,id',
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
            'has_certificate' => 'has certificate',
            'has_comserv' => 'has community service hour',
            'has_sat' => 'has SAT points',
            'sat_level_id' => 'SAT level',
            'contact_person' => 'contact person',
            'additional_form_link' => 'additional form link',
            'exclusive_major' => 'major exclusive',
            'exclusive_member' => 'community member exclusive',
            'max_slot' => 'maximum slot',
            'bgas' => 'selected BGA',
            'majors' => 'associated majors',
        ];
    }
}
