
<div class="row clearfix">
	<div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA SERAH TERIMA HASIL PRODUKSI
          <small>Data FSTHP</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
	        <div class="col-md-12">
            <form class="form-horizontal" method="post" action="" autocomplete="off">
							<div class="input-group" >
								<span class="input-group-addon">
									<i class="material-icons">chrome_reader_mode</i>
								</span>
								<div class="form-line">
									<input type="text" value="<?php echo $nomutasi; ?>"  id="no_mutasi" name="no_mutasi" class="form-control" placeholder="No FSTHP" data-error=".errorTxt1" />
								</div>
							</div>
							<div class="input-group" >
								<span class="input-group-addon">
									<i class="material-icons">date_range</i>
								</span>
								<div class="form-line">
									<input type="text" value="<?php echo $tgl_mutasi; ?>"  id="tgl_mutasi" name="tgl_mutasi" class="form-control datepicker" placeholder="Tanggal" data-error=".errorTxt1" />
								</div>
							</div>
							<div class="row clearfix">
                <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10">
                  <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                </div>
              </div>
            </form>
	        </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
          	<div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>No. FSTHP</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d){
                      if($d['status']==0 OR $d['status']==""){
                        $color 	= "bg-orange";
                        $status = "Pending";
                      }else{
                        $color  = "bg-green";
                        $status = "Diterima Gudang";
                      }
                      $tanggal = explode("-",$d['tgl_mutasi_produksi']);
                      $hari    = $tanggal[2];
                      $bulan   = $tanggal[1];
                      $tahun   = $tanggal[0];
                      $tgl     = $hari."/".$bulan."/".substr($tahun,2,2);
                  ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td>
                      <a href="#" data-nomutasi="<?php echo $d['no_mutasi_produksi']; ?>"  class="detail">
                        <?php echo $d['no_mutasi_produksi']; ?>
                      </a>
                    </td>
                    <td><?php echo $tgl; ?></td>
                    <td><span class="badge <?php echo $color; ?>"><?php echo $status; ?></span></td>
                    <td>
                      <?php if($d['status']==0){ ?>
                        <a href="<?php echo base_url(); ?>fsthp/approve_fsthp/<?php echo $d['no_mutasi_produksi']; ?>" class="btn bg-green btn-xs"><i class="material-icons">check</i></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>fsthp/cancel_fsthp/<?php echo $d['no_mutasi_produksi']; ?>/<?php echo $this->uri->segment(3); ?>" class="btn bg-red btn-xs">Batalkan</a>
                      <?php }?>
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
<div class="modal fade" id="detailmutasi" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail FSTHP
            <small>Detail FSTHP</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loadmutasi"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--MODAL DATA BARANG-->
<div class="modal fade" id="databarang" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Data Barang
            <small>Pilih Data Barang</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
	            <div class="table-responsive">
	              <div id="loadBarang"></div>
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
        var nomutasi = $(this).attr('data-nomutasi');
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>fsthp/detail_mutasi',
          data    : {nomutasi:nomutasi},
          cache   : false,
          success : function(respond){
            $("#loadmutasi").html(respond);
          }
        });
        $("#detailmutasi").modal("show");
      });
      $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
      });
    });
</script>
