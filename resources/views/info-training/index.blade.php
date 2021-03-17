@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card shadow col-md-12">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">List Info Training</h6>
      </div>
      <div class="card-body">
        <a href="{{ url('admin/info-training/create') }}" class="btn btn-success">Tambah Info</a>
        <br><br>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Provinsi</th>
                <th>URL</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($trainings as $key => $training)
              <tr>
                <td>{{ $key+1 }}</id>
                <td>{{ $training->title }}</td>
                <td>{{ $training->date_start }} s/d {{ $training->date_end }}</td>
                <td>{{ $training->province }}</td>
                <td>{{ $training->url }}</td>
                <td>
                  <a href="{{ url('/admin/info-training/'.$training->id) }}" class="btn btn-xs btn-primary">Edit</a>
                  <form action="{{ url('/admin/info-training/'.$training->id) }}" method="POST">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Yakin Akan Dihapus?');">Hapus</button>
                  </form>
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
