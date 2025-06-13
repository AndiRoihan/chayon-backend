<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return ArticleResource::collection(Artikel::all());
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

    public function getByCategory($category)
    {
        $articles = Artikel::where('category', $category)->get();
        return ArticleResource::collection($articles);
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
