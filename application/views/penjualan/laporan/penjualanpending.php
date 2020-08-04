
<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Laporan Penjualan Pending
          <small>Laporan Penjualan Pending</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate FormPenjualan" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporanpenjualan/cetak_lappenjualanpending" target="_blank">
              <label>Cabang</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="cabang" name="cabang" data-error=".errorTxt1">
                    <?php if($cb != "pusat"){ ?>
                      <option value="-">Pilih Cabang</option>
                    <?php }else{ ?>
                      <option value="">Semua Cabang</option>
                    <?php } ?>
                    <?php foreach($cabang as $c){ ?>
                      <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Salesman</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="salesman" name="salesman" data-error=".errorTxt1">
                    <option value="">Semua Salesman</option>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Pelanggan</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="pelanggan" name="pelanggan" data-error=".errorTxt1" data-live-search="true">
                    <option value="">Semua Pelanggan</option>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Jenis Transaksi</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="jenistransaksi" name="jenistransaksi" data-error=".errorTxt1" data-live-search="true">
                    <option value="">Semua Jenis Transaksi</option>
                    <option value="tunai">Tunai</option>
                    <option value="kredit">Kredit</option>

                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Jenis Laporan</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="jenislaporan" name="jenislaporan" data-error=".errorTxt1" data-live-search="true">
                    <option value="">Biasa</option>
                    <option value="rekap">Rekap</option>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Status</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="status" name="status" data-error=".errorTxt1" data-live-search="true">
                    <option value="">Status</option>
                    <option value="1">Disetujui</option>
                    <option value="2">Pending</option>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <div class="form-group errorTxt11"></div>
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

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

  $(function(){

    $(".FormPenjualan").submit(function(){

      var cabang    = $("#cabang").val();

      if(cabang == "-" ){
       swal("Oops!", "Silahkan Pilih Cabang Terlebih Dahulu  !", "warning");
       return false;
     }else{
      return true;
    }


  });

    $(".FormRetur").submit(function(){

      var cabangretur    = $("#cabangretur").val();

      if(cabangretur == "-" ){
       swal("Oops!", "Silahkan Pilih Cabang Terlebih Dahulu  !", "warning");
       return false;
     }else{
      return true;
    }


  });

    $("#formValidate").validate({
      rules: {
        dari            :"required",
        sampai          :"required",

      },
            //For custom messages
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


    $("#formValidateretur").validate({
      rules: {

        dari       :"required",
        sampai     :"required",

      },
            //For custom messages
            messages: {


              dari      :"Periode Harus Diisi",
              sampai    :"Periode Harus Diisi",
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

    $("#cabang").change(function(){

      var cabang = $("#cabang").val();
      $.ajax({

        type    : 'POST',
        url     : '<?php echo base_url();?>laporanpenjualan/get_salesman',
        data    : {cabang:cabang},
        cache   : false,
        success : function(respond){

          $("#salesman").html(respond);
          $("#salesman").selectpicker("refresh");

        }

      });
    });

    $("#salesman").change(function(){

      var salesman = $("#salesman").val();
      $.ajax({

        type    : 'POST',
        url     : '<?php echo base_url();?>laporanpenjualan/get_pelanggan',
        data    : {salesman:salesman},
        cache   : false,
        success : function(respond){

          $("#pelanggan").html(respond);
          $("#pelanggan").selectpicker("refresh");

        }


      });

    });


    $("#cabangretur").change(function(){

      var cabang = $("#cabangretur").val();
      $.ajax({

        type    : 'POST',
        url     : '<?php echo base_url();?>laporanpenjualan/get_salesman',
        data    : {cabang:cabang},
        cache   : false,
        success : function(respond){

          $("#salesmanretur").html(respond);
          $("#salesmanretur").selectpicker("refresh");

        }

      });
    });


    $("#salesmanretur").change(function(){

      var salesman = $("#salesmanretur").val();
      $.ajax({

        type    : 'POST',
        url     : '<?php echo base_url();?>laporanpenjualan/get_pelanggan',
        data    : {salesman:salesman},
        cache   : false,
        success : function(respond){

          $("#pelangganretur").html(respond);
          $("#pelangganretur").selectpicker("refresh");

        }


      });
    });
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

  });

</script>
