@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Edit Kader
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/database-kader/'.$user->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $user->name }}">
            <br>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
            <br>
            <input type="password" class="form-control" name="password" placeholder="Kolom Password Ini Dikosongkan, Jika Tidak Ingin Mengubah">
            <br>
            <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{ $user->address }}">
            <br>
            <input type="text" class="form-control" name="hp" placeholder="No HP" value="{{ $user->hp }}">
            <br>
            <input type="text" class="form-control" name="department" placeholder="Jurusan" value="{{ $user->department }}">
            <br>
            <input type="text" class="form-control" name="komisariat" placeholder="Fakultas" value="{{ $user->komisariat }}">
            <br>
            <input type="text" class="form-control" name="sex" placeholder="Jenis Kelamin" value="{{ $user->sex }}">
            <br>
            <input type="number" class="form-control" name="age" placeholder="Umur" value="{{ $user->age }}">
            <br>
            <label>Jenjang Training</label>
            <textarea rows="10" name="jenjang_training" class="form-control my-editor">{!! $user->jenjang_training !!}</textarea>
            <br>
            <label>Pengalaman Organisasi</label>
            <textarea rows="10" name="pengalaman_organisasi" class="form-control my-editor">{!! $user->pengalaman_organisasi !!}</textarea>
            <br>
            <input type="text" class="form-control" name="linkedin" placeholder="Linkedin" value="{{ $user->linkedin }}">
            <br>
            <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{ $user->instagram }}">
            <br>
            <label>Sosial Media Lain</label>
            <textarea rows="10" name="other_social_media" class="form-control my-editor">{!! $user->other_social_media !!}</textarea>
            <br>
            <input type="text" class="form-control" name="year_join" placeholder="Tahun Masuk HMI" value="{{ $user->year_join }}">
            <br>
            <input type="text" class="form-control" name="angkatan_kuliah" placeholder="Angkatan Kuliah" value="{{ $user->angkatan_kuliah }}">
            <br>
            <label>Photo</label>
            <br>
            @if(!empty($user->photo))
            <img src="{{ $user->photo }}" style="height: 100px;">
            @endif
            <label>Upload Photo, Jika Ingin Mengubah</label>
            <input type="file" name="photo">
            <br><br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
@stop

@section('styles')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@stop

@section('scripts')
<script>
  var editor_config = {
    path_absolute : "{{ url('/').'/' }}",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@stop