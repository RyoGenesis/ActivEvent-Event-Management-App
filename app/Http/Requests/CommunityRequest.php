<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommunityRequest extends FormRequest
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
            'display_name' => 'required|string',
            'majors' => 'nullable|array|exists:majors,id',
            'majors.*' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'community name',
            'display_name' => 'display name',
        ];
    }
}
