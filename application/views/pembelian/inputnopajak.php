<form name="autoSumForm" autocomplete="off" class="" id="formPajak"  method="POST" action="<?php echo base_url(); ?>pembelian/update_fakturpajak">
  <div class="row">
    <div class="body">
      <input type="hidden" value="<?php echo $nobukti; ?>" id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti Pembelian" data-error=".errorTxt19" />
      <div class="col-md-12">
        <div class="input-group demo-masked-input">
          <span class="input-group-addon">
            <i class="material-icons">chrome_reader_mode</i>
          </span>
          <div class="form-line">
            <input type="text" id="nopajak" value="<?php echo $nopajak; ?>" name="nopajak" class="form-control" placeholder="No Faktur Pajak" data-error=".errorTxt19" />
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-md-offset-10">
            <input type="submit" name="submit" class="btn btn-sm bg-blue  waves-effect" value="SIMPAN">
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(function(){
    $("#formPajak").submit(function(){
      var nopajak = $("#nopajak").val();
      if(nopajak == "")
      {
        swal("Oops!", "No Pajak Harus Diisi !", "warning");
        return false;
      }else if(supplier == ""){
        return true;
      }
    });
  });
</script>