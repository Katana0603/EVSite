    @extends('backend.layout.app')

    @section('title', '| Layout')

    @section('content-header')
    <section class="content-header">
      <h1>
        Editors
        <small>Examples</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Layout Options</li>
        <li class="active">Editors</li>
      </ol>
    </section>
    @endsection


    @section('content')

    <section class="content">
      <div class="row">
        <div class="col-md-12">


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">TinyMCE
                <small>Complex</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                <textarea id="editor2" name="editor2" rows="10" cols="80">
                </textarea>
              </form>
            </div>
          </div>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bootstrap WYSIHTML5
                <small>Simple and fast</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                <textarea class="textarea" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </form>
            </div>
          </div>


        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>

    @endsection


    @section('scripts')

    <!-- TinyMCE -->
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

    <script>
      tinymce.init({
        selector: '#editor2',
        theme: 'modern',
        plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
        ],
        content_css: 'css/content.css',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media fullpage | forecolor backcolor emoticons'
      });

    </script>

    <!-- CK Editor -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('components/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
      $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>


<script>

  $( document ).ready(function() {
    var tag =  document.getElementById("layoutOptions");
    tag.className += " active";
    var tag =  document.getElementById("forms");
    tag.className += " active";
  });
</script>


@endsection