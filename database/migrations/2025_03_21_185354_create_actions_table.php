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
        Schema::create('actions', static function (Blueprint $table) {
            $table->id();
            $table->string('video_command');
            $table->integer('parent_id')->default(null)->nullable();
            $table->timestamps();
        });

        $action = new \App\Models\Action();
        $action->setRawAttributes([
            'video_command' => 'app:check-video-md5'
        ]);
        $action->save();

        $action2 = new \App\Models\Action();
        $action2->setRawAttributes([
            'video_command' => 'app:recognize-videos',
            'parent_id' => $action->getKey(),
        ]);
        $action2->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
