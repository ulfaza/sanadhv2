<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		@foreach($kelas as $k)
		<title>Kelas - {{ $k->tingkat }} {{ $k->k_nama }}</title>
		@endforeach

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('guru/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('guru/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('guru/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('guruhome')}}">Home</a>
							</li>
							<li>
								<a href="#">KH</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								@foreach($th_ajar as $ta)
								Tanggungan<br> {{ $ta->th_ajaran }} {{ $ta->smt }}
								@endforeach <br>
								@foreach($kelas as $k)
								{{ $k->tingkat }} {{ $k->k_nama }}
								@endforeach
							</h4>
						</div><!-- /.page-header -->
			        	<div class="row">
							<div class="col-xs-12">
								{{ csrf_field() }}
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
											<th>NIS</th>
							                <th>Nama Siswa</th>
							                <th></th>
							                <th class="detail-col">Tanggungan</th>
							                <th>Ketuntasan</th>
						                </tr>
									</thead>

									<tbody>
										@foreach($tg_smt as $row)
										<tr>
											<td>{{ $row->nis }}</td>
											<td>{{ $row->s_nama }}</td>
											<td>{{ substr($row->status,0,1) }}</td>
											<td class="center">
												<div class="action-buttons">
													<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
														<i class="ace-icon fa fa-angle-double-down"></i>
														<span class="sr-only">Details</span>
													</a>
												</div>
											</td>

											<td>{{ $row->ketuntasan }}</td>
										</tr>

										<tr class="detail-row">
											<td colspan="8">
												<div class="table-detail">
													<div class="row">
														<div class="col-xs-12 col-sm-3">

															<form action="{{route('edit.ceklist', [$row->tg_id, $k_id])}}" method="post" enctype="multipart/form-data">
											              		{{ csrf_field() }}
											              		<div class="form-group">	
	      															<label for="bp">Tanggungan BP</label>
	      															<input type="text" class="form-control" id="bp" name="bp" value="{{ $row->bp }}" readonly="true">
																</div>
																@if($row->bp=="TUNTAS")
																@else
																<div class="form-group">	
	      															<label for="ket_bp">Keterangan Tanggungan BP</label>
																	<input type="text" class="form-control" id="ket_bp" name="ket_bp" value="{{ $row->ket_bp }}" readonly>
																</div>
																@endif

										              			<div class="form-group">	
	      															<label for="keuangan">Keuangan</label>
																	
																	<input type="text" class="form-control" id="keuangan" name="keuangan" value="{{ $row->keuangan }}" readonly >

																	<!-- <select class="form-control" id="keuangan" name="keuangan">
																		<option>{{ $row->keuangan }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select> -->
																</div>

																<div class="form-group">	
	      															<label for="ket_keu">Keterangan Tanggungan Keuangan</label>
																	<input type="text" class="form-control" id="ket_keu" name="ket_keu" value="{{ $row->ket_keu }}" readonly>
																</div>

																@if($row->keuangan=="TUNTAS")
																@elseif($row->bukti_keu!=NULL)
																	<div class="form-group">
																		<div class="infobox infobox-blue col-sm-9">
																			<div class="infobox-icon">
																				<i class="ace-icon fa fa-comments"></i>
																			</div>

																			<div class="infobox-data">
																				<span class="infobox-data-number">Bukti</span>
																				<div class="infobox-content">Sedang Diverifikasi</div>
																			</div>
																		</div>
																	</div>

																	<div class="form-group">
																		<label for="file_keu">Upload Ulang Bukti Keuangan</label>

																		<div class="col-sm-9">
																			<input type="file" id="file_keu" name="file_keu">
																		</div>
																	</div>
																@else
																	<div class="form-group">
																		<label for="file_keu">Scan Bukti Tuntas Tanggungan Keuangan</label>

																		<div class="col-sm-9">
																			<input type="file" id="file_keu" name="file_keu">
																		</div>
																	</div>
																@endif

																<br>
																<div class="form-group">	
	      															<label for="k_hijau">Kartu Hijau</label>
																	<input type="text" class="form-control" id="k_hijau" name="k_hijau" value="{{ $row->k_hijau }}" readonly="true">
																</div>

																<div class="form-group">	
	      															<label for="ket_k_h">Keterangan Kartu Hijau</label>
																	<input type="text" class="form-control" id="ket_k_h" name="ket_k_h" value="{{ $row->ket_k_h }}" readonly="true">
																</div>

																<!-- <div class="form-group">	
	      															<label for="tg_dzikrul">Dzikrul Ghofilin</label>
	      															<input type="text" class="form-control" id="tg_dzikrul" name="tg_dzikrul" value="{{ $row->tg_dzikrul }}" readonly="true">
																</div> -->

																<div class="form-group">	
	      															<label for="status_paper">Paper</label>
	      															<input type="text" class="form-control" id="status_paper" name="status_paper" value="{{ $row->status_paper }}" readonly="true">
																</div>

																<div class="form-group">	
	      															<label for="kartu_aksi">Kartu Aksi</label>

	      															<!-- <input type="text" class="form-control" id="kartu_aksi" name="kartu_aksi" value="{{ $row->kartu_aksi }}" readonly="true"> -->

																	<select class="form-control" id="kartu_aksi" name="kartu_aksi">
																		<option>{{ $row->kartu_aksi }}</option>
																		<option value="TIDAK PUNYA">TIDAK PUNYA</option>
																		<option value="PUNYA">PUNYA</option>
																	</select>
																</div>

																<!-- <div class="form-group">	
	      															<label for="osis">Tanggungan Osis</label>

																	<select class="form-control" id="osis" name="osis">
																		<option>{{ $row->osis }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>

																<div class="form-group">	
	      															<label for="da">Tanggungan DA</label>

																	<select class="form-control" id="da" name="da">
																		<option>{{ $row->da }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>

																<div class="form-group">	
	      															<label for="pmr">Tanggungan PMR</label>

																	<select class="form-control" id="pmr" name="pmr">
																		<option>{{ $row->pmr }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>
 -->
										              			<button type="submit" class="btn btn-primary">Simpan</button>
												             </form>
														</div>
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div><!-- /.span -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('guru/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('guru/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
			})
		</script>
	</body>
</html>
