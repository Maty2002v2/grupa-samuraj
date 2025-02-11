<?php

namespace Modules\Articles\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Articles\Entities\Article;
use Modules\Articles\Http\Requests\StoreArticleRequest;
use Modules\Articles\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Exception;
use Inertia\Inertia;

class ArticlesController extends Controller
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
     * @param  int  $id
     * @return Inertia\Response
     */
    public function edit(int $id)
    {
        $article = Article::find($id);
        return Inertia::render('EditArticle', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, int $id)
    {
        $article = Article::find($id);
        $request->validated();

        $article->fill($request->all());
        $article->save();

        return response()->json(['redirect' => route('articles')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy(int $id)
    {
        try {
            $article = Article::find($id);
            $article->delete();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete article.'])->setStatusCode(500);
        }
    }
}
