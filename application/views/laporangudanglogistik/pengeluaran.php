<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Laporan Pengeluaran
          <small>  Laporan Pengeluaran  </small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporangudanglogistik/cetak_pengeluaran" target="_blank">
              <label>Departemen</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="kode_dept" name="kode_dept" data-error=".errorTxt1">
                    <option value="">-- SEMUA DEPARTEMEN -- </option>
                    <?php foreach($dept as $b){ ?>
                      <option value="<?php echo $b->kode_dept; ?>"><?php echo $b->nama_dept; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>


              <label>Kategori</label>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="form-line">
                    <select class="form-control" name="kode_kategori" id="kode_kategori">
                      <option value="">-- SEMUA KATEGORI --</option>
                      <?php foreach ($kategori as $d) { ?>
                        <option value="<?php echo $d->kode_kategori;?>"><?php echo $d->kategori;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <label>Barang</label>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="kode_barang" name="kode_barang" data-error=".errorTxt1">
                    <option value="">--SEMUA BARANG--</option>
                    <?php foreach ($barang as $b) { ?>
                    <option value="<?php echo $b->kode_barang;?>"><?php echo $b->nama_barang;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <label>Periode</label>
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="dari" name="dari" class="form-control datepicker date" placeholder="Dari" data-error=".errorTxt11">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="sampai" name="sampai" class="form-control datepicker date" placeholder="Sampai" data-error=".errorTxt11">
                  </div>
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

    $(".datepicker").bootstrapMaterialDatePicker({
      format: "YYYY-MM-DD",
      clearButton: true,
      weekStart: 1,
      time: false
    });

    $("#formValidate").validate({
      rules: {
        dari            :"required",
        sampai          :"required",

      },
      messages: {

        dari           :"Periode Harus Diisi",
        sampai         :"Periode Harus Diisi",

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
          error.insertAfter(element);
        }
      }
    });

  });

</script>