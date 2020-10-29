<?php

namespace App\Http\Requests;

use App\Rules\EmailMustHaveTLD;
use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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
    public static function rules()
    {
        $rules = [
            'person_type' => 'required',
            'name' => 'required',
            'surname' => 'required_if:person_type,0',
            'birthday' => 'required_if:person_type,0|date',
            'ico' => 'required_if:person_type,1',
            'vat' => 'string|nullable',
            'street' => 'required',
            'house_number' => 'required',
            'town' => 'required',
            'zip' => 'required',
            'phone' => 'string|nullable',
            'country' => 'required',
            'email' => ['email',new EmailMustHaveTLD,'nullable']
        ];

        //ak ma url path() na konci 'creditor', tak pridaj rules na iban => required
        $parsedURL = explode('/',request()->path())[count(explode('/',request()->path()))-1];
        if ($parsedURL === 'creditor') {
            $rules = array_merge($rules, ['iban' => 'required']);
        }

        return $rules;
    }
}
