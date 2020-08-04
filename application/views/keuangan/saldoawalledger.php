<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA SALDO AWAL LEDGER
          <small>DATA SALDO AWAL LEDGER </small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
        <div class="col-md-12">
            <form class="" method="post" action="" autocomplete="off">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="bank" name="bank" data-error=".errorTxt1">
                    <option value="">BANK</option>
                    <?php foreach($lbank as $b){ ?>
                      <option <?php if($bank == $b->kode_bank){echo "selected";} ?> value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control" id="bulan" name="bulan">
                    <option value="">Bulan</option>
                    <?php for($a=1; $a<=12; $a++){ ?>
                      <option <?php if($bln==$a){echo "selected";} ?> value="<?php echo $a;  ?>"><?php echo $bulan[$a]; ?></option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control" id="tahun" name="tahun">
                    <option value="">Tahun</option>
                    <?php for($t=2019; $t<=$tahun; $t++){ ?>
                      <option <?php if($thn==$t){echo "selected";} ?>  value="<?php echo $t;  ?>"><?php echo $t; ?></option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-offset-10">
                  <input type="submit" name="submit" class="btn bg-blue  waves-effect" value="CARI DATA">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="#" id="setsaldo" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Bank</th>
                    <th>Jumlah</th>
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
                      <td><?php echo DateToIndo2($d['tanggal']); ?></td>
                      <td><?php echo $bulan[$d['bulan']]; ?></td>
                      <td><?php echo $d['tahun']; ?></td>
                      <td><?php echo $d['nama_bank']; ?></td>
                      <td align="right"><?php echo number_format($d['jumlah'],'2',',','.'); ?></td>
                      <td>
                        <a data-href="<?php echo base_url(); ?>keuangan/hapussaldoawalledger/<?php echo $d['kode_saldoawalledger']; ?>" class="btn btn-xs btn-danger hapus">Hapus</a>
                      </td>
                    </tr>
                    <?php
                      $sno++;
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
<div class="modal fade" id="inputsaldoawal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            INPUT SALDO AWAL
            <small>Input Saldo Awal</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loadsaldoawal"></div>
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
    $('#setsaldo').click(function(e){
     e.preventDefault();
     $("#inputsaldoawal").modal("show");
     $("#loadsaldoawal").load('<?php echo base_url(); ?>keuangan/inputsaldoawalledger');
   });


   $('.hapus').click(function(){
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
