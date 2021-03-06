<div class="row clearfix">
	<div class="col-md-8">
        <div class="card">
            <div class="header bg-cyan">
                <h2>
                    Settings Chart Of Accounts
                    <small>Settings st Data Chart of Accounts</small>
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-12">
											<form class="formValidate FormPenjualan" id="formValidate" method="POST" action="">
													<label>Cabang</label>
													<div class="form-group">
															<div class="form-line">
																	<select class="form-control show-tick" id="cabang" name="cabang" data-error=".errorTxt1">
																		<option value="PST">PUSAT</option>
																		 <?php foreach($cabang as $c){ ?>
																					<option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
																			<?php } ?>
																	</select>
															</div>
															<div class="errorTxt1"></div>
													</div>
													<label>Chart Of Account</label>
													<div class="form-group">
															<div class="form-line">
																	<select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
																		 <?php foreach($coa as $r){ ?>
																					<option value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
																			<?php } ?>
																	</select>
															</div>
															<div class="errorTxt1"></div>
													</div>
													<label>Category</label>
													<div class="form-group">
															<div class="form-line">
																	<select class="form-control show-tick " id="kategori" name="kategori" data-error=".errorTxt1" data-live-search="true">
																		 <option value="Kas Kecil">Kas Kecil</option>
																		  <option value="Mutasi Bank">Mutasi Bank</option>
																	</select>
															</div>
															<div class="errorTxt1"></div>
													</div>
													<div class="form-group" >
		                          <a id="submit" href="#" class="btn bg-blue waves-effect">
		                             <i class="material-icons">save</i>
		                             <span>SIMPAN</span>
		                         </a>

		                     </div>
											</form>
                    </div>
                </div>
								<div class="row">
									<div class="col-md-12">
										<div class="table table-responsive" id="loadsetcoa">

										</div>
									</div>
								</div>
             </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
	$(function(){
		function loadsetcoa(){
			var cabang 		= $("#cabang").val();
			var kategori	= $("#kategori").val();
			$.ajax({
				type    : 'POST',
				url     : '<?php echo base_url();?>coa/loadsetcoa',
				data    : {cabang:cabang,kategori:kategori},
				cache   : false,
				success : function(respond){
					$("#loadsetcoa").html(respond);
				}
			});

		}

		function loadhead(){
			var cabang = $("#cabang").val();
      if(cabang == 'PST'){
        $("#cb").text(cabang);
      }else{
        $("#cb").text("Cabang "+cabang);
      }

		}
		loadsetcoa();

		$("#cabang").change(function(e){
			e.preventDefault();
			loadhead();
			loadsetcoa();
		});

		$("#kategori").change(function(e){
			e.preventDefault();
			loadsetcoa();
		});

		$("#submit").click(function(e){
			e.preventDefault();
			var cabang 		= $("#cabang").val();
			var kodeakun	= $("#kodeakun").val();
			var kategori  = $("#kategori").val();
			$.ajax({
				type    : 'POST',
				url     : '<?php echo base_url();?>coa/input_set_coa_cabang',
				data    : {cabang:cabang,kodeakun:kodeakun,kategori:kategori},
				cache   : false,
				success : function(respond){
					loadsetcoa();
			}
			});
		});
		$("#cabang").selectpicker('refresh');


	});
</script>
