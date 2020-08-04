<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Laporan Pembayaran
          <small>Laporan Pembayaran </small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporanpembelian/cetak_pembayaran" target="_blank">
              <div class="col-sm-6">
                <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                    <input type="text" value="" id="dari" name="dari" class="datepicker form-control date" placeholder="Dari" data-error=".errorTxt19" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                    <input type="text" value="" id="sampai" name="sampai" class="datepicker form-control date" placeholder="Sampai" data-error=".errorTxt19" />
                  </div>
                </div>
              </div>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="supplier" name="supplier" data-error=".errorTxt1" data-live-search="true">
                    <option value="">--Semua Supplier--</option>
                    <?php foreach($supp as $d){ ?>
                      <option value="<?php echo $d->kode_supplier; ?>"><?php echo $d->nama_supplier; ?></option>
                    <?php }  ?>
                  </select>
                </div>
              </div>
              <div class="form-group" >
                <button type="submit"  name="submit" class="btn bg-red waves-effect">
                  <i class="material-icons">print</i>
                  <span>CETAK</span>
                </button>
                <button type="submit"  name="export" class="btn bg-green waves-effect">
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
  $(function(){
    $("#formValidate").submit(function(){
      var dari       = $("#dari").val();
      var sampai     = $("#sampai").val();
      if(dari=="" || sampai=="")
      {
        swal("Oops!", "Silahkan Pilih Periode terlebih dahulu!", "warning");
        return false;
      }else{
        return true;
      }
    });

    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });
  });
</script>
