@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Pengurus
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/structure') }}">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name" placeholder="Nama">
            <br>
            <input type="text" class="form-control" name="position" placeholder="Posisi">
            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@stop
