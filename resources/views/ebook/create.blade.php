@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Buku
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/ebook') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name" placeholder="Judul Buku">
            <br>
            <input type="text" class="form-control" name="by" placeholder="Penulis">
            <br>
            <select name="category" class="form-control">
              <option selected>--Pilih Kategori--</option>
              <option value="Resensi">Resensi</option>
              <option value="Materi Wajib">Materi Wajib</option>
            </select>
            <br>
            <label>File PDF</label>
            <br>
            <input type="file" name="file">
            <br><br>
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
