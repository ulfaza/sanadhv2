<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>	Daftar Asesor - Paper</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('paper/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('paper/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('paper/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('paperhome')}}">Home</a>
							</li>
							<li>
								<a href="{{route('index.asesor')}}">Asesor</a>
							</li>
							<li>
								<a href="{{route('view.asesor', $tingkat)}}">Kelas {{ $tingkat }}</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Daftar Asesor Paper Kelas {{ $tingkat }}
								<a style="float: right; margin-left: 10px" href="{{route('import.asesor', $tingkat)}}" class="btn btn-xs btn-success">
									Import Asesor
								</a>
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
					                  <th style="visibility: hidden;" width="0%">id</th>
					                  <th>NO</th>
					                  <th>Kelas</th>
					                  <th>Asesor</th>
					                  <th>Action</th>
					                </tr>
					              </thead>
					              <tbody>
					                @foreach($kelas as $row)
					                <tr>
					                  <td style="visibility: hidden; width: 0px;">{{ $row->k_id }}</td>
					                  <td>{{ $no++ }}</td>
					                  <td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
					                  <td>{{ $row->asesor }}</td>
					                  <td>
										<div class="btn-group">
											<a href="{{route('edit.asesor', $row->k_id)}}" class="btn btn-xs btn-success">
												Edit Asesor
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

			@include('paper/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('paper/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(function () {
			    $("#example1").DataTable({
			      "responsive": false, "lengthChange": false, "autoWidth": false,
			      "buttons": ["excel"]
			    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			});
		</script>
	</body>
</html>
