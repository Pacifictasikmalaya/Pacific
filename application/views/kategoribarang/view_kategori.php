<div class="row clearfix">
  <div class="col-md-5">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Data Kategori Barang
          <small>Mengelola Data Kategori Barang</small>
        </h2>

      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>kategoribarang/insert_kategori">
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" value="<?php echo $getkategori['kode_kategori']; ?>"  id="kode_kategori" name="kode_kategori" class="form-control" data-error=".errorTxt4" />
                  <label class="form-label">Kode Kategori</label>
                </div>
                <div class="errorTxt4"></div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" value="<?php echo $getkategori['kategori']; ?>"  id="kategori" name="kategori" class="form-control" data-error=".errorTxt4" />
                  <label class="form-label">Kategori</label>
                </div>
                <div class="errorTxt4"></div>
              </div>
              <div class="form-group" >
                <button type="submit"  name="submit" class="btn bg-blue waves-effect">
                  <i class="material-icons">save</i>
                  <span>SIMPAN</span>
                </button>
                <a href="<?php echo base_url('kategoribarang/view_kategori'); ?>" class="btn bg-red waves-effect">
                  <i class="material-icons">cancel</i>
                  <span>Batal</span>
                </a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div> 
  <div class="col-md-7">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          List Kategori
          <small>List Kategori Barang</small>
        </h2>
      </div>
      <div class="body">


        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="width:600px">
            <thead>
              <tr>
                <th>Kategori</th>
                <th width="90px">Aksi</th>
              </tr>
            </thead>
            <?php foreach($kategori->result() as $d){ ?>
              <tr>
                <td><?php echo $d->kategori; ?></td>
                <td>
                  <a href="<?php echo base_url('kategoribarang/view_kategori/'.$d->kode_kategori); ?>"  class="btn bg-green  btn-xs waves-effect edit">Edit</a>
                  <a href="#"  class="btn bg-red  btn-xs waves-effect" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url("kategoribarang/hapus/".$d->kode_kategori);?>">Hapus</a>
                </td>
              </tr>
            <?php } ?>
            <tbody>

            </tbody>
          </table>
        </div>



      </div>
    </div>

  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>   
<script type="text/javascript">
  $(function(){
    $("#formValidate").validate({
      rules: {
        kategori        :"required",
        dari            :"required",
        sampai          :"required",
        kategori          :"required",

        
      },
      messages: {

        kategori         :"Silahkan Pilih Kategori Terlebih Dahulu !",
        dari            :"Harus Diisi !",
        sampai          :"Harus Diisi !",
        kategori          :"Harus Diisi !",
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

    $('.js-basic-example').DataTable({
      responsive: true
    });
  });
</script>