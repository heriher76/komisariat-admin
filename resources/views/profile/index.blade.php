@extends('layouts.app')

@section('contents')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card col-md-12">
      <div class="card-header">
        Profile Pengurus
      </div>
      <div class="card-body">
        <form method="POST" action="{{ url('admin/profile') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <textarea rows="10" name="description" class="form-control my-editor">@if($profile != null) {!! $profile->description !!} @endif</textarea>
            <br>
            <label>Thumbnail</label>
            <br>
            @if(!empty($profile->thumbnail))
            <img src="{{ url('/profile-cakaba/'.$profile->thumbnail) }}" style="height: 200px;" />
            @endif
            <input type="file" class="form-control" name="thumbnail">
            <br>
            <button type="submit" class="btn btn-success">Update</button>
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
