<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Tutup Laporan
          <small>Tutup Laporan</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="body">
            <form method="POST" autocomplete="off">
              <label>Tahun</label>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="tahun" name="tahun" data-error=".errorTxt1">
                    <?php
                      $tahunmulai = 2018;
                      for($thn = $tahunmulai; $thn<=date('Y'); $thn++){
                    ?>
                      <option <?php if($tahun==$thn){echo "Selected";} ?> value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php 
                      }
                    ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <div class="form-group">
                <div cass="col-md-6">
                  <div style="margin-left:20px">
                    <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="#" class="btn bg-red waves-effect" id="tambah"> Tambah Data </a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Kode Laporan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jenis Laporan</th>
                    <th>Tanggal Penutupan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no   = 1;
                  foreach ($tutuplaporan as $d){
                  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $d->kode_tutuplaporan; ?></td>
                    <td><?php echo $bulan[$d->bulan]; ?></td>
                    <td><?php echo $d->tahun; ?></td>
                    <td><?php echo strtoupper($d->jenis_laporan); ?></td>
                    <td><?php echo DateToIndo2($d->tgl_penutupan); ?></td>
                    <td>
                      <?php 
                        if($d->status=='1'){
                      ?>
                        <label class="badge bg-red">Laporan Ditutup</label>
                      <?php }else{ ?>
                        <label class="badge bg-green">Laporan Dibuka</label>
                     <?php } ?>
                    </td>
                    <td>
                      <?php 
                        if($d->status=='1'){
                      ?>
                        <a href="<?php echo base_url(); ?>setting/bukalaporan/<?php echo $d->kode_tutuplaporan; ?>"  class = "btn btn-xs btn-success">Buka Laporan</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>setting/tutup/<?php echo $d->kode_tutuplaporan; ?>"  class = "btn btn-xs btn-danger">Tutup Laporan</a>
                     <?php } ?>
                    </td>
                  </tr>
                  <?php
                    $no++;
                    }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="inputtutuplaporan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
    $("#tambah").click(function(){
    $("#inputtutuplaporan").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>setting/input_tutuplaporan',
        cache   : false,
        success : function(respond){
          $('.modal-content').html(respond);
        }
      });
    });
		$(".edit").click(function(e){
			e.preventDefault();
			var id = $(this).attr("data-id");
      $("#mutasibank").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>kaskecil/editmutasibank',
				data    : {id:id},
        cache   : false,
        success : function(respond){
					//console.log(respond);
					$('.modal-content').html(respond);
        }
      });
    });
  });
</script>
