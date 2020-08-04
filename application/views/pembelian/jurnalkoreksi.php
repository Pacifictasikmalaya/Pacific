<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Jurnal Koreksi
          <small>Jurnal Koreksi</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="body">
            <form method="POST" autocomplete="off">
              <label>Tanggal</label>
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="dari" name="dari" value="<?php echo $dari; ?>" class="form-control datepicker date" placeholder="Dari" data-error=".errorTxt11">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-line">
                    <input type="text" id="sampai" value="<?php echo $sampai; ?>" name="sampai" class="form-control datepicker date" placeholder="Sampai" data-error=".errorTxt11">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div cass="col-md-6">
                  <div style="margin-left:20px">
                    <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="SET PERIODE">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="#" class="btn bg-red waves-effect" id="tambahjurnal"> Tambah Data </a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="mytable" style="font-size:12px; !important">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>TGL</th>
                    <th>No Bukti</th>
                    <th>Supplier</th>
                    <th>Nama Barang</th>
                    <th>Keterangan</th>
                    <th>Akun</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $totalkredit = 0;
                    $totaldebet  = 0;
                    foreach($jurnalkoreksi as $j){
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $j->tgl_jurnalkoreksi; ?></td>
                      <td><?php echo $j->nobukti_pembelian; ?></td>
                      <td><?php echo $j->nama_supplier; ?></td>
                      <td><?php echo $j->nama_barang; ?></td>
                      <td><?php echo $j->keterangan; ?></td>
                      <td><?php echo $j->kode_akun; ?></td>
                      <td align="right"><?php echo $j->qty; ?></td>
                      <td align="right"><?php echo  number_format($j->harga,'2',',','.'); ?></td>
                      <td align="right"><?php echo  number_format($j->harga * $j->qty,'2',',','.'); ?></td>
                      <td align="right">
                        <?php 
                          if($j->status_dk=='D'){ 
                            echo  number_format($j->harga * $j->qty,'2',',','.'); 
                          } 
                        ?>
                      </td>
                      <td align="right">
                        <?php 
                          if($j->status_dk=='K'){ 
                            echo  number_format($j->harga * $j->qty,'2',',','.'); 
                          } 
                        ?>
                      </td>
                      <td>
                        <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>pembelian/hapusjurnalkoreksi/<?php echo $j->kode_jk; ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
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
<div class="modal fade" id="jurnalkoreksi" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
		$('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});
    $("#tambahjurnal").click(function(){
      var dari = $("#dari").val();
      var sampai = $("#sampai").val();
      if(dari!="" && sampai !=""){
        $("#jurnalkoreksi").modal("show");
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>pembelian/inputjurnalkoreksi',
          cache   : false,
          success : function(respond){
            $('.modal-content').html(respond);
          }
        });
      }else{
        swal("Oops!", "Periode Harus Diisi Terlebih Dahulu !", "warning");
      }
      
    });
   
  });
</script>
