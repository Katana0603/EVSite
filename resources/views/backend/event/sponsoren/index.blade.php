{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| Event Sponsors')

@section('content-header')

<section class="content-header">
  <h1>
    Event
    <small>Sponsoren</small>
  </h1>
  <ol class="breadcrumb">
{{--    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li> --}}
</ol>
</section>
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">

    <h3>Sponsoren</h3>
    <div class="row">
      <div class="row">
        <div class="col-md-2">
          <a href="{{ route('eventsponsoren.create') }}" class="btn btn-block btn-success"><span class="fa fa-plus"></span></a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table id="sponsorTable" class="display">
        <thead>
          <tr>
            <th>Name</th>
            <th>Event</th>
            <th>button</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sponsors as $sponsor)
          <tr>    
            <td>{{ $sponsor->name }}</td>
            <td>{{ $sponsor->event->name }}</td>
            <td>
              {{ Form::open(['method' => 'DELETE', 'route' => ['eventsponsoren.destroy', $sponsor->id]]) }}
              <a href="{{ route('eventsponsoren.edit', $sponsor->id) }}" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
              <button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-minus-circle"></span></button>
              {{ Form::close() }}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
  $( document ).ready(function() {
    var tag =  document.getElementById("adminEvent");
    tag.className += " active";
  });
</script>
<script>
  $(document).ready(function() {
    $('#sponsorTable').DataTable( {
      dom: 'Bfrtip',
      lengthMenu: [
      [ 10, 25, 50, -1 ],
      [ '10 rows', '25 rows', '50 rows', 'Show all' ]
      ],
      buttons: [
      'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
      ],
      "order": [[ 0, "asc" ]]
    } );
  } );
</script>
@append


@section('css')

@append