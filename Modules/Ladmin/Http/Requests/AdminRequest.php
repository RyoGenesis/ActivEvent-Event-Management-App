<?php

namespace Modules\Ladmin\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'email' => ['required', Rule::unique(ladmin()->getAdminTable(), 'email'), 'email:rfc,strict,dns'],
            'password' => ['sometimes', 'required', 'confirmed', 'min:6'],
            'roles' => ['required', 'array'],
            'display_name' => ['required', 'max:100'],
            'community_id' => ['required', 'integer', 'exists:communities,id'],
        ];

        if ($this->id) {
            $roles['email'] = ['required', Rule::unique(ladmin()->getAdminTable(), 'email')->ignore($this->id), 'email'];
            $roles['password'] = ['nullable', 'confirmed', 'min:6'];
        }
        
        return $roles;
    }

    public function attributes()
    {
        return [
            'display_name' => 'display name',
            'community_id' => 'associated community',
        ];
    }

    /**
     * Create new admin
     *
     * @return void
     */
    public function adminCreate() {
        
        $admin = ladmin()->admin()->create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'display_name' => $this->display_name,
            'community_id' => $this->community_id,
        ]);

        $admin->roles()->sync($this->roles);

        
        session()->flash('success', $this->username . ' has been created!');

        return redirect()->route('ladmin.admin.index');

    }

    /**
     * Update profile
     *
     * @param [type] $admin
     * @return void
     */
    public function updateAdmin($admin)
    {

        $data = [
            'username' => $this->username,
            'email' => $this->email,
            'display_name' => $this->display_name,
            'community_id' => $this->community_id,
        ];

        if(! is_null($this->password)) {
            $data['password'] = Hash::make($this->password);
        }
        
        $admin->update($data);
        $admin->roles()->sync($this->roles);

        session()->flash('success', 'Admin has been updated successfully!');

        return redirect()->back();

    }
}
