<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExchangeRate;
use Carbon\Carbon;

class ExchangeRateSeeder extends Seeder
{
    public function run()
    {
        ExchangeRate::updateOrCreate(
            [
                'base_currency' => 'USD',
                'target_currency' => 'KHR',
                'rate_date' => Carbon::today()->toDateString(),
            ],
            ['rate' => 4100]
        );
    }
}
