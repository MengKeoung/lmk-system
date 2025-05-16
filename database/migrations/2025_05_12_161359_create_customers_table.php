<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('customer_code')->unique();
        $table->string('name');
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->text('note')->nullable();
        $table->string('image')->nullable();

        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('modified_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->timestamps();
        $table->softDeletes();
    });
}

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
