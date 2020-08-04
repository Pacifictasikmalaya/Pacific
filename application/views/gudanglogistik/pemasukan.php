<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA PEMASUKAN
          <small>Data Pemasukan</small>
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
                  <input type="text" value="<?php echo $nobukti; ?>" id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti pemasukan" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tgl_pemasukan; ?>" id="tgl_pemasukan" name="tgl_pemasukan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
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
            <a href="<?php echo base_url(); ?>gudanglogistik/input_pemasukan" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="150px">No Bukti</th>
                    <th>Tanggal Pembelian</th>
                    <th>Tanggal Approve</th>
                    <th width="150px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no  = $row+1;
                  foreach ($result as $d){
                    $nobukti = str_replace("/",".",$d['nobukti_pemasukan']);
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $d['nobukti_pemasukan']; ?></td>
                      <?php if ($d['tgl_pembelian'] != 0) { ?>
                        <td><?php echo DateToIndo2($d['tgl_pembelian']); ?></td>
                      <?php }else{ ?> 
                        <td>-</td>
                      <?php } ?>
                      <td><?php echo DateToIndo2($d['tgl_pemasukan']); ?></td>
                      <td width="10px">
                        <a href="#" data-nobukti="<?php echo $d['nobukti_pemasukan']; ?>" class="btn btn-xs btn-primary detail">Detail</a>
                        <a href="#" data-href="<?php echo base_url(); ?>gudanglogistik/hapuspemasukan/<?php echo $nobukti; ?>" class="btn btn-xs btn-danger hapus">Hapus</a>
                      </td>
                    </tr>
                    <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
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

<div class="modal fade" id="detailpemasukan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Pemasukan
            <small>Detail Pemasukan</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loaddetailpemasukan">

                </div>
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
      var nobukti  = $(this).attr('data-nobukti');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>gudanglogistik/detail_pemasukan',
        data    : {nobukti:nobukti},
        cache   : false,
        success : function(respond){
          $("#loaddetailpemasukan").html(respond);
          $("#detailpemasukan").modal("show");
        }
      });
    });

    $(".hapus").click(function(e){
      e.preventDefault();
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
