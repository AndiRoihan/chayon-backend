<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'slug',
        'title',
        'description',
        'category',
        'date',
        'image',
        'content',
        'related_articles'
    ];

    protected $casts = [
        'content' => 'array',
        'related_articles' => 'array',
        'category' => Category::class
    ];
}
