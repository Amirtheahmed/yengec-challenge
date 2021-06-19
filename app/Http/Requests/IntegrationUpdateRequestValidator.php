<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntegrationUpdateRequestValidator extends FormRequest
{
    /**
     * Talep için geçerli olan doğrulama kurallarını alın
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'marketplace' => '',
            'username' => 'alpha_num',
            'password' => ''
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
                         'marketplace' => strip_tags($this->marketplace),
                         'username' => strip_tags($this->username)
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
            'username.alpha_num' => 'Username alanı yalnızca alfasayısal değerleri kabul eder',
        ];
    }
}
