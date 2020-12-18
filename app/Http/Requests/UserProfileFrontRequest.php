<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileFrontRequest extends FormRequest
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
//        $id = $this->route('user'); //todo vymazat
        $id = Auth::id();

        return [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
            'email'     => 'required|email|unique:users,email,'.$id,
            'phone'     => 'nullable|regex:\+[0-9]{12}',
            'language_id'  => 'required',
        ];
    }
}
