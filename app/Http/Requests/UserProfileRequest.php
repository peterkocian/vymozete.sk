<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
            'password'  => ['nullable','confirmed',new StrongPassword()],
            'email'     => 'nullable|email|unique:users,email,'.$id,
        ];
    }
}
