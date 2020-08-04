<div class="row clearfix">
	<div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Buat Klaim Kas Kecil
          <small>Klaim Kas Kecil</small>
        </h2>
      </div>
      <div class="body">
				<div class="row">
					<div class="body">
						<form method="POST" autocomplete="off">
							<div class="input-group demo-masked-input"  >
							 	<span class="input-group-addon">
								  <i class="material-icons">date_range</i>
							  </span>
							  <div class="col-sm-6">
								  <div class="form-line">
									 	<input type="text" id="dari" name="dari" value="<?php echo $dari; ?>" class="form-control datepicker date" placeholder="Dari" data-error=".errorTxt11">
								  </div>
							  </div>
							  <div class="col-sm-6">
								  <div class="form-line">
									  <input type="text" id="sampai" value="<?php echo $sampai; ?>" name="sampai" class="form-control datepicker date" placeholder="Sampai" data-error=".errorTxt11">
								  </div>
							  </div>
						 </div>
						  <div class="row clearfix">
							  <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10">
								  <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
							  </div>
						  </div>
						</form>
					</div>
				</div>
				<div class="row clearfix">
          <div class="col-sm-12">
						<form method="POST" autocomplete="off" id="klaim" action="<?php echo base_url(); ?>kaskecil/insert_klaim">
							<input type="hidden" name="cekprosesklaim" id="cekprosesklaim">
							<input type="hidden" name="cekvalidasi" id="cekvalidasi">
							<div class="row clearfix">
							<div class="col-sm-12">
							<label>Tanggal Klaim</label>
							 <div class="form-group">
								  <div class="form-line">
										<input type="text" id="tgl_klaim" name="tgl_klaim" class="form-control datepicker date" placeholder="Tanggal Klaim" data-error=".errorTxt11">
								  </div>
							 </div>
							 <label>Keterangan</label>
							 <div class="form-group">
								  <div class="form-line">
										<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt11">
								  </div>
							  </div>
							  <div class="form-group">
									<input type="submit" name="submit" class="btn bg-green m-2-15 waves-effect" value="Buat Klaim">
							  </div>
							</div>
							</div>
							<div class="row clearfix">
								<div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="mytable">
                      <thead>
                        <tr>
                          <th width="10px">No</th>
                          <th>Tanggal</th>
                          <th>No Bukti</th>
                          <th>Keterangan</th>
                          <th>Akun</th>
                          <th>Penerimaan</th>
                          <th>Pengeluaran</th>
                          <th>Saldo</th>
													<th>Aksi</th>
                        </tr>
                      </thead>
											<tbody>
												<tr>
													<td colspan="7"><b>SALDO AWA</b>L</td>
													<td align="right" style="font-weight:bold"><?php if(!empty($saldoawal['saldo_awal'])){echo number_format($saldoawal['saldo_awal'],'0','','.');}?></td>
													<td></td>
												</tr>
												<?php
													$jum 	 						= 0;
												 	$saldo						= $saldoawal['saldo_awal'];
													$totalpenerimaan  = 0;
													$totalpengeluaran = 0;
                          $sno   = $row+1;
                          foreach ($result as $d){
														if($d['status_dk']=='K'){
												      $penerimaan   = $d['jumlah'];
															$s 						= $penerimaan;
												      $pengeluaran  = "";
												    }else{
												      $penerimaan   = "";
												      $pengeluaran  = $d['jumlah'];
															$s 						= -$pengeluaran;
												    }
													$saldo = $saldo + $s;
													$totalpenerimaan 	= $totalpenerimaan + $penerimaan;
													$totalpengeluaran	= $totalpengeluaran + $pengeluaran;
                        ?>
                        <tr>
                            <td><?php echo $sno; ?></td>
														<td><?php echo DateToIndo2($d['tgl_kaskecil']); ?></td>
														<td><?php echo $d['nobukti']; ?></td>
														<td><?php echo $d['keterangan']; ?></td>
														<td><?php echo "<b>".$d['kode_akun']."</b>"." ".$d['nama_akun']; ?></td>
														<td align="right" style="color:green"><?php if(!empty($penerimaan)){echo number_format($penerimaan,'0','','.');}?></td>
														<td align="right" style="color:red"><?php 	if(!empty($pengeluaran)){echo number_format($pengeluaran,'0','','.');}?></td>
														<td align="right" style="color:black"><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></td>
														<td>
															<?php if (empty($d['kode_klaim'])){ ?>
																<div class="demo-checkbox">
																	<input type="checkbox" value="<?php echo $d['id']; ?>" id="basic_checkbox_<?php echo $sno; ?>" name="id[]">
																	<label for="basic_checkbox_<?php echo $sno; ?>"></label>
																</div>
															<?php }else{ echo "<b>".$d['ket_klaim']."</b>"; } ?>
														</td>
												</tr>
                        <?php
                          $sno++;
													$jum = $sno - 1;
                          }
													echo "<input type='hidden' value ='$jum' name='n'>";
                        ?>
											</tbody>
											<tfooter>
												<tr>
													<th>TOTAL</th>
													<th colspan="4"></th>
													<td align="right" style="color:green; font-weight:bold"><?php 	if(!empty($totalpenerimaan)){echo number_format($totalpenerimaan,'0','','.');}?></td>
													<td align="right" style="color:red; font-weight:bold"><?php 	if(!empty($totalpengeluaran)){echo number_format($totalpengeluaran,'0','','.');}?></td>
													<td align="right" style="color:black; font-weight:bold"><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></td>
													<td></td>
												</tr>
											</tfooter>
                    </table>
                  </div>
								</div>
							</div>
						</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="inputkaskecil" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<script type="text/javascript">
  $(function(){
		function cekprosesklaim(){
			$.ajax({
				type  	: 'POST',
				url   	: '<?php echo base_url(); ?>kaskecil/cekprosesklaim',
				cache 	: false,
				success	: function(respond){
					$("#cekprosesklaim").val(respond);
				}
			});
		}
		function cekvalidasi(){
			$.ajax({
				type  	: 'POST',
				url   	: '<?php echo base_url(); ?>kaskecil/cekvalidasi',
				cache 	: false,
				success	: function(respond){
					$("#cekvalidasi").val(respond);
				}
			});
		}
		cekprosesklaim();
		cekvalidasi();
		$('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});
		$("#klaim").submit(function(){
       var tgl_klaim     = $("#tgl_klaim").val();
			 var keterangan    = $("#keterangan").val();
			 var cekprosesklaim= $("#cekprosesklaim").val();
			 var cekvalidasi   = $("#cekvalidasi").val();
       if(tgl_klaim == ""){
           swal("Oops!", "Tanggal Klaim Masih Kosong!", "warning");
           $("#tgl_klaim").focus()
           return false;
       }else if(keterangan == ""){
           swal("Oops!", "Keterangan Masih Kosong!", "warning");
           $("#keterangan").focus()
           return false;
       }else if(cekprosesklaim == "1"){
           swal("Oops!", "Klaim Sebelumnya Belum di Proses!", "warning");
           $("#cekprosesklaim").focus()
           return false;
       }else if(cekvalidasi == "1"){
           swal("Oops!", "Klaim Sebelumnya Belum di Validasi!", "warning");
           $("#cekvalidasi").focus()
           return false;
       }else{
         return true;
       }
    });
  });
</script>
