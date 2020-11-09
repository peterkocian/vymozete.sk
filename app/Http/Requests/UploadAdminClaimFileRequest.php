<?php

namespace App\Http\Requests;

use App\Helpers\FormRequestHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class UploadAdminClaimFileRequest extends FormRequest
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
        $rules = [
            'filename'      => 'required|max:191',
            'file_type_id'  => 'required',
        ];

        $rules = array_merge($rules,UploadFileRequestGeneral::rules());
        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator) //todo
    {
        FormRequestHelper::failedValidation($validator->errors());
    }
}
