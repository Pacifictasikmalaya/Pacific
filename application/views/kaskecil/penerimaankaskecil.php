<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
    	<div class="header bg-cyan">
        <h2>
          Penerimaan Kas Kecil
          <small>Penerimaan Kas Kecil</small>
        </h2>
    	</div>
    	<div class="body">
				<div class="row">
					<div class="body">
						<form method="POST" autocomplete="off">
							 <h2 class="card-inside-title">Tanggal</h2>
							 <div class="row clearfix">
									 <div class="col-sm-6">
											 <div class="form-group">
													 <div class="form-line focused">
															<input type="text" id="dari" value="<?php echo $dari; ?>"  name="dari"  class="form-control datepicker date" placeholder="Dari" data-error=".errorTxt11">
													 </div>
											 </div>
									 </div>
									 <div class="col-sm-6">
											 <div class="form-group">
													 <div class="form-line disabled">
																<input type="text" id="sampai" value="<?php echo $sampai; ?>"  name="sampai" class="form-control datepicker date" placeholder="Sampai" data-error=".errorTxt11">
													 </div>
											 </div>
									 </div>
							 </div>
								<div class="form-group">
										<div cass="col-md-6">
												<input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
										</div>
								</div>
						</form>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-sm-12">

							<hr>
							<div class="table-responsive">
								 <table class="table table-bordered table-striped table-hover" id="mytable">
											<thead>
												<tr>
													<th width="10px">No</th>
													<th>Kode Klaim</th>
													<th>Tanggal</th>
													<th>Keterangan</th>
													<th>Status</th>
													<th>No Butkti</th>
													<th>Tgl Proses</th>
													<th>Jumlah</th>
													<th>Status Validasi</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
														$sno   = $row+1;
														foreach ($result as $d){
															if($d['status']=='0'){
																$keterangan = "Belum Di Proses";
																$color 			= "bg-red";
															}else{
																$keterangan = "Sudah di Proses";
																$color 			= "bg-green";
															}

															if($d['status_validasi']=='0'){
																$keterangan_valid = "Belum Di Validasi";
																$color_valid 			= "bg-red";
															}else if(empty($d['status_validasi'])){
																$keterangan_valid = "";
																$color_valid 			= "";

															}else{
																$keterangan_valid = "Sudah di Validasi";
																$color_valid 			= "bg-green";
															}
												?>
														<tr>
																<td><?php echo $sno; ?></td>
																<td><?php echo $d['kode_klaim']; ?></td>
																<td><?php echo DateToIndo2($d['tgl_klaim']); ?></td>
																<td><?php echo $d['keterangan']; ?></td>
																<td><span class="badge <?php echo $color; ?>"><?php echo $keterangan; ?></span></td>
																<td><?php echo $d['no_bukti']; ?></td>
																<td>
																	<?php if(!empty($d['status'])){

																			echo DateToIndo2($d['tgl_ledger']);

																	}else{
                                    echo "";
                                  }?>
																</td>
																<td align="right" style="color:black"><?php 	if(!empty($d['jumlah'])){echo number_format($d['jumlah'],'0','','.');}?></td>
																<td><span class="badge <?php echo $color_valid; ?>"><?php echo $keterangan_valid; ?></span></td>
																<td>
																	<a href="#" data-id="<?php echo $d['kode_klaim'] ?>" data-tglklaim="<?php echo $d['tgl_klaim'] ?>" data-cabang="<?php echo $d['kode_cabang'] ?>"  class="btn bg-blue btn-xs detail"><i class="material-icons">print</i></a>
																	<?php if($d['status_validasi']=='0'){ ?>
																	<a href="<?php echo base_url() ?>kaskecil/terimakaskecil/<?php echo $d['no_bukti']; ?>" class="btn bg-green btn-xs"><i class="material-icons">check</i></a>
																	<?php }else{ ?>
																	<a href="<?php echo base_url() ?>kaskecil/batalkan_validasi/<?php echo $d['no_bukti']; ?>" class="btn bg-red btn-xs hapus"><i class="material-icons">cancel</i></a>
																	<?php } ?>
																</td>
														</tr>
												<?php
													$sno++;
													}
												?>
											</tbody>
									</table>
							</div>
					</div>
				</div>
     	</div>
		</div>
    </div>
</div>
<div class="modal fade" id="detailklaim" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
	$(function(){
		$('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});
		$(".detail").click(function(e){
			e.preventDefault();
			var kode_klaim = $(this).attr('data-id');
			var tgl_klaim  = $(this).attr('data-tglklaim');
			var cabang     = $(this).attr('data-cabang');
			$.ajax({
				type 		: 'POST',
				url   	: '<?php echo base_url(); ?>kaskecil/detailklaim',
				data  	: {kode_klaim:kode_klaim,tgl_klaim:tgl_klaim,cabang:cabang},
				cache 	: false,
				success	: function(respond){
					$("#detailklaim").modal("show");
					$(".modal-content").html(respond);
				}
			});
		});



	});
</script>
