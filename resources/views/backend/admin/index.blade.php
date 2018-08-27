{{-- index.blade.php --}}

@extends('backend.layout.app')

@section('title', '| Admin Dashboard')

@section('content-header')

<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
@endsection

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>150</h3>

				<p>New Orders</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>53<sup style="font-size: 20px">%</sup></h3>

				<p>Bounce Rate</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>44</h3>

				<p>User Registrations</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>65</h3>

				<p>Unique Visitors</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-6 connectedSortable">

		@include('backend.admin.partial.todo')

		@include('backend.admin.partial.email')

		<!-- Chat box -->
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-comments-o"></i>

				<h3 class="box-title">Chat</h3>

				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
					<div class="btn-group" data-toggle="btn-toggle">
						<button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
					</div>
				</div>
			</div>
		</div>



	</section>
	<!-- /.Left col -->
	<!-- right col (We are only adding the ID to make the widgets sortable)-->
	<section class="col-lg-6 connectedSortable">

		<!-- Calendar -->
		<div class="box box-solid bg-green-gradient">
			<div class="box-header">
				<i class="fa fa-calendar"></i>

				<h3 class="box-title">Calendar</h3>
				<!-- tools box -->
				<div class="pull-right box-tools">
					<!-- button with a dropdown -->
					<div class="btn-group">
						<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bars"></i></button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><a href="#">Add new event</a></li>
								<li><a href="#">Clear events</a></li>
								<li class="divider"></li>
								<li><a href="#">View calendar</a></li>
							</ul>
						</div>
						<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<!--The calendar -->
					<div id="calendar" style="width: 100%"></div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer text-black">
					<div class="row">
						<div class="col-sm-6">
							<!-- Progress bars -->
							<div class="clearfix">
								<span class="pull-left">Task #1</span>
								<small class="pull-right">90%</small>
							</div>
							<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 90%;"></div>
							</div>

							<div class="clearfix">
								<span class="pull-left">Task #2</span>
								<small class="pull-right">70%</small>
							</div>
							<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 70%;"></div>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-sm-6">
							<div class="clearfix">
								<span class="pull-left">Task #3</span>
								<small class="pull-right">60%</small>
							</div>
							<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 60%;"></div>
							</div>

							<div class="clearfix">
								<span class="pull-left">Task #4</span>
								<small class="pull-right">40%</small>
							</div>
							<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 40%;"></div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<!-- /.box -->

		</section>
		<!-- right col -->
	</div>
	<!-- /.row (main row) -->

	@endsection