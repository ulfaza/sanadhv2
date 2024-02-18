<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@foreach($ujikh as $u)
								Rekapitulasi Kartu Hijau {{ $u->tingkat }} {{ $u->k_nama }} {{ $u->th_ajaran }} {{ $u->smt }} {{ $u->kh_nama }} {{ $u->penguji }}
								@endforeach</title>

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
								@foreach($ujikh as $u)
								Rekapitulasi Kartu Hijau <br> <br>
								{{ $u->tingkat }} {{ $u->k_nama }}	<br>
								{{ $u->th_ajaran }} {{ $u->smt }} <br>
								{{ $u->kh_nama }}
								@endforeach
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
						                  <th>ID</th>
						                  <th>NIS</th>
						                  <th>NISN</th>
						                  <th>Nama Siswa</th>
						                  @foreach($kh as $khs)
						                  <th>
						                  	{{ $khs->aspek1 }}
						                  	<br>
						                  	Max: {{ $khs->max_a1 }}
						                  </th>
						                  <th>
						                  	{{ $khs->aspek2 }}
						                  	<br>
						                  	Max: {{ $khs->max_a2 }}
						                  </th>
						                  <th>
						                  	{{ $khs->aspek3 }}
						                  	<br>
						                  	Max: {{ $khs->max_a3 }}
						                  </th>
						                  <th>
						                  	{{ $khs->aspek4 }}
						                  	<br>
						                  	Max: {{ $khs->max_a4 }}
						                  </th>
						                  @endforeach
						                  <th>Total</th>
						                </tr>
						              </thead>
						              <tbody>
						                @foreach($rekapkh as $row)
						                <tr>
						                  <td>{{ $row->r_id }}</td>
						                  <td>{{ $row->nis }}</td>
						                  <td>{{ $row->nisn }}</td>
						                  <td>{{ $row->s_nama }}</td>
						                  <td>{{ $row->nilai_a1 }}</td>
						                  <td>{{ $row->nilai_a2 }}</td>
						                  <td>{{ $row->nilai_a3 }}</td>
						                  <td>{{ $row->nilai_a4 }}</td>
						                  <td>{{ $row->total }}</td>
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
		<script>
		  $(function () {
		    $("#example1").DataTable({
		      "responsive": false, "lengthChange": false, "autoWidth": false,
		      "buttons": ["excel", "pdf"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		  });
		</script>
	</body>
</html>
