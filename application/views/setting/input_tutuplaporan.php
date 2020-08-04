<div class="card">
  <div class="header bg-cyan">
    <h2>
      Tutup Laporan
      <small>Tutup Laporan</small>
    </h2>

  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form autocomplete="off" class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>setting/inserttutuplaporan">
          <div class="row">
            <div class="body">
              <label>Tanggal</label>
              <div class="input-group demo-masked-input">
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" id="tanggal" name="tgl_penutupan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt1" />
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Bulan</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="bulan" name="bulan" data-error=".errorTxt1">
                    <option value="">Bulan</option>
                    <?php
                      for($i=1; $i<count($bulan); $i++){
                    ?>
                      <option value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Tahun</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="tahun2" name="tahun" data-error=".errorTxt1">
                    <?php
                      $tahunmulai = 2018;
                      for($thn = $tahunmulai; $thn<=date('Y'); $thn++){
                    ?>
                      <option <?php if(date('Y')==$thn){echo "Selected";} ?>  value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php 
                      }
                    ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Jenis Laporan</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="jenis_laporan" name="jenis_laporan" data-error=".errorTxt1">
                      <option value="">Jenis Laporan</option>
                      <option value="penjualan">PENJUALAN</option>
                      <option value="kaskecil">KAS KECIL</option>
                      <option value="pembelian">PEMBELIAN</option>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="body">
              <div class="form-group">
                <button type="submit" name="submit" class="btn bg-blue waves-effect">
                  <i class="material-icons">save</i>
                  <span>SIMPAN</span>
                </button>
                <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
                  <i class="material-icons">cancel</i>
                  <span>Batal</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<script type="text/javascript">
	$(function(){
    $("#tahun2").selectpicker('refresh');
    $("#bulan").selectpicker('refresh');
    $('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});

    

    $("#formValidate").submit(function(){
       var tanggal       = $("#tanggal").val();
       var bulan         = $("#bulan").val();
       var tahun         = $("#tahun").val();
    
       if(tanggal == ""){
          swal("Oops!", "Tanggal Masih Kosong!", "warning");
          $("#tanggal").focus()
          return false;
       }else if(bulan == ""){
          swal("Oops!", "Bulan Masih Kosong!", "warning");
          return false;
        }else if(tahun == ""){
          swal("Oops!", "Tahun Masih Kosong!", "warning");
          return false;
        }else{
         return true;
       }
    });
	});
</script>
