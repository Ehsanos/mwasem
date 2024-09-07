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
            $table->foreignId('category_id')->nullable()->constrained('categories','id');
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->string('name')->default('name of Offer');
            $table->date('start')->nullable();
            $table->boolean('is_active')->default(false);
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
