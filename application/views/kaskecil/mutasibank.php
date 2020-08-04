<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Mutasi Bank
          <small>List Data Mutasi Bank</small>
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
                    <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="#" class="btn bg-red waves-effect" id="tambahmutasibank"> Tambah Data </a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Akun</th>
                    <th>Penerimaan</th>
                    <th>Pengeluaran</th>
                    
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php
                      $saldo = $saldoawal['saldo_awal'];
                      $sno   = $row+1;
                      foreach ($result as $d){
                        if($d['status_dk']=='K'){
                          $penerimaan   = $d['jumlah'];
                          $s 						= $penerimaan;
                          $pengeluaran  = "";
                        }else{
                          $penerimaan   = "";
                          $pengeluaran  = $d['jumlah'];
                          $s 						= -$pengeluaran;
                        }

                        $saldo = $saldo + $s;
                  ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo DateToIndo2($d['tgl_ledger']); ?></td>
                    <td><?php echo $d['keterangan']; ?></td>
                    <td><?php echo "<b>".$d['kode_akun']."</b>"." ".$d['nama_akun']; ?></td>
                    <td align="right" style="color:green"><?php if(!empty($penerimaan)){echo number_format($penerimaan,'2',',','.');}?></td>
                    <td align="right" style="color:red"><?php 	if(!empty($pengeluaran)){echo number_format($pengeluaran,'2',',','.');}?></td>
                    <td>
                      <a href="#" data-id="<?php echo $d['no_bukti'] ?>" class="btn bg-green btn-xs edit"><i class="material-icons">edit</i></a>
                      <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>kaskecil/hapus_mutasibank/<?php echo $d['no_bukti']; ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
                    </td>
                  </tr>
                  <?php
                    $sno++;
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
<div class="modal fade" id="mutasibank" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function(){
		$('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});
    $("#tambahmutasibank").click(function(){
    $("#mutasibank").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>kaskecil/inputmutasibank',
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
