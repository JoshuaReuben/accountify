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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->unique();
            $table->string('course_description');
            $table->string('course_difficulty');
            $table->longText('course_overview');
            $table->string('course_cover_photo');
            $table->string('course_duration');
            $table->date('course_publish_date')->nullable();
            $table->timestamps();

            //Later add badges involved
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
