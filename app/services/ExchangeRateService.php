<?php
namespace App\Services;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    protected $apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD'; // example

    public function fetchAndStore()
    {
        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            $data = $response->json();

            $base = $data['base'];
            $date = $data['date']; // usually YYYY-MM-DD
            $rates = $data['rates']; // array like ['EUR' => 0.84, 'GBP' => 0.75]

            foreach ($rates as $targetCurrency => $rate) {
                ExchangeRate::updateOrCreate(
                    [
                        'base_currency' => $base,
                        'target_currency' => $targetCurrency,
                        'rate_date' => $date,
                    ],
                    ['rate' => $rate]
                );
            }
        }
    }
}
