@extends('frontend.layout.app')

@section('title')

@endsection

@section('content')



<div class="col-xs-12 col-12 center">
	<h1>{{ __('template.pm.title') }}</h1><small>{{ __('template.pm.subtitle') }}</small>
</div>

<div class="box">
	<div class="row">
		<div class="col-md-2 left">
			<a class="btn btn-success btn-block" href="{{ route('pm.create.message') }}"><span class="fas fa-plus"></span></a>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-6">
			<input type="text" id="filterBox" placeholder="Search for names..">
		</div>
		<div class="col-md-12">
			<table id="pmTable">
				<thead>
					<tr class="table-header">
						<th id="Subject" class="col-subject">Subject</th>
						<th id="toUser" class="col-toUser">toUser</th>
						<th id="unreadMsg" class="col-unreadMsg">New Messages</th>
						<th id="delete" class="col-deleteButton">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pms as $pm)

					@if ($pm->unreadCount >= 1)
					<tr class="unreadRow clickable-row" data-href="{{ route('pm.open.message',$pm->id) }}">

						<td>{{ $pm->subject }}</td>

						@if (Auth::user()->id == $pm->user1)
						<td>{{ $pm->usr2->username }}</td>
						@else
						<td> {{ $pm->usr1->username }}</td>
						@endif
						<td>{{ $pm->unreadCount }}</td>
						<td><a href="{{ route('pm.delete.message',$pm->id) }}"><i class="fas fa-trash-alt"></i></a></td>
						
					</tr>
					@else
					<tr class="clickable-row" data-href="{{ route('pm.open.message',$pm->id) }}" >
						<td>{{ $pm->subject }}</td>
						@if (Auth::user()->id == $pm->user1)
						<td>{{ $pm->usr2->username }}</td>
						@else
						<td> {{ $pm->usr1->username }}</td>
						@endif
						<td>{{ $pm->unreadCount }}</td>	
						<td>			
							<form action="{{ route('pm.delete.message',$pm->id) }}" method="POST">	
								{{ method_field('DELETE') }}
								{{ csrf_field() }}	
								<button type="submit"><i class="fas fa-trash-alt">
								</i></button>
							</form>
							<td>

							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="clearfix">
		</div>
	</div> 


	@endsection

	@section('scripts')





	<script>
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
			});
		});
	</script>


	<script>

		function filterTable(event) {
			var filter = event.target.value.toUpperCase();
			var rows = document.querySelector("#pmTable tbody").rows;

			for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[0].textContent.toUpperCase();
				var secondCol = rows[i].cells[1].textContent.toUpperCase();
				if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
					rows[i].style.display = "none";
				}      
			}
		}

		document.querySelector('#filterBox').addEventListener('keyup', filterTable, false);


	</script>

	<!-- TinyMCE -->

	<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

	<script>
		tinymce.init({
			selector: '#content',
			theme: 'modern',
			skin: "charcoal",
			plugins: [
			'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
			'save table contextmenu directionality emoticons template paste textcolor giphy youtube'
			],
			content_css: 'css/content.css',
			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image giphy youtube | print preview media | forecolor backcolor emoticons'
		});

	</script>

	@append