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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            $table->string('title');
            $table->string('ingredients')->nullable();
            $table->decimal('price');
            $table->boolean('is_disponible');
            $table->boolean('is_vegetarian')->nullable();
            $table->string('picture')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
