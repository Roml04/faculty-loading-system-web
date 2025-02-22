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
        Schema::create('tertiary_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->text('year')->check("year IN ('first_year', 'second_year', 'third_year', 'fourth_year')");
            $table->text('term')->check("term IN ('first_term', 'second_term')");
            $table->foreignId('programs_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tertiary_sections');
    }
};
