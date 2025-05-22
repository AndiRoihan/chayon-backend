<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        return response()->json(Artikel::all());
    }

    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json(['message' => 'Artikel tidak ditemukan'], 404);
        }

        return response()->json($artikel);
    }
}