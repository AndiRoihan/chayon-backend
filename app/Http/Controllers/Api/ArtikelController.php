<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->query('sort', 'date');
        $sortOrder  = $request->query('order', 'desc');

        if (!in_array($sortColumn, ['date', 'created_at', 'updated_at'])) {
            $sortColumn = 'date';
        }
        if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = Artikel::query()
            ->orderBy($sortColumn, $sortOrder);

        if ($sortColumn !== 'updated_at') {
            $query->orderBy('updated_at', $sortOrder);
        }

        $articles = $query->get();

        return ArticleResource::collection($articles);
    }

    public function show(Artikel $article)
    {
        return new ArticleResource($article);
    }

    public function findBySlug($slug)
    {
        $article = Artikel::where('slug', $slug)->firstOrFail();
        return new ArticleResource($article);
    }

    public function getByCategory(Request $request, $category)
    {
        $sortOrder = $request->query('order', 'desc');
        if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = Artikel::where('category', $category)
            ->orderBy('date', $sortOrder)
            ->orderBy('updated_at', $sortOrder);

        return ArticleResource::collection($query->get());
    }
    // public function update(Request $request, $id) {
    //     $artikel = Artikel::findOrFail($id);
    //     $artikel->update($request->all());
    //     return response()->json($artikel, 200);
    // }

    // public function destroy($id) {
    //     Artikel::destroy($id);
    //     return response()->json(null, 204);
    // }
}
