<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ebook;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = Ebook::all();

        return view('ebook.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ebook.create');
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

        ($request->file('file') != null) ? $namaEbook = \Str::random(5).'-'.$input['name'].'.'.$request->file('file')->getClientOriginalExtension() : $namaEbook = null;

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['name'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;

        Ebook::create([
          'name' => $input['name'],
          'by' => $input['by'],
          'category' => $input['category'],
          'file' => $namaEbook,
          'thumbnail' => $namaThumbnail
        ]);

        ($request->file('file') != null) ? $request->file('file')->move(base_path().('/public/ebooks'), $namaEbook) : null;

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/ebooks-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/ebook');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ebook = Ebook::where('id', $id)->first();

        return view('ebook.edit', compact('ebook'));
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

        $ebook = Ebook::where('id', $id)->first();

        ($request->file('file') != null) ? $namaEbook = \Str::random(5).'-'.$input['name'].'.'.$request->file('file')->getClientOriginalExtension() : $namaEbook = null;

        if (!empty($ebook->file) && !empty($request->file('file'))) {
          unlink(base_path().'/public/ebooks/'.$ebook->file);
        }
        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['name'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
        
        if (!empty($ebook->thumbnail) && !empty($request->file('thumbnail'))) {
          unlink(base_path().'/public/ebooks-thumbnail/'.$ebook->thumbnail);
        }

        $ebook->update([
            'name' => $input['name'],
            'by' => $input['by'],
            'category' => $input['category'],
            'file' => $namaEbook ?? $ebook->file,
            'thumbnail' => $namaThumbnail ?? $ebook->thumbnail
        ]);
        ($request->file('file') != null && !empty($request->file('file'))) ? $request->file('file')->move(base_path().('/public/ebooks'), $namaEbook) : null;

        ($request->file('thumbnail') != null && !empty($request->file('thumbnail'))) ? $request->file('thumbnail')->move(base_path().('/public/ebooks-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/ebook');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ebook = Ebook::where('id', $id)->first();
        if (isset($ebook->file)) {
            unlink(base_path().'/public/ebooks/'.$ebook->file);
        }
        if (isset($ebook->thumbnail)) {
            unlink(base_path().'/public/ebooks-thumbnail/'.$ebook->thumbnail);
        }
        $ebook->destroy($id);

        return back();
    }
}
