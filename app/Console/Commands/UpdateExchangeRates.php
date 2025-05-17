<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CnbcScraperService;

class UpdateExchangeRates extends Command
{
    protected $signature = 'exchange_rates:update';
    protected $description = 'Fetch and update currency exchange rates';

    public function handle()
    {
        $service = new CnbcScraperService();
        $service->fetchAndStore();

        $this->info('Exchange rates updated successfully!');
    }
}
