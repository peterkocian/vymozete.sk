<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileAdminRequest extends FormRequest
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
        return [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
//            'phone'     => 'nullable|regex:/\+[0-9]{12}/',
            'phone'     => 'nullable',
            'password'  => ['nullable','confirmed',new StrongPassword()],
            'email'     => 'nullable|email|unique:users,email,'.Auth::id(),
        ];
    }
}
