@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Acara
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/calendar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name" placeholder="Nama Acara">
            <br>
            <input type="text" class="form-control" name="tempat" placeholder="Tempat">
            <br>
            <input type="date" class="form-control" name="date">
            <br>
            <input type="time" class="form-control" name="waktu" placeholder="Waktu">
            <br>
            <textarea name="description" class="form-control" placeholder="Deskripsi"></textarea>
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
