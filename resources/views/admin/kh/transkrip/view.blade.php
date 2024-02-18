<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Transkrip KH Kelas {{ $tingkat }}</title>

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
								<a href="{{route('transkrip')}}">Transkrip KH</a>
							</li>
							<li>
								<a href="{{route('transkrip.tingkat', $tingkat)}}">Kelas {{ $tingkat }}</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Transkrip KH Kelas {{ $tingkat }}
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								{{ csrf_field() }}
					            <table id="example1" class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th>NO</th>
					                  <th>Nama</th>
					                  <th>Kelas</th>
					                  <th>Action</th>
					                </tr>
					              </thead>
					              <tbody>
					                @foreach($transkrip as $row)
					                <tr>
					                  <td>{{ $no++ }}</td>
					                  <td>{{ $row->s_nama }}</td>
					                  <td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
					                  <td>
					                  		<div class="btn-group">
												<a href="{{route('rekapan',$row->tingkat)}}" class="btn btn-xs btn-success">
													Lihat
												</a>

												<a href="{{route('rekap.penguji',$row->tingkat)}}" class="btn btn-xs btn-success">
													Download
												</a>
											</div>
					                  </td>
					                </tr>
					                @endforeach
					              </tbody>
					            </table>
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
			$(function () {
			    $("#example1").DataTable({
			      "responsive": false, "lengthChange": false, "autoWidth": false,
			      "buttons": [""]
			    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			});
		</script>
	</body>
</html>
