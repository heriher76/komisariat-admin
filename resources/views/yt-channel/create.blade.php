@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Channel
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/yt-channels') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="title" placeholder="Judul Info">
            <br>
            <input type="text" class="form-control" name="url" placeholder="URL Detail Training">
            <br>
            <label>Thumbnail</label>
            <br>
            <input type="file" name="thumbnail">
            <br><br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@stop
