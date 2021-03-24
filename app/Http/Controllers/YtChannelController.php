<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\YtChannel;

class YtChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = YtChannel::orderBy('created_at', 'DESC')->get();

        return view('yt-channel.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('yt-channel.create');
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

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['title'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;

        YtChannel::create([
          'title' => $input['title'],
          'url' => $input['url'],
          'thumbnail' => $namaThumbnail
        ]);

        ($request->file('thumbnail') != null) ? $request->file('thumbnail')->move(base_path().('/public/yt-channel-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/yt-channels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = YtChannel::where('id', $id)->first();

        return view('yt-channel.edit', compact('channel'));
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

        $channel = YtChannel::where('id', $id)->first();

        ($request->file('thumbnail') != null) ? $namaThumbnail = \Str::random(5).'-'.$input['title'].'.'.$request->file('thumbnail')->getClientOriginalExtension() : $namaThumbnail = null;
        
        if (!empty($channel->thumbnail) && !empty($request->file('thumbnail'))) {
          unlink(base_path().'/public/yt-channel-thumbnail/'.$channel->thumbnail);
        }

        $channel->update([
          'title' => $input['title'],
          'url' => $input['url'],
          'thumbnail' => $namaThumbnail ?? $channel->thumbnail
        ]);

        ($request->file('thumbnail') != null && !empty($request->file('thumbnail'))) ? $request->file('thumbnail')->move(base_path().('/public/yt-channel-thumbnail'), $namaThumbnail) : null;

        return redirect('/admin/yt-channels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = YtChannel::find($id);

        if (isset($info->thumbnail)) {
            unlink(base_path().'/public/yt-channel-thumbnail/'.$info->thumbnail);
        }

        YtChannel::destroy($id);

        return back();
    }
}
