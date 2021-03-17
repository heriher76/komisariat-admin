@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Tambah Kader
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/database-kader') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name" placeholder="Nama">
            <br>
            <input type="email" class="form-control" name="email" placeholder="Email">
            <br>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <br>
            <input type="text" class="form-control" name="address" placeholder="Alamat">
            <br>
            <input type="text" class="form-control" name="hp" placeholder="No HP">
            <br>
            <input type="text" class="form-control" name="department" placeholder="Jurusan">
            <br>
            <input type="text" class="form-control" name="komisariat" placeholder="Fakultas">
            <br>
            <input type="text" class="form-control" name="sex" placeholder="Jenis Kelamin">
            <br>
            <input type="number" class="form-control" name="age" placeholder="Umur">
            <br>
            <label>Jenjang Training</label>
            <textarea rows="10" name="jenjang_training" class="form-control my-editor"></textarea>
            <br>
            <label>Pengalaman Organisasi</label>
            <textarea rows="10" name="pengalaman_organisasi" class="form-control my-editor"></textarea>
            <br>
            <input type="text" class="form-control" name="linkedin" placeholder="Linkedin">
            <br>
            <input type="text" class="form-control" name="instagram" placeholder="Instagram">
            <br>
            <label>Sosial Media Lain</label>
            <textarea rows="10" name="other_social_media" class="form-control my-editor"></textarea>
            <br>
            <input type="text" class="form-control" name="year_join" placeholder="Tahun Masuk HMI">
            <br>
            <input type="text" class="form-control" name="angkatan_kuliah" placeholder="Angkatan Kuliah">
            <br>
            <label>Photo</label>
            <br>
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
