@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Info
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/info-training') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="title" placeholder="Judul Info">
            <br>
            <label>Tanggal Mulai Training</label>
            <input type="date" class="form-control" name="date_start">
            <br>
            <label>Tanggal Selesai Training</label>
            <input type="date" class="form-control" name="date_end">
            <br>
            <input type="text" class="form-control" name="province" placeholder="Provinsi">
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
