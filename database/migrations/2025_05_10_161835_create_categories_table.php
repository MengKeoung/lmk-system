<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->text('note')->nullable(); 
            $table->unsignedBigInteger('created_by'); 
            $table->unsignedBigInteger('modified_by')->nullable(); 
            $table->unsignedBigInteger('deleted_by')->nullable(); 
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
