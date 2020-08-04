<?php
function uang($nilai){
  return number_format($nilai,'2',',','.');
}
?>
<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Ledger
          <small>Ledger</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" action="" autocomplete="off">
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="bank" name="bank" data-error=".errorTxt1">
                    <option value="">Semua Bank</option>
                    <?php foreach($lbank as $b){ ?>
                      <option <?php if($bank==$b->kode_bank){echo "selected"; } ?> value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="col-sm-6">
                  <div class="form-line">
                    <input type="text" id="dari" name="dari" value="<?php echo $dari; ?>" class="form-control datepicker date" placeholder="Dari" data-error=".errorTxt11">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-line">
                    <input type="text" id="sampai" value="<?php echo $sampai; ?>" name="sampai" class="form-control datepicker date" placeholder="Sampai" data-error=".errorTxt11">
                  </div>
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
       <div class="row">
        <div class="body">
          <a href="#" class="btn bg-red waves-effect" id="inputledger"> Tambah Data </a>
          <hr>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" >
              <thead style="background-color:#1ab394; color:white">
                <tr>
                  <th>No</th>
                  <th>Tgl</th>
                  <th>No Bukti</th>
                  <th>No Ref</th>
                  <th>TGL Penerimaan</th>
                  <th>Pelanggan</th>
                  <th>Keterangan</th>
                  <th>Kode Akun</th>
                  <th>Akun</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                $saldo = 0;
                foreach ($result as $d){
                  if($d['status_dk']=='K')
                  {
                    $kredit = $d['jumlah'];
                    $debet  = 0;
                    $jumlah = $d['jumlah'];
                  }else{
                    $debet  = $d['jumlah'];
                    $kredit = 0;
                    $jumlah = -$d['jumlah'];
                  }
                  $saldo = $saldo + $jumlah;
                  if($d['no_ref'] !=""){ 
                    if($d['kategori']=='PMB'){
                      $color="#6db5c3"; $text="white";
                    }else if($d['kategori']=='PNJ'){
                      $color="#cf3a7d"; $text="white";
                    }else{
                      $color = ""; $text="";
                    }
                  }else{
                    $color = ""; $text="";
                  } 
                  ?>
                   <tr style="background-color:<?php echo $color;  ?>; color:<?php echo $text; ?>" >
                    <td><?php echo $no; ?></td>
                    <td><?php echo $d['tgl_ledger']; ?></td>
                    <td><?php echo $d['no_bukti'];?></td>
                    <td><?php echo $d['no_ref']; ?></td>
                    <td><?php echo $d['tgl_penerimaan']; ?></td>
                    <td><?php echo $d['pelanggan']; ?></td>
                    <td><?php echo $d['keterangan']; ?></td>
                    <td><?php echo $d['kode_akun']; ?></td>
                    <td><?php echo $d['nama_akun']; ?></td>
                    <td align="right"><?php if($debet!=0){echo uang($debet);}?></td>
                    <td align="right"><?php if($kredit!=0){echo uang($kredit);}?></td>
                    <td>
                      <?php if(empty($d['kategori'])){?>
                        <a href="#" class="btn btn-info btn-xs edit" data-nobukti="<?php echo $d['no_bukti']; ?>">Edit</a>
                        <a href="<?php echo base_url();?>keuangan/hapusledger/<?php echo $d['no_bukti']; ?>" class="btn btn-danger btn-xs hapus">Hapus</a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $no++; } ?>
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
<!--INPUT LEDGER--------------------------------------->
<div class="modal fade" id="ledger" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>
  $(function(){
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

    $("#inputledger").click(function(e){
      e.preventDefault();
      $("#ledger").modal("show");
      $(".modal-content").load("<?php echo base_url();?>keuangan/ledger_input");
    });
    
    $('.hapus').on('click',function(){
      var getLink = $(this).attr('href');
      swal({
        title             : 'Yakin di Hapus ?',
        text              : 'Data Ini Akan Terhapus !',
        html              : true,
        confirmButtonColor: '#d43737',
        showCancelButton  : true,
      },function(){
        window.location.href = getLink
      });
      return false;
    });

    $(".edit").click(function(e){
      e.preventDefault();
      $("#ledger").modal("show");
      var nobukti = $(this).attr("data-nobukti");
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>keuangan/ledger_edit',
        data  : {nobukti:nobukti},
        cache : false,
        success : function(respond)
        {
          $(".modal-content").html(respond);
        }
      });
    });
    
  });
</script>
