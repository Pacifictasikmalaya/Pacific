<div class="row clearfix">
	<div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Kas Kecil
          <small>List Data Kas Kecil</small>
        </h2>
      </div>
      <div class="body">
				<div class="row">
					<div class="body">
						<form method="POST" autocomplete="off">
							<div class="input-group demo-masked-input"  >
								<span class="input-group-addon">
									<i class="material-icons">chrome_reader_mode</i>
								</span>
								<div class="form-line">
									<input ype="text" id="nobukti" name="nobukti" value="<?php echo $nobukti; ?>"  class="form-control" placeholder="No Bukti" data-error=".errorTxt11" />
								</div>
							</div>
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
							<div class="input-group" >
                <div class="form-line">
                  <select class="form-control show-tick " id="kodeakun2" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
										<option value="">-- Semua Akun --</option>
                    <?php foreach($coa as $r){ ?>
                    <option <?php if($kodeakun == $r->kode_akun){echo "selected";} ?> value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
                    <?php } ?>
                  </select>
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
                <a href="#" class="btn bg-red waves-effect" id="tambahkaskecil"> Tambah Data </a>
								<?php if ($ceksaldoawal < 1){ ?>
									<a href="#" class="btn bg-green waves-effect" id="inputsaldoawal">Input Saldo Awal</a>
								<?php } ?>
                <hr>
                <div class="table-responsive">
                   <table class="table table-bordered table-striped table-hover" id="mytable" style="max-width: 100% !important; width:150%">
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
														<td colspan="7"><b>SALDO AWAL</b>L</td>
														<td align="right" style="font-weight:bold"><?php if(!empty($saldoawal['saldo_awal'])){echo number_format($saldoawal['saldo_awal'],'0','','.');}?></td>
														<td></td>
													</tr>
													<?php
														 	$saldo 						= $saldoawal['saldo_awal'];
															$totalpenerimaan  = 0;
															$totalpengeluaran = 0;
                              $sno   = $row+1;
                              foreach ($result as $d){
																if($d['status_dk']=='K'){
														      $penerimaan   = $d['jumlah'];
																	$s 						= $penerimaan;
														      $pengeluaran  = 0;
														    }else{
														      $penerimaan   = 0;
														      $pengeluaran  = $d['jumlah'];
																	$s 						= -$pengeluaran;
														    }

																$saldo = $saldo + $s;

																$totalpenerimaan 	= $totalpenerimaan + $penerimaan;
																$totalpengeluaran	= $totalpengeluaran + $pengeluaran;
																if($d['no_ref'] !=""){ $color="#6db5c3"; $text="white";}else{$color=""; $text="";} 
                          ?>
                              <tr style="background-color:<?php echo $color;  ?>; color:<?php echo $text; ?>" >
                                  <td><?php echo $sno; ?></td>
																	<td><?php echo DateToIndo2($d['tgl_kaskecil']); ?></td>
																	<td><?php echo $d['nobukti']; ?></td>
																	<td>
																		<?php echo $d['keterangan']; ?>
																	</td>
																	<td><?php echo "<b>".$d['kode_akun']."</b>"." ".$d['nama_akun']; ?></td>
																	<td align="right" style="color:green"><?php if(!empty($penerimaan)){echo number_format($penerimaan,'0','','.');}?></td>
																	<td align="right" style="color:red"><?php 	if(!empty($pengeluaran)){echo number_format($pengeluaran,'0','','.');}?></td>
																	<td align="right" style="color:black"><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></td>
																	<td>
																			<?php if(empty($d['kode_klaim']) AND $d['keterangan']!='Penerimaan Kas Kecil' ){
																				if(empty($d['no_ref'])){	
																			?>
																			<a href="#" data-id="<?php echo $d['id'] ?>" class="btn bg-green btn-xs edit"><i class="material-icons">edit</i></a>
																			<a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>kaskecil/hapus_kaskkecil/<?php echo $d['id']; ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
																			<?php 
																				}	
																			} 
																			?>
																	</td>
															</tr>
                          <?php
                            $sno++;
                            }
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
       </div>
    </div>
    </div>
</div>
<div class="modal fade" id="inputkaskecil" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
		$("#kodeakun").selectpicker("refresh");
		$('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});
    $("#tambahkaskecil").click(function(){
      $("#inputkaskecil").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>kaskecil/inputkaskecil',
        cache   : false,
        success : function(respond){
          $('.modal-content').html(respond);
        }
      });
    });

		$("#inputsaldoawal").click(function(){
      $("#inputkaskecil").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>kaskecil/inputsaldoawal',
        cache   : false,
        success : function(respond){
					//console.log(respond);
					$('.modal-content').html(respond);
        }
      });
    });

		$(".edit").click(function(e){
			e.preventDefault();
			var id = $(this).attr("data-id");
      $("#inputkaskecil").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>kaskecil/editkaskecil',
				data    : {id:id},
        cache   : false,
        success : function(respond){
					//console.log(respond);
					$('.modal-content').html(respond);
        }
      });
    });
  });
</script>
