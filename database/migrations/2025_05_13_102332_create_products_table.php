<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('name');
            $table->unsignedBigInteger('measure_id');
            $table->unsignedBigInteger('category_id');
            $table->decimal('cost', 15, 2)->default(0);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('whole_price', 15, 2)->nullable();
             $table->enum('discount_type', ['percentage', 'fixed'])->nullable();
            $table->decimal('discount', 15, 2)->default(0);
            $table->integer('inventory')->default(0);
            $table->text('note')->nullable();
            $table->boolean('status')->default(true);
            $table->string('image')->nullable();
            $table->integer('low_stock_threshold')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}

