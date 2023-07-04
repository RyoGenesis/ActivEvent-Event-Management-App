<?php

namespace Modules\Ladmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $roles = [
            'username' => ['required', 'max:100'],
            'display_name' => ['required', 'max:100'],
            'password' => ['nullable', 'confirmed', 'min:6']
        ];

        return $roles;
    }

    public function attributes()
    {
        return [
            'display_name' => 'display name',
        ];
    }

    /**
     * Update profile
     *
     * @return void
     */
    public function updateProfile()
    {

        $data = [
            'username' => $this->username,
            'display_name' => $this->display_name,
        ];
        if ($this->has('password')) {
            $data['password'] = Hash::make($this->password);
        }
        auth()->user()->update($data);

        session()->flash('success', 'Profile has been updated!');

        return redirect()->back();
    }
}
