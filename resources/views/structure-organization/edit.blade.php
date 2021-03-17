@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Pengurus
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/structure/'.$person->id) }}">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $person->name }}">
            <br>
            <input type="text" class="form-control" name="position" value="{{ $person->position }}" placeholder="Posisi">
            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@stop
