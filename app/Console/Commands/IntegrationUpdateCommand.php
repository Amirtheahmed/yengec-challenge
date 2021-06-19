<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Illuminate\Console\Command;

class IntegrationUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bir entegrasyon güncelle';

    /**
     * Bir entegrasyonu güncellemek için kullanılan konsol komutu
     *
     * @return int
     */
    public function handle(): int
    {
        if(!Integration::all()->isEmpty()) {
            $integrations = array_column(Integration::all(['marketplace'])->toArray(), 'marketplace');

            $choices = Array();
            foreach($integrations as $marketplace) {
                array_push($choices, strval($marketplace));
            }

            $choice = $this->choice(
                'Lütfen güncellemek istediğiniz entegrasyonu seçin: ',
                $choices
            );

            //Entegrasyonu bul
            $integration = Integration::where('marketplace', $choice)->first();

            $input['marketplace'] = $this->ask('Marketplace adı?');
            $input['username'] = $this->ask('Marketplace kullanıcı adı?');
            $input['password'] = $this->secret('Marketplace şifre?');

            Integration::where('id', $integration->id)
                        ->update($input);

            $this->info('Entegrasyon başarıyla güncellendi!');
            return 0;
        }

        $this->error("Kayıtlı entegrasyonlar yok!");
        return 1;
    }
}
