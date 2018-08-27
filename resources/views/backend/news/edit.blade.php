{{-- create.blade.php --}}

@extends('backend.layout.app')


@section('title', '| Edit New News')

@section('content')
<div class="row">
  <div class="col-md-12">

    <h1>Edit {{ $news->title }}</h1>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
    {{ Form::open(array('route' => ['news.update', $news->id])) }}

    <div class="form-group">
      {{ Form::label('user', 'User') }}
      <div class="input-group">
        {{ $news->user->username }}
    </div>
</div>

<div class="form-group">
  {{ Form::label('title', 'Title') }}
  {{ Form::text('title', $news->title, array('class' => 'form-control')) }}

</div>
<div class="form-group">
  {{ Form::label('content', 'Content') }}
  <textarea id="contentEditor" name="content" rows="10" cols="80">
    {{{ $news->content }}}
</textarea>
</div>

{{-- DatePicker --}}
<div class="col-sm-6">
  <div class="form-group">
    <label>Date:</label>

    <input id="datetimepicker" type="text" name="start_datetime" value=" {{ date("d.m.Y H:i:s",strtotime($news->release_time))}}">
    <!-- /.input group -->
</div>
<!-- /.form group -->
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label>Date:</label>

    <input id="datetimepicker2" type="text" name="end_datetime" value="{{ date("d.m.Y H:i:s",strtotime($news->close_time))}}">
    <!-- /.input group -->
</div>
<!-- /.form group -->
</div>


<!-- /.input group -->
<div class="col-md-3  no-gutters">
  {{-- Status --}}
  <div class="form-group">

    {{ Form::label('status', 'Status') }}

    @if (isset($news->status))
    <div class="input-group">
      <input type="checkbox" name="statusCheck" checked />
  </div>
  @else
  <div class="input-group">
    <input type="checkbox" name="statusCheck" >
  </div>
  @endif  

</div>
</div>

<div class="col-md-3 no-gutters">
  {{-- comments --}}
  <div class="form-group">

    {{ Form::label('comments', 'Comments') }}
    @if (isset($news->comments))
    <div class="input-group">
        <input type="checkbox" name="commentsCheck" checked />
    </div>
    @else
    <div class="input-group">
        <input type="checkbox" name="commentsCheck" />
    </div>
    @endif

</div>

</div>
{{-- orderNumber --}}
<div class="form-group">
  {{ Form::label('orderNumber', 'OrderNumber') }}
  <div class="input-group">
    <select name="orderNumber">
        <option value="{{ $news->orderNumber }}">{{ $news->orderNumber }}</option>
        @for ($i = 1; $i <= $news->count()+1; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor               
    </select>
</div>
</div>
<!-- /.form group -->

{{ Form::submit('Update News', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}
</div>
</div>

@endsection

@section('scripts')

<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

<script>

  jQuery.datetimepicker.setLocale('de');

  jQuery('#datetimepicker').datetimepicker({
     i18n:{
        de:{
           months:[
           'Januar','Februar','März','April',
           'Mai','Juni','Juli','August',
           'September','Oktober','November','Dezember',
           ],
           dayOfWeek:[
           "So.", "Mo", "Di", "Mi", 
           "Do", "Fr", "Sa.",
           ]
       }
   },
   step:30,
   weeks:true,
   format:'d.m.Y H:i'
});
</script>


<script>

  jQuery('#datetimepicker2').datetimepicker({
     i18n:{
        de:{
           months:[
           'Januar','Februar','März','April',
           'Mai','Juni','Juli','August',
           'September','Oktober','November','Dezember',
           ],
           dayOfWeek:[
           "So.", "Mo", "Di", "Mi", 
           "Do", "Fr", "Sa.",
           ]
       }
   },
   step:30,
   weeks:true,
   format:'d.m.Y H:i'
});
</script>



<script>
  $(document).ready(function(){
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%',
  });
});
</script>

@include('backend.admin.layout._partial.dateRangePickerScripts')
@endsection