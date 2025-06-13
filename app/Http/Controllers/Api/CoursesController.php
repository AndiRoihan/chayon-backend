<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        return Courses::all();
    }

    public function store(Request $request)
    {
        $course = Courses::create($request->all());
        return response()->json($course, 201);
    }

    public function show($id)
    {
        return Courses::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $course = Courses::findOrFail($id);
        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy($id)
    {
        Courses::destroy($id);
        return response()->json(null, 204);
    }
}
