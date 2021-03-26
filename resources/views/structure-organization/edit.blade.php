@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Pengurus
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/structure/'.$person->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $person->name }}">
            <br>
            <input type="text" class="form-control" name="position" value="{{ $person->position }}" placeholder="Posisi">
            <br>
            <label>Thumbnail</label>
            <br>
            @if($person->thumbnail != null)
              <img src="{{ url('pengurus-thumbnail/'.$person->thumbnail) }}" height="200px">
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
