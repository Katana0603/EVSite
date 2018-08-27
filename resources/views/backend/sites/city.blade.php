{{-- index.blade.php --}}
@extends('backend.layout.app')

@section('title', '| City Page')

@section('content-header')

<section class="content-header">
	<h1>
		City
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
@endsection
@section('content')
{{ Form::open(array('route' => 'admin.pages.citysave')) }}
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('site', 'Site') }}
			<textarea id="contentEditor" name="content" rows="10" cols="80"  required >
			</textarea>
		</div>

	</div>
</div>
{{ Form::submit('Save City Page', array('class' => 'btn btn-success btn-lg btn-block')) }}
{{ Form::close() }}

@endsection

@section('scripts')


<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')


<script>
	$( document ).ready(function() {
		var tag =  document.getElementById("adminNews");
		tag.className += " active";
	});
</script>
<script>
	$(document).ready(function() {
		$('#newsTable').DataTable( {
			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, -1 ],
			[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
			'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
			],
			"order": [[ 2, "desc" ], [3, "desc"]]
		} );
	} );
</script>
@endsection
