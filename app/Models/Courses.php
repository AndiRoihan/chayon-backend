<?php

namespace App\Models;

use App\Enums\CourseCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_slug',
        'title',
        'description',
        'course_category',
        'image',
        'related_courses',
        'cta_link',
        'content',
        'num_course',
        'duration_hours',
        'duration_minutes',
        'num_video',
        'num_quiz'
    ];

    protected $casts = [
        'content' => 'array',
        'related_courses' => 'array',
        'category' => CourseCategory::class
    ];
}