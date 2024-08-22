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
            $table->id();
            $table->foreignId('cat_id')->nullable()->constrained('categories','id');
            $table->string('name');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('is_active');
            $table->double('price_before')->nullable();
            $table->double('price_after')->nullable();
            $table->string('quantity')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities','id');

            $table->timestamps();
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
