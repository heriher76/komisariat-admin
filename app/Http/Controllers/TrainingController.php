<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InfoTraining;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = InfoTraining::orderBy('created_at', 'DESC')->get();

        return view('info-training.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('info-training.create');
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

        InfoTraining::create([
          'title' => $input['title'],
          'date_start' => $input['date_start'],
          'date_end' => $input['date_end'],
          'province' => $input['province'],
          'url' => $input['url']
        ]);

        return redirect('/admin/info-training');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training = InfoTraining::where('id', $id)->first();

        return view('info-training.edit', compact('training'));
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

        $training = InfoTraining::where('id', $id)->first();
        $training->update([
          'title' => $input['title'],
          'date_start' => $input['date_start'],
          'date_end' => $input['date_end'],
          'province' => $input['province'],
          'url' => $input['url']
        ]);

        return redirect('/admin/info-training');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InfoTraining::destroy($id);

        return back();
    }
}
