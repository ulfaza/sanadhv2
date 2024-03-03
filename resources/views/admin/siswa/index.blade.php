<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Kelas - Admin</title>

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
			                <h5 class="m-0">Daftar Kelas</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('kelas')}}">Kelas</a></li>
			                    <li class="breadcrumb-item active">Siswa</li>
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
			                        	Daftar Siswa
			                        	@foreach($kelas as $k)
										{{ $k->tingkat }} {{ $k->k_nama }}
										@endforeach
									</h3>
			                        <div class="float-right">
										<a href="{{route('import.siswa',$k->k_id)}}" class="btn btn-sm btn-success">
											<i class="fas fa-file-excel"></i> Import Excel
										</a>
										<a href="{{route('insert.siswa',$k->k_id)}}" class="btn btn-sm btn-success">
											<i class="fas fa-plus"></i> Tambah 
										</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												<!-- PAGE CONTENT BEGINS -->
												{{ csrf_field() }}
									            <table id="datatable" class="table  table-bordered table-hover">
									              <thead>
									                <tr>
									                  <th width="5%">NO</th>
									                  <th width="10%">NIS</th>
									                  <th width="10%">NISN</th>
									                  <th width="35%">Nama Siswa</th>
									                  <th width="20%">Status</th>
									                  <th width="15%">Action</th>
									                </tr>
									              </thead>
									              <tbody>
									                @foreach($siswa as $s)
									                <tr>
									                  <td>{{ $no++ }}</td>
									                  <td>{{ $s->nis }}</td>
									                  <td>{{ $s->nisn }}</td>
									                  <td>{{ $s->s_nama }}</td>
									                  <td>{{ $s->status }}</td>
									                  <td>
														<div class="margin">
															<div class="btn-group">
																<a href="{{route('pindah.siswa',$s->s_id)}}" class="btn btn-sm btn-info">Pindah Kelas</a>
															</div>
															<div class="btn-group">
																<a href="{{route('edit.siswa',$s->s_id)}}" class="btn btn-sm btn-success"><i class="ace-icon fas fa-pen bigger-120"></i></a>
															</div>
															<div class="btn-group">
																<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.siswa',[$s->s_id,$s->k_id])}}" class="btn btn-sm btn-danger"><i class="ace-icon fas fa-trash bigger-120"></i></a>
															</div>
														</div>
									                  </td>
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
			$(document).ready(function() {
			    $('#datatable').DataTable();
			} );
		</script>
	</body>
</html>