<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          LEDGER
          <small>Ledger</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate FormPenjualan" id="formValidate" method="POST"
            action="<?php echo base_url(); ?>laporankeuangan/cetak_ledger" target="_blank">
            <label>Bank</label>
            <div class="form-group">
              <div class="form-line">
                <select class="form-control show-tick" id="bank" name="bank" data-error=".errorTxt1">
                  <option value="">Semua Bank</option>
                  <?php foreach($bank as $b){ ?>
                    <option value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="errorTxt1"></div>
            </div>
            <label>Jenis Laporan</label>
            <div class="form-group">
              <div class="form-line">
                <select class="form-control show-tick" id="jenislaporan" name="jenislaporan" data-error=".errorTxt1">
                  <option value="detail">Detail</option>
                  <option value="rekap">Rekap</option>
                </select>
              </div>
              <div class="errorTxt1"></div>
            </div>
            <label>Periode</label>
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>
  $(function(e){
    $(".datepicker").bootstrapMaterialDatePicker({
      format: "YYYY-MM-DD",
      clearButton: true,
      weekStart: 1,
      time: false
    });
  });
</script>