<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          SALDO KAS BESAR
          <small>REKAP SALDO KAS BESAR</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate FormBJ" id="formValidate" method="POST"
              action="<?php echo base_url(); ?>laporanpenjualan/cetak_saldokasbesar" target="_blank">
              <label>Cabang</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="cabang" name="cabang" data-error=".errorTxt1">
                    <?php if($cb != "pusat"){ ?>
                    <option value="-">Pilih Cabang</option>
                    <?php }else{ ?>
                    <option value="-">Pilih Cabang</option>
                    <?php } ?>
                    <?php foreach($cabang as $c){ ?>
                    <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>

              <!-- <label>Periode</label>
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="dari" name="dari" class="form-control datepicker date" placeholder="Dari"
                      data-error=".errorTxt11">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="sampai" name="sampai" class="form-control datepicker date"
                      placeholder="Sampai" data-error=".errorTxt11">
                  </div>
                </div>
              </div>
              <div class="form-group errorTxt11"></div> -->
              <label>Bulan</label>
              <div class="form-group">
                <div class="form-line">
                  <select required class="form-control show-tick" id="bulan" name="bulan" data-error=".errorTxt1">
                    <option value="">Bulan</option>
                    <?php
                      $bulanini = date("m");
                      for($i=1; $i<count($bulan); $i++){
                    ?>
                      <option <?php if($bulanini==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
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
                  <select required class="form-control show-tick" id="tahun2" name="tahun" data-error=".errorTxt1">
                    <?php
                      $tahunmulai = 2020;
                      
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
              <div class="form-group">
                <button type="submit" name="submit" class="btn bg-red waves-effect">
                  <i class="material-icons">print</i>
                  <span>CETAK</span>
                </button>
                <button type="submit" name="export" class="btn bg-green waves-effect">
                  <i class="material-icons">file_download</i>
                  <span>EXPORT EXCEL</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

  $(function () {

    $(".FormBJ").submit(function () {
      var cabang = $("#cabang").val();
      if (cabang == "-") {
        swal("Oops!", "Silahkan Pilih Cabang Terlebih Dahulu  !", "warning");
        return false;
      } else {
        return true;
      }
    });



    $("#formValidate").validate({
      rules: {
        dari: "required",
        sampai: "required",
      },
      //For custom messages
      messages: {
        dari: "Periode Harus Diisi",
        sampai: "Periode Harus Diisi",
      },
      errorElement: 'div',
      errorPlacement: function (error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
          error.insertAfter(element);
        }
      }
    });

    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

  });

</script>