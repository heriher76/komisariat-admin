@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Buku
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/ebook/'.$ebook->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input type="text" class="form-control" name="name" placeholder="Nama Proker" value="{{ $ebook->name }}">
            <br>
            <input type="text" class="form-control" name="by" value="{{ $ebook->by }}" placeholder="Penulis">
            <br>
            <select name="category" class="form-control">
              <option value="Resensi" @if($ebook->category == 'Resensi') selected @endif>Resensi</option>
              <option value="Materi Wajib" @if($ebook->category == 'Materi Wajib') selected @endif>Materi Wajib</option>
            </select>
            <br>
            @if($ebook->file != null)
            File Sudah Ada: {{ $ebook->file }}
            @endif
            <br>
            <input type="file" name="file">
            <br>
            <label>Jika Tidak Ingin Mengubah File, Jangan Upload</label>
            <br>
            @if($ebook->thumbnail != null)
            File Sudah Ada: {{ $ebook->thumbnail }}
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
