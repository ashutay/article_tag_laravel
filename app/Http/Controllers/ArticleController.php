<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $articles = Article::with('tags')->get();

        return response()->json($articles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'array',
            'tags.*' => 'string|max:255'
        ]);

        $article = Article::create([
            'title' => $validateData['title']
        ]);

        if(isset($validateData['tags']))
        {
            $newTags = [];
            foreach ($validateData['tags'] as $tagName)
            {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $newTags[] = $tag->id;
            }

            $article->tags()->attach($newTags);
        }

        return response()->json($article);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with('tags')->findOrFail($id);

        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete($id);

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
