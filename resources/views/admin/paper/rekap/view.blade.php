<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Rekapitulasi Paper - Admin</title>

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
			                <h5 class="m-0">Rekapitulasi Paper</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('index.rekappaper')}}">Rekap Paper</a></li>
			                    <li class="breadcrumb-item active">Rekapitulasi Paper Kelas {{ $tingkat }}</li>
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
			                        <h3 class="card-title">Rekapitulasi Paper Kelas {{ $tingkat }}</h3>
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
									                  <th style="visibility: hidden;" width="0%">id</th>
									                  <th>NO</th>
									                  <th>Nama</th>
									                  <th>Kelas</th>
									                  <th>Judul</th>
									                  <th>Pembimbing</th>
									                  <th>Status</th>
									                  <th>Tanggal Ujian</th>
									                  <th>Penguji 1</th>
									                  <th>Penguji 2</th>
									                  <th>Nilai</th>
									                  <th>Predikat</th>
									                </tr>
									              </thead>
									              <tbody>
									                @foreach($rekap as $row)
									                <tr>
									                  <td style="visibility: hidden; width: 0px;">{{ $row->p_id }}</td>
									                  <td>{{ $no++ }}</td>
									                  <td>{{ $row->s_nama }}</td>
									                  <td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
									                  <td>{{ $row->judul }}</td>
									                  <td>{{ $row->pembimbing }}</td>
									                  <td>{{ $row->status_paper }}</td>
									                  <td>{{ $row->tgl_ujian }}</td>
									                  <td>{{ $row->penguji1 }}</td>
									                  <td>{{ $row->penguji2 }}</td>
									                  <td>{{ $row->nilai }}</td>
									                  <td>{{ $row->predikat }}</td>
									                </tr>
									                @endforeach
									              </tbody>
									            </table>
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