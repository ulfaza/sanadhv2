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
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		
		@include('admin/header')
		@include('admin/sidebar')
		<div class="content-wrapper">
			<div class="content-header">
			    <div class="container-fluid">
			        <div class="row mb-2">
			            <div class="col-sm-6">
			                <h5 class="m-0">Rekapitulasi KH</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Ujian KH</a></li>
			                    <li class="breadcrumb-item active">Rekapitulasi KH</li>
			                </ol>
			            </div>
			            <!-- /.col -->
			        </div>
			        <!-- /.row -->
			    </div>
			    <!-- /.container-fluid -->
			</div>
			<section class="content">
			    <div class="container-fluid">
			        <div class="row">
			            <div class="col-12">
			                <div class="card">
			                    <div class="card-header">
			                        <h3 class="card-title">
			                        	@foreach($ujikh as $u)
										Rekapitulasi Kartu Hijau <br>
										{{ $u->tingkat }} {{ $u->k_nama }}	<br>
										{{ $u->th_ajaran }} {{ $u->smt }} <br>
										{{ $u->kh_nama }}
										@endforeach
			                        </h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
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
											</div>
                                		</div>
                                	</div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		<!-- PAGE CONTENT BEGINS -->
		@yield('content')
		<!-- PAGE CONTENT ENDS -->
		</div>
	</div>
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