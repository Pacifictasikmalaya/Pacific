<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Mutasi DPB
          <small>  Mutasi DPB</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>laporangudangjadi/cetakmutasidpb" target="_blank">
              <label>Cabang</label>
                <div class="form-group">
                  <div class="form-line">
                    <select class="form-control show-tick" id="cabang" name="cabang" data-error=".errorTxt1" required>
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
                <label>Produk</label>
                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control show-tick" id="produk" name="produk" data-error=".errorTxt1" required>

                        </select>
                    </div>
                    <div class="errorTxt1"></div>
                </div>
              <label>Bulan</label>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control" id="bulan" name="bulan" required>
                    <option value="">Bulan</option>
                    <?php for($a=1; $a<=12; $a++){ ?>
                      <option value="<?php echo $a;  ?>"><?php echo $bulan[$a]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <label>Tahun</label>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control" id="tahun" name="tahun" required>
                    <option value="">Tahun</option>
                    <?php for($t=2019; $t<=$tahun; $t++){ ?>
                      <option value="<?php echo $t;  ?>"><?php echo $t; ?></option>
                    <?php } ?>
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

    $("#cabang").change(function(){
      var cabang = $("#cabang").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporangudangjadi/get_produk',
        data    : {cabang:cabang},
        cache   : false,
        success : function(respond){
          $("#produk").html(respond);
          $("#produk").selectpicker("refresh");
        }
      });
    });

  });

</script>
