<a class="header-user-message-notif" data-toggle="modal" data-target="#issueModal" style="cursor: pointer;"><span class="btn btn-block btn-success fa fa-exclamation"></span></a>


@section('modals')
<!-- Modal -->
<div id="issueModal" class="modal" role="dialog">
	<div class="modal-dialog">

		<form method="POST" action="{{ route('issueList.storeIssue') }}">
			{{ csrf_field() }}
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{  __('template.issueList.modalHeader') }} </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="url">{{__('template.issueList.modalUrl')}}</label>
						<input type="url" class="form-control" name="url" id="url" readonly="true" value="{{ url()->current() }}">
					</div>
					<div class="form-group">
						<label for="description">{{  __('template.issueList.modalDescription')}}</label>
						<input type="description" name="description" class="form-control" id="description" required>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn  btn-block btn-success"><span class="fa fa-save"></span></button>
				</div>
			</div>

		</form> 
	</div>
</div>

@append