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
        Schema::create('class_time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teachers_id')->constrained()->onDelete('cascade');
            $table->foreignId('courses_id')->constrained()->onDelete('cascade');
            $table->foreignId('rooms_id')->constrained()->onDelete('cascade');
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
            // column for storing day of the week with class time start
            // column for storing day of the week with class time end
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_time_slots');
    }
};
