<?php
$no = 1;
$grandtotal = 0;
foreach ($detailpmb as $d) {
  $total        = (($d->qty * $d->harga) + $d->penyesuaian);
  $grandtotal   = $grandtotal + $total;
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d->kode_barang; ?></td>
    <td><?php echo $d->nama_barang; ?></td>
    <td><?php echo $d->keterangan; ?></td>
    <td><?php echo $d->qty; ?></td>
    <td align="right"><?php echo number_format($d->harga, '2', ',', '.'); ?></td>
    <td align="right"><?php echo number_format($d->harga * $d->qty, '2', ',', '.'); ?></td>
    <td align="right"><?php echo number_format($d->penyesuaian, '2', ',', '.'); ?></td>
    <td align="right"><?php echo number_format($total, '2', ',', '.'); ?></td>
    <td><?php echo $d->kode_akun; ?></td>
    <td align="right">
      <a href="#" data-kodebarang="<?php echo $d->kode_barang; ?>" data-nobukti="<?php echo $d->nobukti_pembelian; ?>" class="btn bg-primary btn-xs edit"><i class="material-icons">edit</i></a>
      <a href="#" data-kodebarang="<?php echo $d->kode_barang; ?>" data-nobukti="<?php echo $d->nobukti_pembelian; ?>" class="btn bg-red btn-xs hapus"><i class="material-icons">delete</i></a>
    </td>
  </tr>
<?php $no++;
} ?>
<tr>
  <td colspan="8"><b>TOTAL</b></td>
  <td align="right">
    <b><?php echo number_format($grandtotal, '2', ',', '.'); ?></b>
    <input type="hidden" id="grandtot" name="grandtot" value="<?php echo number_format($grandtotal, '2', ',', '.'); ?>">
  </td>
  <td></td>
  <td></td>
</tr>
<script type="text/javascript">
  $(function() {
    function cektutuplaporan() {
      var tgltransaksi = $("#tgl_pembelian").val();
      var jenis = 'penjualan';
      if (tgltransaksi != "") {
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>setting/cektutuplaporan',
          data: {
            tanggal: tgltransaksi,
            jenis: jenis
          },
          cache: false,
          success: function(respond) {
            console.log(respond);
            var status = respond;
            if (status != 0) {
              $(".edit").hide();
              $(".hapus").hide();
            }
          }
        });
      }
    }
    cektutuplaporan();

    function loadgrandtotal() {
      var grandtot = $("#grandtot").val();
      $("#grandtotal").text(grandtot);
    }

    function loadpembelianbarang() {
      var nobukti = $("#nobukti").val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>pembelian/view_detailpembelian',
        data: {
          nobukti: nobukti
        },
        cache: false,
        success: function(respond) {
          $("#loaddetailpmb").html(respond);
        }
      });
    }

    loadgrandtotal();

    $(".hapus").click(function(e) {

      var kodebarang = $(this).attr("data-kodebarang");
      var nobukti = $(this).attr("data-nobukti");
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>pembelian/hapus_detailpembelian',
        data: {
          kodebarang: kodebarang,
          nobukti: nobukti
        },
        cache: false,
        success: function(respond) {
          loadpembelianbarang();
        }
      });
    });


    $(".edit").click(function(e) {
      e.preventDefault();
      var nobukti = $(this).attr("data-nobukti");
      var kodebarang = $(this).attr("data-kodebarang");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>pembelian/editbarang',
        data: {
          nobukti: nobukti,
          kodebarang: kodebarang
        },
        cache: false,
        success: function(respond) {
          $("#loadeditdatabarang").html(respond);
          $("#editdatabarang").modal("show");
        }
      });
    });
  });
</script>