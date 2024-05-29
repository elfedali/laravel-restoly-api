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
        Schema::create('pings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pingable_id');
            $table->string('pingable_type');
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->string('note')->nullable();
            $table->boolean('is_active');

            $table->index('pingable_id');
            $table->index('pingable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pings');
    }
};
