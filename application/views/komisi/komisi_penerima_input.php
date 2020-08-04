<div class="card">
  <div class="header bg-cyan">
    <h2>
      Input Penerima Komisi
      <small>Input Penerima Komisi</small>
    </h2>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form action="<?php echo base_url(); ?>komisi/inputpenerima" method="POST">
          <div class="form-group">
            <div class="form-line">
              <input type="text" readonly value="<?php echo $nik; ?>"  id="nik" name="nik" class="form-control" placeholder="NIK" data-error=".errorTxt11">
            </div>
          </div>
          <div class="form-group">
            <input  type="hidden" id="cbg" name="cbg" value="<?php echo $cbg; ?>">
            <div class="form-line">
              <select disabled class="form-control show-tick" id="cabanginput" name="cabanginput" data-error=".errorTxt1">
                <option value="">-- Pilih Cabang --</option>
                <?php foreach($cabang as $c){ ?>
                <option <?php if($c->kode_cabang == $cbg){echo "selected";} ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <div class="form-group">
            <div class="form-line">
              <input type="text"  id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap" data-error=".errorTxt11">
            </div>
          </div>
          <div class="form-group">
            <div class="form-line">
              <select class="form-control show-tick" id="jabataninput" name="jabatan">
                <option value="">-- Pilih Jabatan --</option>
                <?php foreach($jabatan as $d){ ?>
                <option value="<?php echo $d->kode_jabatan; ?>"><?php echo strtoupper($d->nama_jabatan); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="sales">
            <div class="form-line">
              <select class="form-control show-tick" id="salesman" name="salesman">
                <option value="">-- Pilih ID Sales --</option>
                <?php foreach($sales as $d){ ?>
                  <option value="<?php echo $d->id_karyawan; ?>"><?php echo strtoupper( $d->id_karyawan." | ".$d->nama_karyawan); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group" >
            <button type="submit"  name="submit" class="btn bg-blue waves-effect">
              <i class="material-icons">save</i>
              <span>SIMPAN</span>
            </button>
            <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
              <i class="material-icons">cancel</i>
              <span>Batal</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>

  $(function(){
    
    $("#jabataninput").selectpicker("refresh");
    $("#salesman").selectpicker("refresh");
    $("#jabataninput").change(function(e){
      e.preventDefault();
      var jabatan = $(this).val();
      //alert(jabatan);
      if(jabatan=="SM")
      {
        //alert("SM");
        $("#sales").show();
      }else{
        $("#sales").hide();
      }
    });
    $("#sales").hide();
  })
</script>