@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Channel
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/yt-channels/'.$channel->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="text" class="form-control" name="title" placeholder="Judul Info" value="{{$channel->title}}">
            <br>
            <input type="text" class="form-control" name="url" placeholder="URL Detail Channel" value="{{$channel->url}}">
            <br>
            @if($channel->thumbnail != null)
            File Sudah Ada: {{ $channel->thumbnail }}
            @endif
            <br>
            <input type="file" name="thumbnail">
            <br>
            <label>Jika Tidak Ingin Mengubah Thumbnail, Jangan Upload</label>
            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@stop
