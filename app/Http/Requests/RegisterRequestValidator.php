<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequestValidator extends FormRequest
{


    /**
     * Talep için geçerli olan doğrulama kurallarını alın
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required'
        ];
    }

    /**
     * Verileri doğrulama için hazırlayın (sanitization).
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strip_tags($this->name),
            'email' => strip_tags($this->email),
       ]);
    }

    /**
     * Doğrulama için özel mesaj
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kullanıcı adı gerekli',
            'email.required' => 'Email adres gerekli',
            'email.email' => 'E-posta alanı geçerli bir e-posta olmalıdır',
            'email.unique' => 'E-posta alanı benzersiz olmalıdır',
            'password.required' => 'Şifre gerekli',
        ];
    }
}
