<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA OPNAME STOK
          <small>Data Opname Stok</small>
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
                  <input type="text" value="<?php echo $kode_opname; ?>" id="kode_opname" name="kode_opname" class="form-control" placeholder="No Bukti Opname" data-error=".errorTxt19" />
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
            <a href="<?php echo base_url(); ?>produksi/inputopname" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="150px">Kode</th>
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
                    $kode_opname = str_replace("/",".",$d['kode_opname']);
                    if ($d['bulan'] == "01") { 
                      $d['bulan'] = "Januari";
                    }elseif ($d['bulan'] == "02") {
                      $d['bulan'] = "Februari";
                    }elseif ($d['bulan'] == "03") {
                      $d['bulan'] = "Maret";
                    }elseif ($d['bulan'] == "04") {
                      $d['bulan'] = "April";
                    }elseif ($d['bulan'] == "05") {
                      $d['bulan'] = "Mei";
                    }elseif ($d['bulan'] == "06") {
                      $d['bulan'] = "Juni";
                    }elseif ($d['bulan'] == "07") {
                      $d['bulan'] = "Juli";
                    }elseif ($d['bulan'] == "08") {
                      $d['bulan'] = "Agustus";
                    }elseif ($d['bulan'] == "09") {
                      $d['bulan'] = "September";
                    }elseif ($d['bulan'] == "10") {
                      $d['bulan'] = "Oktober";
                    }elseif ($d['bulan'] == "11") {
                      $d['bulan'] = "November";
                    }elseif ($d['bulan'] == "12") {
                      $d['bulan'] = "Desember";
                    } 
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $d['kode_opname']; ?></td>
                      <td><?php echo DateToIndo2($d['tanggal']); ?></td>
                      <td><?php echo $d['bulan']; ?></td>
                      <td><?php echo $d['tahun']; ?></td>
                      <td width="10px">
                        <a href="#" data-kode_opname="<?php echo $d['kode_opname']; ?>" class="btn btn-xs btn-primary detail">Detail</a>
                        <a href="#" data-href="<?php echo base_url(); ?>produksi/hapusopname/<?php echo $kode_opname; ?>" class="btn btn-xs btn-danger hapus">Hapus</a>
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

<div class="modal fade" id="detailopname" tabindex="-1" role="dialog">
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
                <div id="loaddetailopname">

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
      var kode_opname  = $(this).attr('data-kode_opname');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>produksi/detail_opname',
        data    : {kode_opname:kode_opname},
        cache   : false,
        success : function(respond){
          $("#loaddetailopname").html(respond);
          $("#detailopname").modal("show");
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