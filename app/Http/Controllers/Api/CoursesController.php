<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Tampilkan daftar course, diurutkan hanya berdasarkan updated_at.
     */
    public function index(Request $request)
    {
        // Ambil parameter order, default 'desc'
        $sortOrder = strtolower($request->query('order', 'desc'));
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        // Hanya sorting by updated_at
        $courses = Courses::orderBy('updated_at', $sortOrder)->get();

        return CourseResource::collection($courses);
    }

    /**
     * Tampilkan detail satu course.
     */
    public function show(Courses $course)
    {
        return new CourseResource($course);
    }

    /**
     * Tampilkan detail berdasarkan slug.
     */
    public function findBySlug($slug)
    {
        $course = Courses::where('course_slug', $slug)->firstOrFail();
        return new CourseResource($course);
    }

    /**
     * Tampilkan daftar course per-kategori, diurutkan hanya berdasarkan updated_at.
     */
    public function getByCategory(Request $request, $category)
    {
        $sortOrder = strtolower($request->query('order', 'desc'));
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        // Filter berdasarkan kolom course_category sesuai model
        $courses = Courses::where('course_category', $category)
            ->orderBy('updated_at', $sortOrder)
            ->get();

        return CourseResource::collection($courses);
    }
}