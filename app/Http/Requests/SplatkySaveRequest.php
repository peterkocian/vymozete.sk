<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SplatkySaveRequest extends FormRequest
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
            'dates'       => 'required|array|min:1',
            'dates.*'     => 'required|date',
            'amounts'     => 'required|array|min:1',
            'amounts.*'   => 'required|numeric',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
//    public function attributes()
//    {
//        return [
//            'dates.*' => __('claim.amount'),
//            'amounts.*' => __('claim.amount'),
//        ];
//    }
}
