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

        Ebook::create([
          'name' => $input['name'],
          'by' => $input['by'],
          'category' => $input['category'],
          'file' => $namaEbook,
        ]);

        ($request->file('file') != null) ? $request->file('file')->move(base_path().('/public/ebooks'), $namaEbook) : null;

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

        if($request->file('file') != null) {
          ($request->file('file') != null) ? $namaEbook = \Str::random(5).'-'.$input['name'].'.'.$request->file('file')->getClientOriginalExtension() : $namaEbook = null;
          if (isset($ebook->file)) {
              unlink(base_path().'/public/ebooks/'.$ebook->file);
          }
          $ebook->update([
            'name' => $input['name'],
            'by' => $input['by'],
            'category' => $input['category'],
            'file' => $namaEbook
          ]);
          ($request->file('file') != null) ? $request->file('file')->move(base_path().('/public/ebooks'), $namaEbook) : null;
        }else{
          $ebook->update([
            'name' => $input['name'],
            'by' => $input['by'],
            'category' => $input['category']
          ]);
        }

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
        $ebook->destroy($id);

        return back();
    }
}
