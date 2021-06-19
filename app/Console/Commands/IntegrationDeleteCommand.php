<?php

namespace App\Console\Commands;

use App\Models\Integration;
use Illuminate\Console\Command;

class IntegrationDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bir entegrasyonu sil';

    /**
     * Bir entegrasyonu silmek için kullanılan konsol komutu
     *
     * @return int
     */
    public function handle()
    {
        if(!Integration::all()->isEmpty()) {
            $integrations = array_column(Integration::all(['marketplace'])->toArray(), 'marketplace');
            $choices = array();
            foreach($integrations as $marketplace){
                array_push($choices, strval($marketplace));
            }
            $choice = $this->choice(
                'Lütfen silmek istediğiniz entegrasyonu seçin: ',
                $choices
            );
            //find integration
            $integration = Integration::where('marketplace', $choice)->first();
            if ($this->confirm('Devam etmek istiyor musunuz?')) {
                Integration::where('id', $integration->id)
                    ->delete();
                $this->info('Entegrasyon başarıyla silindi!');
                return 0;
            }
            $this->error("Entegrasyon silinemedi!");
            return 1;
        }
            $this->error("Kayıtlı entegrasyonlar yok!");
            return 1;
    }
}
