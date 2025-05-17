<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';  // If the table name is 'sales'
    protected $fillable = [
        'sale_code',
        'customer_id',
        'shift_id',
        'status',  // paid, unpaid, partially
        'vattin_number',
        'total_quantity',
        'sub_total',
        'sale_discount',
        'grand_total',
        'note',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    // Relationship with SaleProduct
    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }

    // Relationship with SalePayment
    public function salePayments()
    {
        return $this->hasMany(SalePayment::class);
    }
}
