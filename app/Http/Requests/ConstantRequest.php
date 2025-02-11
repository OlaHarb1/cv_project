<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ConstantRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (Request::method() == 'POST') {
            return [
                'name' => ['required', 'string'],
                'parentId' => ['required', 'string']
            ];
        } elseif (Request::method() == 'PUT') {
            return [
                'name' => ['string'],
                'parentId' => ['string'],
                'uid' => ['numeric']
            ];
        } elseif (Request::method() == 'GET') {
            return [
                'name' => ['string'],
                'parentId' => ['string'],
            ];
        }
    }

}
