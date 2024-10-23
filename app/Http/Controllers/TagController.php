<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::create([
            'name' => $validatedData['name']
        ]);

        return response()->json($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $tag = Tag::findOrFail($id);

        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $validatedData['name'],
        ]);

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
