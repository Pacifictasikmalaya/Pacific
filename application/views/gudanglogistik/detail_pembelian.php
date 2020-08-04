<table class="table table-bordered table-hover table-striped">
  <tr style="font-weight:bold">
    <td>Tanggal</td>
    <td>NO Bukti</td>
    <td>Supplier</td>
    <td>Departemen</td>
  </tr>
  <tr>
    <td><?php echo DateToIndo2($pmb['tgl_pembelian']); ?></td>
    <td><?php echo $pmb['nobukti_pembelian']; ?></td>
    <td><?php echo $pmb['nama_supplier']; ?></td>
    <td><?php echo $pmb['nama_dept']; ?></td>
  </tr>
</table>
<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Ket</th>
      <th>Qty</th>
      <th>Harga</th>
      <th>Total</th>
      <th>Akun</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no     = 1; 
    $total  = 0; 
    foreach($detail as $d){  
      $total = $total + ($d->qty * $d->harga); 
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->kode_barang; ?></td>
        <td><?php echo $d->nama_barang; ?></td>
        <td><?php echo $d->keterangan; ?></td>
        <td><?php echo $d->qty; ?></td>
        <td align="right"><?php echo number_format($d->harga,'2',',','.'); ?></td>
        <td align="right"><?php echo number_format($d->qty * $d->harga,'2',',','.'); ?></td>
        <td><?php echo $d->kode_akun; ?> <?php echo $d->nama_akun; ?></td>
      </tr>
      <?php 
      $no++; 
    }  
    ?>
    <tr>
      <th colspan="6">TOTAL PEMBELIAN</th>
      <td align="right"><b> <?php echo number_format($total,'2',',','.'); ?></b></td>
    </tr>
  </tbody>
</table>
<div class="form-group" >
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" id="tgl_pemasukan2" name="tgl_pemasukan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="col-md-offset-11">
    <a href="#" data-nobukti="<?php echo $pmb['nobukti_pembelian']; ?>" class="btn btn-md btn-success approve">Approve</a>
  </div>
</div>

<script type="text/javascript">
  $(function(){

    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });


    $(".approve").click(function(e){
      e.preventDefault();

      var nobukti       = $(this).attr("data-nobukti");
      var tgl_pemasukan = $('#tgl_pemasukan2').val();
      //var datepicker    = $('.datepicker').val();

      if (tgl_pemasukan == "") {

        swal("Oops!", "Silahkan Pilih Tanggal terlebih dahulu!", "warning");

      }else{

        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>gudanglogistik/insert_pembelian',
          data    :
          {
            nobukti         : nobukti,
            tgl_pemasukan   : tgl_pemasukan
          },
          cache   : false,
          success : function(){

            window.location.reload(false); 

          }

        });
      }

    });
  });
</script>