<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatabaseKader;

class DatabaseKaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DatabaseKader::all();

        return view('database-kader.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('database-kader.create');
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

        ($request->file('photo') != null) ? $namaPhoto = url('/photo-profile').'/'.\Str::random(10).'-'.$input['name'].'.'.$request->file('photo')->getClientOriginalExtension() : $namaPhoto = null;

        $user = new DatabaseKader;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);
        $user->komisariat = $request->input('komisariat');
        $user->department = $request->input('department');
        $user->address = $request->input('address');
        $user->hp = $request->input('hp');
        $user->sex = $request->input('sex');
        $user->age = $request->input('age');
        $user->jenjang_training = $request->input('jenjang_training');
        $user->pengalaman_organisasi = $request->input('pengalaman_organisasi');
        $user->linkedin = $request->input('linkedin');
        $user->instagram = $request->input('instagram');
        $user->other_social_media = $request->input('other_social_media');
        $user->year_join = $request->input('year_join');
        $user->angkatan_kuliah = $request->input('angkatan_kuliah');
        $user->photo = $namaPhoto;
        $user->save();

        ($request->file('photo') != null) ? $request->file('photo')->move(base_path().('/public/photo-profile/'), $namaPhoto) : null;

        return redirect('/admin/database-kader');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DatabaseKader::where('id', $id)->first();

        return view('database-kader.edit', compact('user'));
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

        $user = DatabaseKader::where('id', $id)->first();

        if($request->file('photo') != null) {
          ($request->file('photo') != null) ? $namaPhoto = url('/photo-profile').'/'.\Str::random(10).'-'.$input['name'].'.'.$request->file('photo')->getClientOriginalExtension() : $namaPhoto = null;
          if (isset($user->photo)) {
              unlink(base_path().'/public/photo-profile/'.$user->photo);
          }

          $user->update([
            'name' => $request->input('name') ?? $user->name,
            'email' => $request->input('email') ?? $user->email,
            'password' => app('hash')->make($request->input('password')) ?? $user->password,
            'komisariat' => $request->input('komisariat') ?? $user->komisariat,
            'department' => $request->input('department') ?? $user->department,
            'address' => $request->input('address') ?? $user->address,
            'hp' => $request->input('hp') ?? $user->hp,
            'sex' => $request->input('sex') ?? $user->sex,
            'age' => $request->input('age') ?? $user->age,
            'jenjang_training' => $request->input('jenjang_training') ?? $user->jenjang_training,
            'pengalaman_organisasi' => $request->input('pengalaman_organisasi') ?? $user->pengalaman_organisasi,
            'linkedin' => $request->input('linkedin') ?? $user->linkedin,
            'instagram' => $request->input('instagram') ?? $user->instagram,
            'other_social_media' => $request->input('other_social_media') ?? $user->other_social_media,
            'year_join' => $request->input('year_join') ?? $user->year_join,
            'angkatan_kuliah' => $request->input('angkatan_kuliah') ?? $user->angkatan_kuliah,
            'photo' => $namaPhoto ?? $user->photo,
          ]);
          ($request->file('photo') != null) ? $request->file('photo')->move(base_path().('/public/photo-profile'), $namaPhoto) : null;
        }else{
          $user->update([
            'name' => $request->input('name') ?? $user->name,
            'email' => $request->input('email') ?? $user->email,
            'password' => app('hash')->make($request->input('password')) ?? $user->password,
            'komisariat' => $request->input('komisariat') ?? $user->komisariat,
            'department' => $request->input('department') ?? $user->department,
            'address' => $request->input('address') ?? $user->address,
            'hp' => $request->input('hp') ?? $user->hp,
            'sex' => $request->input('sex') ?? $user->sex,
            'age' => $request->input('age') ?? $user->age,
            'jenjang_training' => $request->input('jenjang_training') ?? $user->jenjang_training,
            'pengalaman_organisasi' => $request->input('pengalaman_organisasi') ?? $user->pengalaman_organisasi,
            'linkedin' => $request->input('linkedin') ?? $user->linkedin,
            'instagram' => $request->input('instagram') ?? $user->instagram,
            'other_social_media' => $request->input('other_social_media') ?? $user->other_social_media,
            'year_join' => $request->input('year_join') ?? $user->year_join,
            'angkatan_kuliah' => $request->input('angkatan_kuliah') ?? $user->angkatan_kuliah,
          ]);
        }

        return redirect('/admin/database-kader');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DatabaseKader::where('id', $id)->first();
        $photo = explode('/', $user->photo);

        if (isset($user->photo)) {
            unlink(base_path().'/public/photo-profile/'.end($photo));
        }
        $user->destroy($id);

        return back();
    }
}
