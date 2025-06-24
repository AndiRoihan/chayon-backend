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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_slug')->unique()->after('id');
            $table->string('image')->nullable()->after('course_category');
            $table->json('content');
            $table->integer('num_course')->nullable()->after('content');
            $table->integer('duration_hours')->nullable()->after('num_course');
            $table->integer('duration_minutes')->nullable()->after('duration_hours');
            $table->integer('num_video')->nullable()->after('duration_minutes');
            $table->integer('num_quiz')->nullable()->after('num_video');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('course_slug');
            $table->dropColumn('image');
            $table->dropColumn('content');
            $table->dropColumn('num_course');
            $table->dropColumn('duration_hours');
            $table->dropColumn('duration_minutes');
            $table->dropColumn('num_video');
            $table->dropColumn('num_quiz');
        });
    }
};
