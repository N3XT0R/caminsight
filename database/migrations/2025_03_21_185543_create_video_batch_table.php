<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_batch', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id')->on('video')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('action_id');
            $table->foreign('action_id')->references('id')->on('actions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->boolean('is_done')->default(false);
            $table->boolean('is_running')->default(true);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_batch');
    }
};
