<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $table = 'sale_products';  // If the table name is 'sale_products'
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'discount_type',
        'discount',
        'discount_amount',
        'total',
        'total_amount',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    // Relationship with Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
