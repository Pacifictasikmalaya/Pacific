<div class="card">
  <div class="header bg-cyan">
    <h2>
      Daftar Pembayaran Giro Dan Transfer
      <small>Giro dan Transfer</small>
    </h2>

  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tab-nav-right">
          <li><a href="<?php echo base_url(); ?>penjualan/listgiro">PEMBAYARAN GIRO</a></li>
          <li class="active"><a href="<?php echo base_url(); ?>penjualan/listtransfer">PEMBAYRAN TRANSFER</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Nav tabs -->
          <div class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <form class="form-horizontal" method="post" action="" autocomplete="off">
                  <div class="row clearfix">
                    <div class="col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label>No Faktur</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                      <div class="form-group">
                        <div class="form-line">
                          <input type="text" id="nofaktur" value="<?php echo $nofaktur; ?>" name="nofaktur" class="form-control" placeholder="No Faktur">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row clearfix">
                    <div class="col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label>Nama Pelanggan</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                      <div class="form-group">
                        <div class="form-line">
                          <input type="text" value="<?php echo $namapel; ?>" id="namapel" name="namapel" class="form-control" placeholder="Nama Pelanggan">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-md-2 col-sm-4 col-xs-5 form-control-label">
                      <label>Tanggal</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                      <div class="form-group">
                        <div class="col-md-6">
                          <div class="form-line">
                            <input type="text" value="<?php echo $dari; ?>" id="dari" name="dari" class="datepicker form-control" placeholder="Dari">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-line">
                            <input type="text" value="<?php echo $sampai; ?>" id="sampai" name="sampai" class="datepicker form-control" placeholder="Sampai">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                      <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover" style="width:1100px" id="mytable">
                    <thead>
                      <tr>
                        <th width="10px">No</th>
                        <th>No. Faktur</th>
                        <th>Nama Pelanggan</th>
                        <th>Cabang</th>
                        <th>Bank</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Jatuh Tempo</th>

                        <th>Status</th>
                        <th>Ket</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sno  = $row+1;
                      foreach ($result as $d){
                        ?>
                        <tr>
                          <td><?php echo $sno; ?></td>
                          <td><?php echo $d['no_fak_penj']; ?></td>
                          <td><?php echo $d['nama_pelanggan']; ?></td>
                          <td><?php echo $d['kode_cabang']; ?></td>
                          <td><?php echo $d['namabank']; ?></td>
                          <td align="right"><?php echo number_format($d['jumlah'],'0','','.'); ?></td>
                          <td>
                            <?php
                            if(!empty($d['tgl_transfer'])){
                              $tgl_transfer = explode("-", $d['tgl_transfer']);
                              $tgltransfer  = $tgl_transfer[2]."/".$tgl_transfer[1]."/".$tgl_transfer[0];
                              echo $tgltransfer;
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            $tgl_cair = explode("-", $d['tglcair']);
                            $tglcair  = $tgl_cair[2]."/".$tgl_cair[1]."/".$tgl_cair[0];
                            echo $tglcair;
                            ?>
                          </td>
                          <td>
                            <?php
                            if($d['status'] == 0){
                              ?>
                              <span class="badge bg-orange">Pending</span>
                              <?php
                            }elseif($d['status'] == 1){
                              ?>
                              <span class="badge bg-green"><?php echo DateToIndo2($d['tglbayar']); ?></span>
                              <?php
                            }elseif($d['status'] == 2){

                              ?>
                              <span class="badge bg-red">Ditolak</span>
                              <?php
                            }
                            ?>
                          </td>
                          <td><?php echo $d['ket']; ?></td>
                          <!-- <td>
                            <?php if($d['ket'] == ""){ ?>
                              <a href="#" data-id="<?php echo $d['id_transfer'] ?>" class="btn bg-green btn-xs edittransfer"><i class="material-icons">mode_edit</i></a>
                              <a href="#" data-id = "<?php echo $d['id_transfer']; ?>"  class="btn bg-blue btn-xs detail"><i class="material-icons">remove_red_eye</i></a>
                            <?php } ?>

                          </td> -->
                        </tr>
                        <?php  $sno++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div style='margin-top: 10px;'>
                <?php echo $pagination; ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
<!-- <div class="modal fade" id="edittransfer" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div>
  </div>
</div> -->
<div class="modal fade" id="detailtransfer" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <div id="loaddetail"></div>
   </div>
 </div>
</div>
<script type="text/javascript">

  $(function() {
    $(".edittransfer").click(function(e) {
      e.preventDefault();
      var id_transfer = $(this).attr('data-id');
      var page = 'listtransfer';
      $("#detailtransfer").modal("show");
      // $("#edittransfer").modal("show");
      $.ajax({

        type: 'POST',
        url: '<?php echo base_url();?>Pembayaran/editbayartransfer',
        data: {
          id_transfer: id_transfer,
          page: page
        },
        cache: false,
        success: function(respond) {
          $("#loaddetail").html(respond);
          // $(".modal-content").html(respond);
        }
      });
    });

    $(".detail").click(function(e){
      e.preventDefault();
      var id_transfer = $(this).attr('data-id');
      $("#detailtransfer").modal("show");
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>Pembayaran/detailtransfer',
        data    : {id_transfer:id_transfer},
        cache   : false,
        success : function(respond){
          $("#loaddetail").html(respond);
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
