<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>
			@foreach($th_ajar as $ta)
				Rekap Tanggungan {{ $ta->th_ajaran }} {{ $ta->smt }}
			@endforeach
		</title>

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
			                <h5 class="m-0">@foreach($th_ajar as $ta)
								Rekap Tanggungan <br> {{ $ta->th_ajaran }} {{ $ta->smt }}@endforeach</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Tahun Ajaran</a></li>
			                    <li class="breadcrumb-item active">Rekap Tanggungan</li>
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
			                        	@foreach($th_ajar as $ta)
										Rekap Tanggungan <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
									</h3>
										<div class="float-right">
											<a style="float: right; margin-left: 10px" href="{{route('import.smt.keu', $ta->ta_id)}}" class="btn btn-sm btn-success">Import Excel</a>
										</div>
										@endforeach
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<!-- PAGE CONTENT BEGINS -->
											@yield('content')
											<div class="table-responsive" >
												<table id="example1" class="table  table-bordered table-hover">
													<thead>
														<tr>
															<th style="visibility: hidden; width: 0%;">id</th>
															<th>NO</th>
															<th>NIS</th>
															<th>Nama Siswa</th>
															<th>Kelas</th>
															<th>Status</th>
															<th>BP</th>
															<th>Ket_BP</th>
															<th>Keuangan</th>
															<th>Keterangan</th>
															<th>ACC Keuangan</th>
															<th>KH</th>
															<th>Ket</th>
															<!-- <th>Dzikrul</th> -->
															<th>Paper</th>
															<th>Kartu Aksi</th>
															<!-- <th>Osis</th>
															<th>DA</th>
															<th>PMR</th> -->
															<th>Ketuntasan</th>
														</tr>
													</thead>
													<tbody>
														@foreach($rekaptg as $rt)
													    <tr>
													    	<td style="visibility: hidden; width: 0%;">{{ $rt->s_id }}</td>
															<td>{{ $no++ }}</td>
															<td>{{ $rt->nis }}</td>
															<td>{{ $rt->s_nama }}</td>
															<td>{{ $rt->tingkat }} {{ $rt->k_nama }}</td>
															<td>{{ $rt->status }}</td>
															<td>{{ $rt->bp }}</td>
															<td>{{ $rt->ket_bp }}</td>
															<td>{{ $rt->keuangan }}</td>
															<td>{{ $rt->ket_keu }}</td>
															<td>
																@if($rt->keuangan!="TUNTAS")
																	@if(isset($rt->bukti_keu))
																		<a href="/keuangan/{{$rt->bukti_keu}}" class="btn btn-sm btn-success">
																			Lihat
																		</a>
																		<a onclick="return confirm('Apakah anda yakin akan menyetujui bukti?')" href="{{route('acc.keu',[$rt->ta_id, $rt->s_id])}}" class="btn btn-sm btn-success">
																			ACC
																		</a>
																	@endif
																@endif
															</td>
															<td>{{ $rt->k_hijau }}</td>
															<td>{{ $rt->ket_k_h }}</td>
															<!-- <td>{{ $rt->tg_dzikrul }}</td> -->
															<td>{{ $rt->status_paper }}</td>
															<td>{{ $rt->kartu_aksi }}</td>
															<!-- <td>{{ $rt->osis }}</td>
															<td>{{ $rt->da }}</td>
															<td>{{ $rt->pmr }}</td> -->
															<td>{{ $rt->ketuntasan }}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>							
											<!-- PAGE CONTENT ENDS -->
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