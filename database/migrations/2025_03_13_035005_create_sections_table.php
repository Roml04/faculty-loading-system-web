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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->unsignedTinyInteger('year')->check('year IN (1, 2, 3, 4, 11, 12)');
            $table->unsignedTinyInteger('term')->check("term IN (1, 2)");
            $table->string('level')->check("level IN ('shs', 'ter')");
            $table->foreignId('programs_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
