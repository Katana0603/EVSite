<a class="header-user-message-notif btn btn-success" data-toggle="modal" data-target="#createSubModal" style="cursor: pointer;"><span class="fa fa-plus"></span></a>
<br />

@section('modals')
<!-- Modal -->
<div class="modal" id="createSubModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Subcategorie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ Form::open(array('route' => 'forum.sub.store')) }}


				<div class="form-group">

					{{ Form::label('categorie', 'Categorie') }}
					<select class="form-control" style="width: 100%;" name="cat_id">
						@forelse ($cats as $cat)
						<option value="{{ $cat->id }}">{{ $cat->title }}</option>
						@endforeach 
					</select> 

					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', null, array('class' => 'form-control', 'required' => 'required')) }}

					{{ Form::label('description', 'Description') }}
					{{ Form::text('description', null, array('class' => 'form-control')) }}
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


