<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UserRegisterRequest extends FormRequest
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
        if(Request::method() =='POST'){
            return [
                'name'=>['required','string'],
                'email'=>['required','email','unique:users'],
                'password'=>['required','string','min:8','confirmed'],
                'businessId'=>['required','required'],
                'roleId'=>['prohibited']
            ];
        }

    }
}
