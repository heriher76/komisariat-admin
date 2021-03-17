<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(30).'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;

        Article::create([
          'title' => $input['title'],
          'description' => $input['description'],
          'by' => \Auth::user()->name,
          'tag' => $input['tag'],
          'thumbnail' => $namaThumbnail,
        ]);

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/articlephotos'), $namaThumbnail) : null;

        return redirect('/admin/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id', $id)->first();

        return view('article.edit', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $article = Article::where('id', $id)->first();

        if($request->file('thumbnail') != null) {
          ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
          if (isset($article->thumbnail)) {
              unlink(base_path().'/public/articlephotos/'.$article->thumbnail);
          }
          $article->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'tag' => $input['tag'],
            'thumbnail' => $namaThumbnail
          ]);
          ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/articlephotos'), $namaThumbnail) : null;
        }else{
          $article->update([
            'title' => $input['title'],
            'tag' => $input['tag'],
            'description' => $input['description']
          ]);
        }

        return redirect('/admin/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->first();
        if (isset($article->thumbnail)) {
            unlink(base_path().'/public/articlephotos/'.$article->thumbnail);
        }
        $article->destroy($id);

        return back();
    }
}
