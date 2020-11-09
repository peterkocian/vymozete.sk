<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequestGeneral extends FormRequest
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
        return [
            'uploads'   => 'required|array|min:1',
            'uploads.*' => 'required|mimes:txt,pdf,doc,docx,jpg,jpeg|max:512',
        ];
    }
}
