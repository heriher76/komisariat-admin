<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::first();

        return view('profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $input = $request->all();

        $profile = Profile::first();

        if($profile == null) {
          ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(30).'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
          Profile::create([
            'description' => $input['description'],
            'thumbnail' => $namaThumbnail
          ]);
          ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/profile-cakaba'), $namaThumbnail) : null;

          return back();
        }else{
          if($request->file('thumbnail') != null) {
            ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(30).'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
            if (isset($profile->thumbnail)) {
                unlink(base_path().'/public/profile-cakaba/'.$profile->thumbnail);
            }
            $profile->update([
              'description' => $input['description'],
              'thumbnail' => $namaThumbnail
            ]);
            ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/profile-cakaba'), $namaThumbnail) : null;
          }else{
            $profile->update([
              'description' => $input['description']
            ]);
          }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
