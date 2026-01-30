<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');// int, auto increment, primary key
            $table->string('name',225);//varchar(225), tên field:name
            $table->text('description')->nullable();// text, tên field: description
            $table->timestamps();// tự động tạo 2 field created_at, updated_at
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
