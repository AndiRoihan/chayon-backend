<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'category',
        'description', 
        'cta_link'];

    protected $casts = [
        'content' => 'array',
        'related_articles' => 'array',
        'category' => Category::class
    ];
}
