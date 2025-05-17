<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $table = 'sale_payments';  // If the table name is 'sale_payments'
    protected $fillable = [
        'sale_id',
        'payment_type_id',
        'total_amount',
        'total_paid',
        'balance',
        'change_amount',
        'note',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    // Relationship with Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relationship with PaymentType
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
