<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFrontClaimFileRequest extends FormRequest
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
            'filename' => 'required|max:200',
            'file_type_id' => 'required',
            'file' => 'mimes:txt,pdf,doc,docx,jpg,jpeg',
        ];

//        $count = count($this->input('files'))-1;
//        foreach(range(0, $count) as $index) {
//            $rules["files.$index"] = ['mimes:txt,pdf,doc,docx,jpg,jpeg'];
//        }

        return $rules;
    }

//    public function messages()
//    {
//        $messages = [];
//
//        foreach($this->file('files') as $key => $val) {
//            $messages["files.$key.mimes"] = "All files must byt of type: :values";
//        }
//
//        return $messages;
//    }
}
