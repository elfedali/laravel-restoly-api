<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price');
            $table->decimal('price_promo');
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->unsignedBigInteger('promotionable_id');
            $table->string('promotionable_type');

            $table->index('promotionable_id');
            $table->index('promotionable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
