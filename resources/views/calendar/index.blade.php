@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card shadow col-md-12">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">List Agenda Komisariat</h6>
      </div>
      <div class="card-body">
        <a href="{{ url('admin/calendar/create') }}" class="btn btn-success">Tambah Acara</a>
        <br><br>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($events as $key => $event)
              <tr>
                <td>{{ $key+1 }}</id>
                <td>{{ $event->name }}</td>
                <td>{{ $event->tempat }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->waktu }}</td>
                <td>{{ \Illuminate\Support\Str::limit($event->description, 60, $end='...') }}</td>
                <td>
                  <a href="{{ url('/admin/calendar/'.$event->id) }}" class="btn btn-xs btn-primary">Edit</a>
                  <form action="{{ url('/admin/calendar/'.$event->id) }}" method="POST">
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
