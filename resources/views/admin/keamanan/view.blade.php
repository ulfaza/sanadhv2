<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>
			Tanggungan Keamanan Putra {{ $th_lulus }}
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
								Tanggungan Keamanan Putra {{ $th_lulus }}
								<a style="float: right; margin-left: 10px" href="{{route('import.aman', $th_lulus)}}" class="btn btn-xs btn-success">
									Import Tanggungan
								</a>
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
												<th style="visibility: hidden;" width="0%">id</th>
												<th width="15%" >nama</th>
												<th width="10%">kelas</th>
												<th width="10%">status</th>
												<th width="10%">ketuntasan</th>
												<th width="15%">bukti</th>
												<th width="10%">nominal</th>
												<th width="25%">keterangan</th>
												<th width="5%"></th>
											</tr>
										</thead>
										<tbody>
											@foreach($tg_aman as $row)
										    <tr>
												<td style="visibility: hidden; width: 0px;">{{ $row->s_id }}</td>
												<td>{{ $row->s_nama }}</td>
												<td>{{ $row->k_nama }}</td>
												<td>{{ $row->status }}</td>
												<td>{{ $row->tg_aman_pa }}</td>
												<td>
													@if($row->tg_aman_pa!="TUNTAS")
														@if(isset($row->bukti_aman_pa))
															<a href="{{route('bukti.aman', $row->bukti_aman_pa)}}" class="btn btn-xs btn-success">
																Lihat Bukti
															</a>
															<a onclick="return confirm('Apakah anda yakin akan menyetujui bukti?')" href="{{route('acc.aman',[$th_lulus, $row->s_id])}}" class="btn btn-xs btn-success">
																Acc Bukti
															</a>
														@endif
													@endif
												</td>
												<td>@currency($row->nominal_aman_pa)</td>
												<td>{{ $row->ket_aman_pa }}</td>
												<td>
													<div class="btn-group">
														<a href="{{route('edit.aman',[$th_lulus, $row->s_id])}}" class="btn btn-xs btn-success">
															<i class="ace-icon fa fa-pencil bigger-120"></i>
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
		<script>
		  $(function () {
		    $("#example1").DataTable({
		      "responsive": false, "lengthChange": false, "autoWidth": false,
		      "buttons": ["excel"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		  });
		</script>
	</body>
</html>
