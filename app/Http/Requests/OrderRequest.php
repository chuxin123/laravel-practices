<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class OrderRequest extends BaseRequest
{
    /**
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $header = $request->header('Openapi-API-Key');
        $orderNo = $request->input('orderNo');
        return 6 == strlen($header) && $header == substr($orderNo, 0, 6);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function messages()
    {
        return [
            'orderNo.required' => '订单号不能为空'
        ];
    }
}
