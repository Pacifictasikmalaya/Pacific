<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA SALDO AWAL
          <small>Data Saldo Awal</small>
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
                  <input type="text" value="<?php echo $kode_saldoawal_gb; ?>" id="kode_saldoawal_gb" name="kode_saldoawal_gb" class="form-control" placeholder="No Bukti saldoawal" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
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
            <a href="<?php echo base_url(); ?>gudangbahan/inputsaldoawal" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Kode Saldo Awal</th>
                    <th>Tanggal Input</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th width="150px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no  = $row+1;
                  foreach ($result as $d){
                    $kode_saldoawal_gb = str_replace("/",".",$d['kode_saldoawal_gb']);
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $d['kode_saldoawal_gb']; ?></td>
                      <td><?php echo DateToIndo2($d['tanggal']); ?></td>
                      <td><?php echo $d['bulan']; ?></td>
                      <td><?php echo $d['tahun']; ?></td>
                      <td width="10px">
                        <a href="#" data-kode_saldoawal_gb="<?php echo $d['kode_saldoawal_gb']; ?>" class="btn btn-xs btn-primary detail">Detail</a>
                        <a href="#" data-href="<?php echo base_url(); ?>gudangbahan/hapussaldoawal/<?php echo $kode_saldoawal_gb; ?>" class="btn btn-xs btn-danger hapus">Hapus</a>
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

<div class="modal fade" id="detailsaldoawal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Saldo Awal
            <small>Detail Saldo Awal</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loaddetailsaldoawal">

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
      var kode_saldoawal_gb  = $(this).attr('data-kode_saldoawal_gb');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>gudangbahan/detail_saldoawal',
        data    : {kode_saldoawal_gb:kode_saldoawal_gb},
        cache   : false,
        success : function(respond){
          $("#loaddetailsaldoawal").html(respond);
          $("#detailsaldoawal").modal("show");
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
