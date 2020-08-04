<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          ANALISA UMUR HUTANG
          <small>AUH</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporanpembelian/cetak_auh" target="_blank">

              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="" id="sampai" name="sampai" class="datepicker form-control date" placeholder="Tanggal AUH" data-error=".errorTxt19" />
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
