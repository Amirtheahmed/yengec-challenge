<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Zorunlu alanlar doğrulama testi
     */
    public function testRequiredFields() {
        $this->json('POST', 'api/v1/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                 "message" => "The given data was invalid.",
                 "errors" => [
                     "name" => ["Kullanıcı adı gerekli"],
                     "email" => ["Email adres gerekli"],
                     "password" => ["Şifre gerekli"],
                 ]
             ]);
    }

    /**
     * Geçersiz e-posta değeri testi
     */
    public function testInvalidEmail() {
        $regData = [
            "name" => "AmirAhmed",
            "email" => "amir@gmailcom", //hatali mail adresi
            "password" => "12345"
        ];

        $this->json('POST', 'api/v1/register', $regData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                 "message" => "The given data was invalid.",
                 "errors" => [
                     "email" => ["E-posta alanı geçerli bir e-posta olmalıdır"],
                 ]
             ]);
    }

    /**
     * Eksik ad alanı testi
     */
    public function testNameRequired() {
        $regData = [
            "name" => "",
            "email" => "amir@gmail.com", //hatali mail adresi
            "password" => "12345"
        ];

        $this->json('POST', 'api/v1/register', $regData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                     "message" => "The given data was invalid.",
                     "errors" => [
                         "name" => ["Kullanıcı adı gerekli"],
                     ]
             ]);
    }
}
