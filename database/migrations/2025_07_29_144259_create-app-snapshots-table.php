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
        Schema::create('app_snapshots', function (Blueprint $table) {
            $table->id();
            $table->json('snapshot');
            $table->string('device_id');
            $table->tinyInteger('current_term')->check("level IN (1, 2)");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_snapshots');
    }
};
