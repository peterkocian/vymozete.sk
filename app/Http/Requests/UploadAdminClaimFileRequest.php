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
        return [
            'filename'      => 'required|max:191',
            'file_type_id'  => 'required',
            'uploads'       => 'required|array|min:1',
            'uploads.*'     => 'required|mimes:txt,pdf,doc,docx,jpg,jpeg',
        ];
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
