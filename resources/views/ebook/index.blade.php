@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card shadow col-md-12">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">List Buku</h6>
      </div>
      <div class="card-body">
        <a href="{{ url('admin/ebook/create') }}" class="btn btn-success">Tambah Buku</a>
        <br><br>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Nama File</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ebooks as $key => $ebook)
              <tr>
                <td>{{ $key+1 }}</id>
                <td>{{ $ebook->name }}</td>
                <td>{{ $ebook->by }}</td>
                <td>{{ $ebook->file }}</td>
                <td>{{ $ebook->category }}</td>
                <td>
                  <a href="{{ url('/admin/ebook/'.$ebook->id) }}" class="btn btn-xs btn-primary">Edit</a>
                  <form action="{{ url('/admin/ebook/'.$ebook->id) }}" method="POST">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Yakin Akan Dihapus?');">Hapus</button>
                  </form
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('styles')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@stop
