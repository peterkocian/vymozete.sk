<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $id = $this->route('user') ?? null;

        return [
            'name'      => 'required|max:255',
            'surname'   => 'required|max:255',
            'password'  => ['confirmed',new StrongPassword()],
            'email'     => ['required','email:dns','unique:users,email,'.$id],
            'roles'     => 'required_without:permissions',
            'permissions' => 'required_without:roles',
            'banned'    => 'nullable|boolean'
        ];
    }
}
