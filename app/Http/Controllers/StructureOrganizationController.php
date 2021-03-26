<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StructureOrganization;

class StructureOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = StructureOrganization::all();

        return view('structure-organization.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('structure-organization.create');
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

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['name'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;

        StructureOrganization::create([
          'name' => $input['name'],
          'position' => $input['position'],
          'thumbnail' => $namaThumbnail
        ]);

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/pengurus-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/structure');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = StructureOrganization::where('id', $id)->first();

        return view('structure-organization.edit', compact('person'));
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

        $person = StructureOrganization::where('id', $id)->first();
        
        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['name'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
        
        if (!empty($request->file('thumbnail')) && !empty($person->thumbnail)) {
          unlink(base_path().'/public/pengurus-thumbnail/'.$ebook->thumbnail);
        }
        
        $person->update([
          'name' => $input['name'],
          'position' => $input['position'],
          'thumbnail' => $namaThumbnail ?? $person->thumbnail
        ]);

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/pengurus-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/structure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = StructureOrganization::where('id', $id)->first();
        
        if (isset($person->thumbnail)) {
            unlink(base_path().'/public/pengurus-thumbnail/'.$person->thumbnail);
        }

        $person->destroy($id);

        return back();
    }
}
