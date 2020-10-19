<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class FormRequestHelper
{
    public static function failedValidation($errors)
    {
        $response = [
            "success" => false,
            "message" => __("general.The given data was invalid"),
            "errors" => $errors,
        ];

        // Finally throw the HttpResponseException.
        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
