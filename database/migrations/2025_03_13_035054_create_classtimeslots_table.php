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
            $table->time('start');
            $table->time('end');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_time_slots');
    }
};
