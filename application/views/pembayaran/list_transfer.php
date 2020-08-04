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
          <li ><a href="<?php echo base_url(); ?>Pembayaran/listgiro">PEMBAYARAN GIRO</a></li>
          <li class="active"><a href="<?php echo base_url(); ?>Pembayaran/listtransfer">PEMBAYRAN TRANSFER</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tab-nav-right">
            
          </ul>
          <div class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <form class="form-horizontal" method="post" action="" autocomplete="off">
                  <div class="input-group demo-masked-input"  >
                    <span class="input-group-addon">
                     <i class="material-icons">chrome_reader_mode</i>
                   </span>
                   <div class="form-line">
                     <input type="text" value="<?php echo $namapel; ?>" id="namapel" name="namapel" class="form-control" placeholder="Nama Pelanggan">
                   </div>
                 </div>
                 <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                   <i class="material-icons">date_range</i>
                 </span>
                 <div class="form-line">
                   <input type="text" value="<?php echo $dari; ?>" id="dari" name="dari" class="datepicker form-control" placeholder="Dari">
                 </div>
               </div>
               <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                 <i class="material-icons">date_range</i>
               </span>
               <div class="form-line">
                 <input type="text" value="<?php echo $sampai; ?>" id="sampai" name="sampai" class="datepicker form-control" placeholder="Sampai">
               </div>
             </div>
             <div class="form-group">
              <div class="form-line">
                <select class="form-control show-tick" id="status2" name="status2" data-error=".errorTxt1">
                  <option  value="">-- Semua Status --</option>
                  <option <?php if($status=="0"){echo "selected";} ?> value="0">Pending</option>
                  <option <?php if($status=="1"){echo "selected";} ?> value="1">Diterima</option>
                  <option <?php if($status=="2"){echo "selected";} ?> value="2">Ditolak</option>
                </select>
              </div>
              <div class="errorTxt1"></div>
            </div>
            <br>
            <br>
             <div class="row clearfix">
              <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10">
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
                <th>Tanggal Penerimaan</th>
                <th>Nama Pelanggan</th>
                <th>Cabang</th>
                <th>Nama Bank</th>
                <th>Jumlah</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sno  = $row+1;
              foreach ($result as $d){
                ?>
                <tr>
                  <td><?php echo $sno; ?></td>
                  <td><?php echo $d['tgl_transfer']; ?></td>
                  <td><?php echo $d['nama_pelanggan']; ?></td>
                  <td><?php echo $d['kode_cabang']; ?></td>
                  <td><?php echo $d['namabank']; ?></td>
                  <td align="right"><?php echo number_format($d['jumlah'],'0','','.'); ?></td>
                  <td><?php echo DateToIndo2($d['tglcair']); ?></td>
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
                  <td>
                    <a href="#" data-id = "<?php echo $d['kode_transfer'] ?>"  class="btn bg-green btn-xs edittransfer"><i class="material-icons">mode_edit</i></a>
                    <a href="#" data-id = "<?php echo $d['kode_transfer']; ?>"  class="btn bg-blue btn-xs detail"><i class="material-icons">remove_red_eye</i></a>
                  </td>
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

  $(function() {
    $("#status2").selectpicker("refresh");
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
