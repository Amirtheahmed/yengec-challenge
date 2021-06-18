<?php

namespace Tests\Unit;

use App\Models\Integration;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IntegrationApiTest extends TestCase
{
    use DatabaseMigrations;


    public function testIntegrationRegisteredSuccessfully() {

        //Test isteğinde bulunmadan önce kullanıcının kimliğini doğrulayın
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            "marketplace" => "Gittigidiyor",
            "username" => "amirgitti",
            "password" => "123456"
        ];

        $this->json('POST', 'api/v1/integration', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                         "status" => true,
                         "integration" => [
                             "marketplace" => "Gittigidiyor",
                             "username" => "amirgitti",
                             "password" => "123456"

                         ]
            ]);
    }

    public function testIntegrationDeletedSuccessfully() {

        //Test isteğinde bulunmadan önce kullanıcının kimliğini doğrulayın
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $integration = Integration::factory()->create();

        $this->json('DELETE', 'api/v1/integration/'.$integration->id, ['Accept' => 'application/json'])
            ->assertStatus(204)
            ->assertNoContent();

        $this->assertDatabaseMissing('integrations', $integration->toArray());
    }

    public function testIntegrationUpdatedSuccessfully() {

        //Test isteğinde bulunmadan önce kullanıcının kimliğini doğrulayın
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $updateData = [
            "marketplace" => "HepsiBurada",
            "username" => "amirgitti2020",
            "password" => "123456",
        ];

        $integration = Integration::factory()->create();

        $this->json('PUT', 'api/v1/integration/'.$integration->id, $updateData, ['Accept' => 'application/json'])
            ->assertStatus(204)
            ->assertNoContent();
    }
}
