<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CnbcScraperService
{
    public function fetchAndStore()
    {
        $client = new Client();
        $response = $client->get('https://www.acledabank.com.kh/kh/eng/ps_cmforeignexchange');
        $html = (string) $response->getBody();

        $crawler = new Crawler($html);

        // Log all rows for debugging (optional)
        $crawler->filter('table tr')->each(function ($node) {
            Log::info('Row text: ' . $node->text());
        });

        // Filter rows containing 'USD'
        $usdRows = $crawler->filter('table tr')->reduce(function ($node) {
            $text = $node->text();
            return strpos($text, 'USD') !== false;
        });

        if ($usdRows->count() > 0) {
            $usdRow = $usdRows->first();
            $tds = $usdRow->filter('td');

            if ($tds->count() >= 3) {
                $baseCurrency = trim($tds->eq(0)->text());  // Expect: 'USD'
                $buyRateText = trim($tds->eq(1)->text());   // e.g. '4,000'
                $sellRateText = trim($tds->eq(2)->text());  // e.g. '4,014'

                Log::info("Base Currency: {$baseCurrency}, Buy Rate: {$buyRateText}, Sell Rate: {$sellRateText}");

                $buyRateValue = floatval(str_replace(',', '', $buyRateText));
                $sellRateValue = floatval(str_replace(',', '', $sellRateText));
                $date = Carbon::today()->toDateString();

                // Store USD -> KHR (using sell rate)
                ExchangeRate::updateOrCreate(
                    [
                        'base_currency' => 'USD',
                        'target_currency' => 'KHR',
                        'rate_date' => $date,
                    ],
                    ['rate' => $sellRateValue]
                );

                // Calculate and store KHR -> USD (using reciprocal of buy rate)
                $khrToUsdRate = 1 / $buyRateValue;

                ExchangeRate::updateOrCreate(
                    [
                        'base_currency' => 'KHR',
                        'target_currency' => 'USD',
                        'rate_date' => $date,
                    ],
                    ['rate' => $khrToUsdRate]
                );

                Log::info("USD to KHR exchange rate updated to {$sellRateValue} on {$date}");
                Log::info("KHR to USD exchange rate updated to {$khrToUsdRate} on {$date}");
            } else {
                Log::warning('USD row does not have enough <td> cells.');
            }
        } else {
            Log::warning('No USD row found.');
        }
    }
}
