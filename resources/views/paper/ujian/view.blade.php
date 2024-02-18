<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>	Ujian - Paper</title>

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
								<a href="{{route('index.ujian')}}">Ujian</a>
							</li>
							<li>
								<a href="{{route('view.ujian', $th_ajaran)}}">{{ $th_ajaran }}</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Daftar Gelombang Ujian Paper Tahun Ajaran {{ $th_ajaran }}
								<a style="float: right;" href="{{ route('insert.gel', $th_ajaran) }}" class="btn btn-xs btn-success">
									Tambah 
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
					                  <th>Gelombang</th>
					                  <th>Tanggal</th>
					                  <th>Status</th>
					                  <th>Action</th>
					                </tr>
					              </thead>
					              <tbody>
					                @foreach($gel as $row)
					                <tr>
					                  <td>{{ $row->gel }}</td>
					                  <td>{{ $row->tgl }}</td>
					                  <td>{{ $row->status_ujian }}</td>
					                  <td>
					                  	<a href="{{route('edit.gel', [$th_ajaran, $row->up_id])}}" class="btn btn-xs btn-success">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</a>
										<a href="{{route('peserta.ujian', [$th_ajaran, $row->tgl])}}" class="btn btn-xs btn-success">
											Peserta
										</a>
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
