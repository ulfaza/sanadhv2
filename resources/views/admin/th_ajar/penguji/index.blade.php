<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Penguji KH - Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('admin/loadcss')

		
		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('admin/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('admin/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('adminhome')}}">Home</a>
							</li>
							<li>
								<a href="#">KH</a>
							</li>
							<li>
								<a href="{{route('th_ajar')}}">Ujian KH</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Penguji Kartu Hijau
								<a style="float: right; margin-left: 10px" href="{{route('import.penguji',[$ta_id,$id_kh])}}" class="btn btn-xs btn-success">
									Import Penguji
								</a>
								<small>
									@foreach($th_ajar as $ta)
										<h4>{{ $ta->th_ajaran }} &nbsp {{ $ta->smt }}</h4>
									@endforeach
									@foreach($kh as $k)
										<h4>{{ $k->kh_nama }}</h4>
									@endforeach
								</small>
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								{{ csrf_field() }}
								<div class="table-responsive">
						            <table id="datatable" class="table table-bordered table-striped">
						              <thead>
						                <tr>
						                  <th width="20%">Kelas</th>
						                  <th width="30%">Penguji</th>
						                  <th width="20%"></th>
						                </tr>
						              </thead>
						              <tbody>
						                @foreach($ujikh as $row)
						                <tr>
						                  <td>{{ $row->tingkat }} {{ $row->k_nama }} </td>
						                  <td>{{ $row->penguji }} </td>
						                  <td>
											<div class="btn-group">
												<a href="{{ route('edit.ujikh', $row->uji_id) }}" class="btn btn-xs btn-success">
													Edit Penguji
												</a>
												<a href="{{ route('rekap', $row->uji_id) }}" class="btn btn-xs btn-success">
													Rekap KH
												</a>
											</div>
										  </td>
						                </tr>
						                @endforeach
						              </tbody>
						            </table>
					        	</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('admin/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('admin/loadjs')
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#datatable').DataTable();
			} );
		</script>
	</body>
</html>
