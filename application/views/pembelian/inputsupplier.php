<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          INPUT DATA SUPPLIER
          <small>Data Supplier</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>pembelian/insert_supplier">
              <div class="row">
                <div class="body">
                  <div class="col-md-12">
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">chrome_reader_mode</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="<?php echo $kode_supplier; ?>" id="kodesupplier" name="kodesupplier" class="form-control" placeholder="Kode Supplier" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">contacts</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="namasupplier" name="namasupplier" class="form-control" placeholder="Nama Supplier" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">contacts</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="cp" name="cp" class="form-control" placeholder="Contact Person" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">phone</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="nohp" name="nohp" class="form-control" placeholder="No HP" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">edit_location</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="alamat" name="alamat" class="form-control" placeholder="Alamat" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">contacts</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="email" name="email" class="form-control" placeholder="Email" data-error=".errorTxt19" />
                      </div>
                    </div>
                    <div class="input-group demo-masked-input"  >
                      <span class="input-group-addon">
                        <i class="material-icons">contacts</i>
                      </span>
                      <div class="form-line">
                        <input type="text" value="" id="norek" name="norek" class="form-control" placeholder="No Rekening" data-error=".errorTxt19" />
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

</script>
