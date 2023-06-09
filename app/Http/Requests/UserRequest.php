<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|max:20|unique:users,phone',
            'nim' => 'required|size:10|regex:/^[0-9]+$/|unique:users,nim',
            'password' => 'required|string',
            'campus_id' => 'required|integer|exists:campuses,id',
            'faculty_id' => 'required|integer|exists:faculties,id',
            'major_id' => 'required|integer|exists:majors,id',
            'topics' => 'nullable|array',
            'communities' => 'nullable|array|exists:communities,id',
            'communities.*' => 'required|integer',
            'categories' => 'nullable|array|exists:categories,id',
            'categories.*' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
            'phone' => 'phone number',
            'nim' => 'NIM',
            'campus_id' => 'campus',
            'faculty_id' => 'faculty',
            'major_id' => 'major',
            'categories' => 'preferred categories',
        ];
    }
}
