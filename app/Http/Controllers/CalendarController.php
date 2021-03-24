<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Calendar::all();

        return view('calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.create');
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

        Calendar::create([
          'name' => $input['name'],
          'date' => $input['date'],
          'tempat' => $input['tempat'],
          'waktu' => $input['waktu'],
          'description' => $input['description'],
          'thumbnail' => $namaThumbnail
        ]);

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/agenda-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Calendar::where('id', $id)->first();

        return view('calendar.edit', compact('event'));
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

        $event = Calendar::where('id', $id)->first();

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['name'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
        
        if (!empty($event->thumbnail) && !empty($request->file('thumbnail'))) {
          unlink(base_path().'/public/agenda-thumbnail/'.$event->thumbnail);
        }

        $event->update([
          'name' => $input['name'],
          'date' => $input['date'],
          'tempat' => $input['tempat'],
          'waktu' => $input['waktu'],
          'description' => $input['description'],
          'thumbnail' => $namaThumbnail ?? $event->thumbnail
        ]);

        ($request->file('thumbnail') != null && !empty($request->file('thumbnail'))) ? $request->file('thumbnail')->move(base_path().('/public/agenda-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Calendar::find($id);

        if (isset($agenda->thumbnail)) {
            unlink(base_path().'/public/agenda-thumbnail/'.$agenda->thumbnail);
        }

        Calendar::destroy($id);

        return back();
    }
}
