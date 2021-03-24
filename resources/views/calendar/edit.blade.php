@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Acara
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/calendar/'.$event->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input type="text" class="form-control" name="name" placeholder="Nama Proker" value="{{ $event->name }}">
            <br>
            <input type="text" class="form-control" name="tempat" value="{{ $event->tempat }}">
            <br>
            <input type="date" class="form-control" name="date" value="{{ $event->date }}">
            <br>
            <input type="time" class="form-control" name="waktu" placeholder="Waktu" value="{{ $event->waktu }}">
            <br>
            <textarea name="description" class="form-control" placeholder="Deskripsi">{{ $event->description }}</textarea>
            <br>
            @if($event->thumbnail != null)
            File Sudah Ada: {{ $event->thumbnail }}
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
