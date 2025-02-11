<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Exception;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Inertia\Response
     */
    public function index()
    {
        return Inertia::render('IndexArticle', [
            'articlesPaginate' => Article::paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Inertia\Response
     */
    public function create()
    {
        return Inertia::render('CreateArticle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        Article::create($request->validated());

        return response()->json(['redirect' => route('articles')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article  $article
     * @return Inertia\Response
     */
    public function edit(Article $article)
    {
        return Inertia::render('EditArticle', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated();

        $article->fill($request->all());
        $article->save();

        return response()->json(['redirect' => route('articles')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return JsonResource
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete article.'])->setStatusCode(500);
        }
    }
}
