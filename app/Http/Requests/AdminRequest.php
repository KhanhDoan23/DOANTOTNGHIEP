<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'ten' => 'required',
            'dia_chi' => 'required',
            'email' => 'required|email',
            'ten_dang_nhap' => 'required|regex:/^[a-zA-Z0-9]+$/',
            
        ];
    }

    public function messages()
    {
        return [
           
            'ten.required' => 'vui lòng nhập tên quản lý',
            'dia_chi.required' => 'vui lòng nhập email',
            'email.required' => 'vui lòng nhập tên quản lý',
            'email.email' => 'vui lòng nhập đúng định dạng email',
            'ten_dang_nhap.required' => 'vui lòng nhập tên đăng nhập',
            'ten_dang_nhap.regex' => 'tên đăng nhập không được chứa ký tự đặc biệt',      
        ];
    }
}
