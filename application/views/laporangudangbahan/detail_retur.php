<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Laporan Detail Retur
          <small>  Laporan Detail Retur  </small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporangudangbahan/cetak_detail_retur" target="_blank">

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

              <label>Barang</label>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="jenis_retur" name="jenis_retur" data-error=".errorTxt1">
                    <option value="Retur IN">Retur IN</option>
                    <option value="Retur OUT">Retur OUT</option>
                  </select>
                </div>
              </div>

              <label>Barang</label>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="supplier" name="supplier" data-error=".errorTxt1">
                    <option value="">--SEMUA SUPPLIER--</option>
                    <option value="SP0186">SURYA BUANA CV</option>
                    <option value="SP0142">PT PURINUSA EKA PERSADA</option>
                    <option value="SP0185">SAKU MAS JAYA, PT</option>
                    <option value="SP0140">PT MULIAPACK GRAVURINDO</option>
                    <option value="SP0032">PT EKADHARMA INTERNATIONAL</option>
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