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
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            "success" => false,
            "message" => __("general.The given data was invalid"),
            "errors" => $validator->errors(),
        ];

        // Finally throw the HttpResponseException.
        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}