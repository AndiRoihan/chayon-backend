<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index() {
        return Artikel::all();
    }

    public function show($id) {
        return Artikel::findOrFail($id);
    }

    public function store(Request $request) {
        $artikel = Artikel::create($request->all());
        return response()->json($artikel, 201);
    }

    public function update(Request $request, $id) {
        $artikel = Artikel::findOrFail($id);
        $artikel->update($request->all());
        return response()->json($artikel, 200);
    }

    public function destroy($id) {
        Artikel::destroy($id);
        return response()->json(null, 204);
    }
}
