<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'date' => $this->date,
            'image' => $this->image,
            'content' => $this->content,
            'related_articles' => $this->related_articles,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}