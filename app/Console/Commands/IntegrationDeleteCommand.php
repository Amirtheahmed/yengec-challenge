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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!Integration::all()->isEmpty()) {
            $ints = array_column(Integration::all(['marketplace'])->toArray(), 'marketplace');

            $choices = Array();
            foreach($ints as $intg){
                array_push($choices, strval($intg));
            }

            $choice = $this->choice(
                'Lütfen silmek istediğiniz entegrasyonu seçin: ',
                $choices,
                null,
                $maxAttempts = null,
                $allowMultipleSelections = false
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
        else {
            $this->error("Kayıtlı entegrasyonlar yok!");
            return 1;
        }
    }
}
