<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shift_id');
            $table->enum('status', ['paid', 'unpaid', 'partially'])->default('unpaid');
            $table->string('vattin_number')->nullable();
            $table->unsignedInteger('total_quantity')->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('sale_discount', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            // $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

