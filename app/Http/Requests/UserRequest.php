<?php

namespace App\Http\Requests;

use App\Models\Faculty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $id = $this->route('id') ?? (Auth::user() ? Auth::user()->id : null);
        $faculty =  Faculty::find($this->faculty_id);
        $major_ids = $faculty ? $faculty->majors->pluck('id') : [];

        $rules = [
            'name' => 'required|string',
            'email' => ['sometimes', 'required','email', 'ends_with:@binus.ac.id', Rule::unique('users','email')->ignore($id)],
            'phone' => ['sometimes','required', 'digits_between:1,20', Rule::unique('users','phone')->ignore($id)],
            'nim' => ['sometimes', 'required','size:10', 'regex:/^[0-9]+$/', Rule::unique('users','nim')->ignore($id)],
            'email' => ['sometimes', 'nullable','email', Rule::unique('users','personal_email')->ignore($id)],
            'password' => 'sometimes|required|string|min:6',
            'campus_id' => 'required|integer|exists:campuses,id',
            'faculty_id' => 'required|integer|exists:faculties,id',
            'major_id' => ['required','integer','exists:majors,id', Rule::in($major_ids)],
            'topics' => 'sometimes|nullable|string|min:2',
            'communities' => 'nullable|array|exists:communities,id',
            'communities.*' => 'required|integer',
            'categories' => 'sometimes|nullable|array|exists:categories,id',
            'categories.*' => 'required|integer|distinct',
        ];
        
        return $rules;
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
