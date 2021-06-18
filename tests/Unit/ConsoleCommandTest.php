<?php

namespace Tests\Feature;

use App\Models\Integration;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleCommandTest extends TestCase
{
    use DatabaseMigrations;


    public function testIntegrationRegisteredSuccessfully() {

        $this->artisan('integration:register')
            ->expectsQuestion('Marketplace adı?', 'n11')
            ->expectsQuestion('Marketplace kullanıcı adı?', 'amir')
            ->expectsQuestion('Marketplace şifre?', '1234')
            ->expectsOutput('Entegrasyon başarıyla kaydedildi')
            ->assertExitCode(0);
    }

    /**
     * @throws Exception
     */
    public function testIntegrationDeletedSuccessfully() {

        $testData = [
            'marketplace' => 'n11',
            'username' => 'amir',
            'password' => 1,
            'user_id' => random_int(0, 10)
        ];

        Integration::create(
            $testData
        );

        $this->artisan('integration:delete')
            ->expectsChoice('Lütfen silmek istediğiniz entegrasyonu seçin: ', 'n11',
                            ['n11'])
            ->expectsConfirmation('Devam etmek istiyor musunuz?', 'yes')
            ->expectsOutput('Entegrasyon başarıyla silindi!')
            ->assertExitCode(0);
    }

    /**
     * @throws Exception
     */
    public function testIntegrationUpdatedSuccessfully() {

        $testData = [
            'marketplace' => 'n11',
            'username' => 'amir',
            'password' => 1,
            'user_id' => random_int(0, 10)
        ];

        Integration::create(
            $testData
        );

        $this->artisan('integration:update')
            ->expectsChoice('Lütfen güncellemek istediğiniz entegrasyonu seçin: ', 'n11',
                            ['n11'])
            ->expectsQuestion('Marketplace adı?', 'n11')
            ->expectsQuestion('Marketplace kullanıcı adı?', 'amir')
            ->expectsQuestion('Marketplace şifre?', '1234')
            ->expectsOutput('Entegrasyon başarıyla güncellendi!')
            ->assertExitCode(0);
    }
}
