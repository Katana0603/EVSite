<!-- quick email widget -->
<div class="box box-info">

	<form action="{{ route('email.send') }}" method="post">
		{{ csrf_field() }}
		<div class="box-header">
			<i class="fa fa-envelope"></i>

			<h3 class="box-title">Quick Email</h3>
			<!-- tools box -->
			<div class="pull-right box-tools">
				<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
				title="Remove">
				<i class="fa fa-times"></i></button>
			</div>
			<!-- /. tools -->
		</div>
		<div class="box-body">
			<div class="form-group">
				<input type="email" class="form-control" name="to" placeholder="To:">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="cc" placeholder="CC:">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="bcc" placeholder="BCC:">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="subject" placeholder="Subject">
			</div>
			<div>
				<textarea id="contentEditor" name="content" rows="10" cols="80"  required >
				</textarea>
			</div>
		</div>
		<div class="box-footer clearfix">
			<button type="submit" class="pull-right btn btn-success" id="sendEmail">Send
				<i class="fa fa-arrow-circle-right"></i></button>
			</div>
		</div>

	</form>

	@section('scripts')
	<!-- TinyMCE -->
	@include('backend.admin.layout._partial.tinymceScripts')


	@append