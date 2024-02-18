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
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								@foreach($th_ajar as $ta)
								Rekap Tanggungan <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
								<a style="float: right; margin-left: 10px" href="{{route('import.smt.keu', $ta->ta_id)}}" class="btn btn-xs btn-success">
									Import Excel
								</a>
								@endforeach <br>
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
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
															<a href="/keuangan/{{$rt->bukti_keu}}" class="btn btn-xs btn-success">
																Lihat
															</a>
															<a onclick="return confirm('Apakah anda yakin akan menyetujui bukti?')" href="{{route('acc.keu',[$rt->ta_id, $rt->s_id])}}" class="btn btn-xs btn-success">
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
