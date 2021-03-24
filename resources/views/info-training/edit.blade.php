@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Info
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/info-training/'.$training->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="text" class="form-control" name="title" placeholder="Judul Info" value="{{$training->title}}">
            <br>
            <label>Tanggal Mulai Training</label>
            <input type="date" class="form-control" name="date_start" value="{{$training->date_start}}">
            <br>
            <label>Tanggal Selesai Training</label>
            <input type="date" class="form-control" name="date_end" value="{{$training->date_end}}">
            <br>
            <input type="text" class="form-control" name="province" placeholder="Provinsi" value="{{$training->province}}">
            <br>
            <input type="text" class="form-control" name="url" placeholder="URL Detail Training" value="{{$training->url}}">
            <br>
            @if($training->thumbnail != null)
            File Sudah Ada: {{ $training->thumbnail }}
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
