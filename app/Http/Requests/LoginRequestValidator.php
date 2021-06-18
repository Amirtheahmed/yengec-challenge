<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequestValidator extends FormRequest
{

    /**
     * Talep için geçerli olan doğrulama kurallarını alın
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'alpha_num|max:50',
            'email' => 'required|email',
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
            'name.alpha_num' => 'Ad alanı yalnızca alfasayısal değerleri kabul eder',
            'name.max' => 'Ad alanı 50 karakterden uzun olmamalıdır',
            'email.required' => 'Email adres gerekli',
            'email.email' => 'E-posta alanı geçerli bir e-posta olmalıdır',
            'password.required' => 'Şifre gerekli',
        ];
    }
}
