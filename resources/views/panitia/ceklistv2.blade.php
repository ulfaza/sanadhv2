<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@foreach($th_ajar as $ta)
				Tanggungan {{ $ta->th_ajaran }} {{ $ta->smt }}
				@endforeach 
		</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('panitia/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('panitia/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('panitia/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('panitiahome')}}">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								@foreach($th_ajar as $ta)
								Tanggungan<br> {{ $ta->th_ajaran }} {{ $ta->smt }}
								@endforeach 
								<input style="float: right; margin-left: 10px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
							</h4>
						</div><!-- /.page-header -->
			        	<div class="row">
							<div class="col-xs-12">
								{{ csrf_field() }}
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
											<th>Kelas</th>
							                <th>Nama Siswa</th>
							                <th class="detail-col">Tanggungan</th>
							                <th>Ketuntasan</th>
						                </tr>
									</thead>

									<tbody>
										@foreach($tg_smt as $row)
										<tr>
											<td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
											<td>{{ $row->s_nama }}</td>
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

															<form action="{{route('ceklist.update', $row->tg_id)}}" method="post" enctype="multipart/form-data">
											              		{{ csrf_field() }}
										              			<div class="form-group">	
	      															<label for="keuangan">Keuangan</label>
																	
																	<input type="text" class="form-control" id="keuangan" name="keuangan" value="{{ $row->keuangan }}" readonly="true">
																</div>

																<div class="form-group">	
	      															<label for="ket_keu">Keterangan Tanggungan Keuangan</label>
																	<input type="text" class="form-control" id="ket_keu" name="ket_keu" value="@currency($row->ket_keu)" readonly="true">
																</div>

																<div class="form-group">	
	      															<label for="k_hijau">Kartu Hijau</label>
																	<input type="text" class="form-control" id="k_hijau" name="k_hijau" value="{{ $row->k_hijau }}" readonly="true">
																</div>

																<div class="form-group">	
	      															<label for="ket_k_h">Keterangan Kartu Hijau</label>
																	<input type="text" class="form-control" id="ket_k_h" name="ket_k_h" value="{{ $row->ket_k_h }}" readonly="true">
																</div>

																@if($row->paper =='BELUM' or $row->paper =='TUNTAS')
																<div class="form-group">	
	      															<label for="paper">Paper</label>
	      															<input type="text" class="form-control" id="paper" name="paper" value="{{ $row->paper }}" readonly="true">
																</div>
																@elseif($row->ket_ppr!=NULL)
																	@if($row->message!=NULL)
																	<div class="form-group">	
		      															<label for="paper">Paper</label>
		      															<input type="text" class="form-control" id="paper" name="paper" value="{{ $row->paper }}" readonly="true">
																	</div>
																	<div class="form-group">	
		      															<label for="message">Keterangan Paper</label>
		      															<textarea class="form-control" id="message" name="message" readonly="true">{{ $row->message }}</textarea>
																	</div>
																	<div class="form-group">
																		<label class="control-label no-padding-right" for="file_paper">Upload Ulang Lembar Bimbingan Paper</label>

																		<div>
																			<input type="file" id="file_paper" name="file_paper">
																		</div>
																	</div>
																	@else
																	<div class="form-group">
																		<div class="col-sm-2 no-padding-right">
																			
																		</div>
																		<div class="infobox infobox-blue col-sm-9">
																			<div class="infobox-icon">
																				<i class="ace-icon fa fa-comments"></i>
																			</div>

																			<div class="infobox-data">
																				<span class="infobox-data-number">Sedang</span>
																				<div class="infobox-content">Diverifikasi</div>
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label no-padding-right" for="file_paper">Upload Ulang Lembar Bimbingan Paper</label>

																		<div>
																			<input type="file" id="file_paper" name="file_paper">
																		</div>
																	</div>
																	@endif
																@else
																<div class="form-group">
																	<label class="control-label no-padding-right" for="file_paper">Upload Lembar Bimbingan Paper</label>

																	<div >
																		<input type="file" id="file_paper" name="file_paper">
																	</div>
																</div>
																@endif

																<div class="form-group">	
	      															<label for="kartu_aksi">Kartu Aksi</label>

	      															<!-- <input type="text" class="form-control" id="kartu_aksi" name="kartu_aksi" value="{{ $row->kartu_aksi }}" readonly="true"> -->

																	<select class="form-control" id="kartu_aksi" name="kartu_aksi">
																		<option>{{ $row->kartu_aksi }}</option>
																		<option value="TIDAK PUNYA">TIDAK PUNYA</option>
																		<option value="PUNYA">PUNYA</option>
																	</select>
																</div>

																<div class="form-group">	
	      															<label for="osis">Tanggungan Osis</label>

	      															<!-- <input type="text" class="form-control" id="osis" name="osis" value="{{ $row->osis }}" readonly="true">
 -->
																	<select class="form-control" id="osis" name="osis">
																		<option>{{ $row->osis }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>

																<div class="form-group">	
	      															<label for="da">Tanggungan DA</label>

	      															<!-- <input type="text" class="form-control" id="da" name="da" value="{{ $row->da }}" readonly="true"> -->

																	<select class="form-control" id="da" name="da">
																		<option>{{ $row->da }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>

																<div class="form-group">	
	      															<label for="pmr">Tanggungan PMR</label>

	      															<!-- <input type="text" class="form-control" id="pmr" name="pmr" value="{{ $row->pmr }}" readonly="true"> -->

																	<select class="form-control" id="pmr" name="pmr">
																		<option>{{ $row->pmr }}</option>
																		<option value="TIDAK TUNTAS">TIDAK TUNTAS</option>
																		<option value="TUNTAS">TUNTAS</option>
																	</select>
																</div>

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

			@include('panitia/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('keamanan/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			function myFunction() {
			  // Declare variables
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("simple-table");
			  tr = table.getElementsByTagName("tr");

			  // Loop through all table rows, and hide those who don't match the search query
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[1];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }
			  }
			}
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
