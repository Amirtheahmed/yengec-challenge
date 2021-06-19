<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Exception;
use Illuminate\Console\Command;

class IntegrationRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bir entegrasyon kaydet';

    /**
     * Bir entegrasyonu kaydetmek için kullanılan konsol komutu
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $input['marketplace'] = $this->ask('Marketplace adı?');
        $input['username'] = $this->ask('Marketplace kullanıcı adı?');
        $input['password'] = $this->secret('Marketplace şifre?');

        $input["user_id"] = random_int(0, 10);

        if(Integration::create($input)) {
            $this->info('Entegrasyon başarıyla kaydedildi');
            return 0;
        }

        $this->error('Entegrasyon başarıyla kaydedilemedi!!');
        return 1;
    }
}
