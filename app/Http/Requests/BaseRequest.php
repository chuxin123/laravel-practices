<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function failedValidation($validator)
    {

    }
}
