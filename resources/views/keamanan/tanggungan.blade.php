<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tanggungan Keamanan</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('keamanan/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('keamanan/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('keamanan/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('keamananhome')}}">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Tanggungan Keamanan <br>
								{{ $th_lulus }} 
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
						                </tr>
									</thead>

									<tbody>
										@foreach($tg_keamanan as $row)
										<tr>
											<td>{{ $row->k_nama }}</td>
											<td>{{ $row->s_nama }}</td>

											<td class="center">
												<div class="action-buttons">
													<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
														<i class="ace-icon fa fa-angle-double-down"></i>
														<span class="sr-only">Details</span>
													</a>
												</div>
											</td>
										</tr>

										<tr class="detail-row">
											<td colspan="8">
												<div class="table-detail">
													<div class="row">
														<div class="col-xs-12 col-sm-3">

															<form action="{{route('ijazah.keamanan', [$th_lulus, $row->s_id])}}" method="post">
											              		{{ csrf_field() }}
																<!-- keamanan putra -->
																<div class="form-group">
																	<label for="tg_aman_pa">Tanggungan Keamanan Putra</label>
																	<select  id="tg_aman_pa" name="tg_aman_pa" class="form-control">
																		<option>{{ $row->tg_aman_pa }}</option>
																		<option>TUNTAS</option>
																		<option>TIDAK TUNTAS</option>
																	</select>
																</div>

																@if($row->tg_aman_pa=="TUNTAS")
																@elseif($row->bukti_aman_pa!=NULL)
																<div class="form-group">
																	<label for="nominal_aman_pa">Nominal</label>
																	<input type="text" id="nominal_aman_pa" name="nominal_aman_pa" value="{{$row->nominal_aman_pa}}" class="form-control"  />
																</div>
																<div class="form-group">
																	<a href="{{route('bukti.aman', $row->bukti_aman_pa)}}" class="btn btn-xs btn-success">
																		Lihat Bukti
																	</a>
																	<a onclick="return confirm('Apakah anda yakin akan menyetujui bukti?')" href="{{route('keamanan.acc',[$th_lulus, $row->s_id])}}" class="btn btn-xs btn-success">
																		Acc Bukti
																	</a>
																</div>
																<div class="form-group">
																	<label for="ket_aman_pa"> Keterangan Keamanan Putra</label>
																	<textarea id="ket_aman_pa" name="ket_aman_pa" rows="7" cols="35" class="form-control">{{ $row->ket_aman_pa }}</textarea>
																</div>
																@else
																<div class="form-group">
																	<label for="nominal_aman_pa">Nominal</label>
																	<input type="text" id="nominal_aman_pa" name="nominal_aman_pa" value="{{$row->nominal_aman_pa}}" class="form-control"  />
																</div>
																<div class="form-group">
																	<label for="ket_aman_pa"> Keterangan Keamanan Putra</label>
																	<textarea id="ket_aman_pa" name="ket_aman_pa" rows="7" cols="35" class="form-control">{{ $row->ket_aman_pa }}</textarea>
																</div>
																@endif
																
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

			@include('keamanan/footer')

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
