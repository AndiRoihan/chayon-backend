<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            "Digital Marketing",
            "Machine Learning",
            "UI/UX Design", 
            "Melamar Kerja",
            "Lintas Minat",
            "Jenjang Karir"
        ];

        foreach ($categories as $category) {
            // Create 6-9 articles per category
            $articleCount = rand(6, 9);
            
            for ($i = 1; $i <= $articleCount; $i++) {
                $title = "Article $i for $category";
                
                Artikel::create([
                    'slug' => Str::slug($title),
                    'title' => $title,
                    'description' => "Description for $title",
                    'category' => $category,
                    'date' => now(),
                    'image' => "artikel-thumbnails/default.png",
                    'content' => [
                        [
                            'title' => "Section 1",
                            'paragraphs' => "Sample content for $title",
                            'bulletPoints' => "- Point 1\n- Point 2\n- Point 3"
                        ]
                    ],
                    'related_articles' => [
                        [
                            'title' => "Related article 1"
                        ]
                    ]
                ]);
            }
        }
    }
}