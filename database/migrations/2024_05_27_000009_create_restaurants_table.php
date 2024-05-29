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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('content')->nullable();
            $table->string('excerpt')->nullable();
            $table->boolean('is_published');
            $table->boolean('comment_status')->nullable();
            $table->boolean('ping_status')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->string('phone_3')->nullable();
            $table->boolean('reservation_required')->nullable();
            $table->string('website_url')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
