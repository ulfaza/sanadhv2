<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tahun Ajaran - Admin</title>

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
								Tahun Ajaran
								<small>
									<a style="float: right;" href="{{ route('insert.th_ajar') }}" class="btn btn-xs btn-info">
										Tambah 
									</a>
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
						                  <th>NO</th>
						                  <th>Tahun Ajaran</th>
						                  <th>Semester</th>
						                  <th>Status</th>
						                  <th style="text-align: center">Penguji KH</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                @foreach($th_ajar as $row)
						                <tr>
						                  <td>{{ $no++ }}</td>
						                  <td>{{ $row->th_ajaran }}</td>
						                  <td>{{ $row->smt }}</td>
						                  <td>{{ $row->status }}</td>
						                  <td>
						                  	@foreach($uji as $u)
						                  		@if (($row->th_ajaran == $u->th_ajaran)&&($row->smt == $u->smt))
							                  	<a href="{{route('ujikh',[$u->kh_nama,$row->ta_id])}}" class="btn btn-xs btn-success">
													{{ $u->kh_nama }} 
												</a>
												@endif
											@endforeach
						                  </td>
						                  <td>
											<div class="btn-group">
												<a href="{{route('rekapan',$row->ta_id)}}" class="btn btn-xs btn-success">
													Rekap KH
												</a>

												<a href="{{route('rekap.penguji',$row->ta_id)}}" class="btn btn-xs btn-success">
													Rekap Penguji
												</a>

												<a href="{{route('tanggungan',$row->ta_id)}}" class="btn btn-xs btn-success">
													Rekap Ceklist
												</a>

												<a href="{{route('edit.th_ajar',$row->ta_id)}}" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</a>

												<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.th_ajar',$row->ta_id)}}" class="btn btn-xs btn-danger">
													<i class="ace-icon fa fa-trash bigger-120"></i>
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
