<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tertiary_section_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->text('day_of_week')->
                check("day_of_week IN (
                    'monday', 
                    'tuesday', 
                    'wednesday', 
                    'thursday', 
                    'friday', 
                    'saturday', 
                    'sunday'"
                );
            $table->timestamps();
        });

        DB::statement("ALTER TABLE tertiary_section_class ADD COLUMN time_range TSRANGE NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tertiary_section_class');
    }
};
