<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course_slug' => $this->course_slug,
            'title' => $this->title,
            'description' => $this->description,
            'course_category' => $this->course_category,
            'image' => $this->image,
            'related_courses' => $this->related_courses,
            'cta_link' => $this->cta_link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'content' => $this->content,
            'num_course' => $this->num_course,
            'duration_hours' => $this->duration_hours,
            'duration_minutes' => $this->duration_minutes,
            'num_video' => $this->num_video,
            'num_quiz,' => $this->num_quiz,
        ];
    }
}