@extends('backend.layout.app')

@section('title', '| Layout')

@section('content-header')
@endsection


@section('content')
<section class="content">

  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <!-- jQuery Knob -->
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">jQuery Knob</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="30" data-width="90" data-height="90" data-fgColor="#3c8dbc">

              <div class="knob-label">New Visitors</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="70" data-width="90" data-height="90" data-fgColor="#f56954">

              <div class="knob-label">Bounce Rate</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="-80" data-min="-150" data-max="150" data-width="90" data-height="90" data-fgColor="#00a65a">

              <div class="knob-label">Server Load</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="40" data-width="90" data-height="90" data-fgColor="#00c0ef">

              <div class="knob-label">Disk Space</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-xs-6 text-center">
              <input type="text" class="knob" value="90" data-width="90" data-height="90" data-fgColor="#932ab6">

              <div class="knob-label">Bandwidth</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 text-center">
              <input type="text" class="knob" value="50" data-width="90" data-height="90" data-fgColor="#39CCCC">

              <div class="knob-label">CPU</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">jQuery Knob Different Sizes</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="30" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label">data-width="90"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="30" data-width="120" data-height="120" data-fgColor="#f56954">

              <div class="knob-label">data-width="120"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="30" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a">

              <div class="knob-label">data-thickness="0.1"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" value="30" data-width="120" data-height="120" data-fgColor="#00c0ef">

              <div class="knob-label">data-angleArc="250"</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-bar-chart-o"></i>

          <h3 class="box-title">jQuery Knob Tron Style</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="80" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

              <div class="knob-label">data-width="90"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="60" data-skin="tron" data-thickness="0.2" data-width="120" data-height="120" data-fgColor="#f56954">

              <div class="knob-label">data-width="120"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="10" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a">

              <div class="knob-label">data-thickness="0.1"</div>
            </div>
            <!-- ./col -->
            <div class="col-xs-6 col-md-3 text-center">
              <input type="text" class="knob" value="100" data-skin="tron" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" data-width="120" data-height="120" data-fgColor="#00c0ef">

              <div class="knob-label">data-angleArc="250"</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
@endsection

@section('scripts')

<script>
  $( document ).ready(function() {
    var tag =  document.getElementById("layoutOptions");
    tag.className += " active";
    var tag2 =  document.getElementById("charts");
    tag2.className += " active";
  });
</script>

<!-- jQuery Knob -->
<script src="{{ asset('components/jquery-knob/js/jquery.knob.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>

@append