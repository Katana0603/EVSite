<a class="header-user-message-notif btn btn-success" data-toggle="modal" data-target="#createThreadModal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>

<br /> 
@section('modals')
<!-- Modal -->
<div class="modal" id="createThreadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Thread</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ Form::open(array('route' => 'forum.thread.store')) }}


				<div class="form-group">

					{{ Form::label('author', 'Author') }}
					<select class="form-control select2" style="width: 100%;" name="author_id">
						@forelse ($authors as $user)
						<option value="{{ $user->id }}">{{ $user->username }}</option>
						@endforeach 
					</select> 

					{{ Form::label('categorie', 'Categorie') }}
					<select class="form-control" style="width: 100%;" name="subcat_id">
						@forelse ($subs as $sub)
						<option value="{{ $sub->id }}">{{ $sub->title }}</option>
						@endforeach 
					</select> 

					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', null, array('class' => 'form-control', 'required' => 'required')) }}

					{{ Form::label('description', 'Description') }}
					<div class="form-group">
						{{ Form::label('content', 'Content') }}
						<textarea id="contentEditor" name="content" rows="10" cols="80"  required>
						</textarea>
					</div>

					<div class="row no-gutters"> 
						{{ Form::label('active', 'Active') }}
						{{ Form::checkbox('active', 'active', true) }}
					</div>
					{{ Form::label('order', 'Order') }}
					{{ Form::number('order','order', array('class' => 'form-control')) }}

				</div>
				{{ Form::submit('Create Subcategorie', array('class' => 'btn btn-success btn-lg btn-block')) }}
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

@append



@section('scripts')
<!-- TinyMCE -->
@include('backend.admin.layout._partial.tinymceScripts')

@endsection