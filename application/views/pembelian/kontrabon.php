<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA KONTRA BON / INTERNAL MEMO
          <small>Kontra Bon / Internal Memo</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="post" action="" autocomplete="off">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">chrome_reader_mode</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $nokontrabon; ?>" id="nokontrabon" name="nokontrabon" class="form-control" placeholder="No Kontra BON / Internal Memo" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tgl_kontrabon; ?>" id="tgl_kontrabon" name="tgl_kontrabon" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="supplier" name="supplier" data-error=".errorTxt1" data-live-search="true">
                    <option value="">--Semua Supplier--</option>
                    <?php foreach($supp as $d){ ?>
                      <option <?php if($supplier == $d->kode_supplier){ echo "selected"; } ?> value="<?php echo $d->kode_supplier; ?>"><?php echo $d->nama_supplier; ?></option>
                    <?php }  ?>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="status" name="status" data-error=".errorTxt1">
                    <option value="">--Semua--</option>
                    <option <?php if($status == 1){echo "selected";} ?> value="1">Belum Di Proses</option>
                    <option <?php if($status == 2){echo "selected";} ?>  value="2">Sudah Di Proses</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="kategori" name="kategori" data-error=".errorTxt1">
                    <option value="">--Semua Jenis Pengajuan--</option>
                    <option <?php if($kategori == "KB"){echo "selected";} ?>  value="KB">Kontra BON</option>
                    <option <?php if($kategori == "IM"){echo "selected";} ?>  value="IM">Internal Memo</option>
                    <option <?php if($kategori == "TN"){echo "selected";} ?>  value="TN">TUNAI</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-group" >
                <div class="col-md-offset-10">
                  <input type="submit" name="submit" class="btn bg-blue  waves-effect" value="CARI DATA">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="<?php echo base_url(); ?>pembelian/inputkontrabon" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>No Kontra BON</th>
                    <th>No Dok</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Total Bayar</th>
                    <th>Keterangan</th>
                    <th>Jenis Bayar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d){
                      $nokontrabon = str_replace("/",".",$d['no_kontrabon']);
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo $d['no_kontrabon']; ?></td>
                      <td><?php echo $d['no_dokumen']; ?></td>
                      <td><?php echo DateToIndo2($d['tgl_kontrabon']); ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td><?php echo $d['nama_supplier']; ?></td>
                      <td align="right"><?php echo number_format($d['totalbayar'],'2',',','.'); ?></td>
                      <td>
                        <?php
                          if(empty($d['tglbayar'])){
                            echo "<span class='badge bg-red'>Belum Bayar</span>";
                          }else{
                            echo "<span class='badge bg-green'>".DateToIndo2($d['tglbayar'])."</span>";
                          }
                        ?>

                      </td>
                      <td><?php echo $d['jenisbayar']; ?></td>
                      <td>

                        <a href="#" data-nokontrabon="<?php echo $d['no_kontrabon']; ?>" class="btn btn-xs btn-primary detail">Detail</a>
                        <a href="<?php echo base_url(); ?>pembelian/cetakkontrabon/<?php echo $nokontrabon; ?>" class="btn btn-xs btn-primary">Cetak</a>
                        <?php
                          if(empty($d['tglbayar']) && $d['kategori']!='TN'){
                        ?>
                          <a href="<?php echo base_url(); ?>pembelian/editkontrabon/<?php echo $nokontrabon; ?>"  class="btn btn-xs bg-teal">Edit</a>
                          <a href="#" data-href="<?php echo base_url(); ?>pembelian/hapuskontrabon/<?php echo $nokontrabon; ?>" class="btn btn-xs btn-danger hapus">Hapus</a>
                        <?php
                          }
                        ?>

                      </td>
                    </tr>
                    <?php
                      $sno++;
                    }
                    ?>
                </tbody>
              </table>
              <div style='margin-top: 10px;'>
                <?php echo $pagination; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detailkontrabon" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Kontra BON
            <small>Detail Kontra BON</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loadkontrabon"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
    $('.detail').click(function(e){
      e.preventDefault();
      var nokontrabon  = $(this).attr('data-nokontrabon');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>pembelian/detail_kontrabon',
        data    : {nokontrabon:nokontrabon},
        cache   : false,
        success : function(respond){
          $("#loadkontrabon").html(respond);
          $("#detailkontrabon").modal("show");
        }
      });


    });

   $(".hapus").click(function(){
   var getLink = $(this).attr('data-href');
   swal({
     title               : 'Alert',
     text                : 'Hapus Data ?',
     html                : true,
     confirmButtonColor  : '#d43737',
     showCancelButton    : true,
   },function(){
     window.location.href = getLink
   });
  });
  $('.datepicker').bootstrapMaterialDatePicker({
    format      : 'YYYY-MM-DD',
    clearButton : true,
    weekStart   : 1,
    time        : false
  });
});
</script>
