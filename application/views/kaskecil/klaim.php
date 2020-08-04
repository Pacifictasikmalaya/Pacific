<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
    	<div class="header bg-cyan">
        <h2>
          Klaim Kas Kecil
          <small>List Data  Klaim Kas Kecil</small>
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
							<a href="<?php echo base_url(); ?>kaskecil/buatklaim" class="btn bg-red waves-effect"> Buat Klaim </a>
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
										?>
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $d['kode_klaim']; ?></td>
											<td><?php echo DateToIndo2($d['tgl_klaim']); ?></td>
											<td><?php echo $d['keterangan']; ?></td>
											<td><span class="badge <?php echo $color; ?>"><?php echo $keterangan; ?></span></td>
											<td>
												<a href="#" data-id="<?php echo $d['kode_klaim'] ?>" data-tglklaim="<?php echo $d['tgl_klaim'] ?>" data-cabang="<?php echo $d['kode_cabang'] ?>"  class="btn bg-blue btn-xs detail"><i class="material-icons">print</i></a>
												<?php if($d['status']=='0'){ ?>
												<a href="<?php echo base_url(); ?>kaskecil/hapus_klaim/<?php echo $d['kode_klaim']; ?>" class="btn bg-red btn-xs hapus"><i class="material-icons">delete</i></a>
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
<script type="text/javascript">
	$(function(){
		$('.hapus').on('click',function(){
        var getLink = $(this).attr('href');
        swal({
                title: 'Alert',
                text: 'Hapus Data?',
                html: true,
                confirmButtonColor: '#d9534f',
                showCancelButton: true,
                },function(){
                window.location.href = getLink
            });
        return false;
    });
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
