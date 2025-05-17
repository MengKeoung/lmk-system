<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
       protected $fillable = [
        'base_currency',
        'target_currency',
        'rate_date',
        'rate',     
    ];
    protected $dates = ['rate_date', 'created_at', 'updated_at'];
    // In App\Models\ExchangeRate.php

public function baseCurrency()
{
    return $this->belongsTo(Currency::class, 'base_currency');
}

public function targetCurrency()
{
    return $this->belongsTo(Currency::class, 'target_currency');
}

}
