<?php //var_dump($bank); die; 
?>
<form autocomplete="off" class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>pembelian/proses_kontrabon">
  <table class="table table-bordered table-hover table-striped">
    <tr style="font-weight:bold">
      <td>TERIMA DARI</td>
      <td>TANGGAL</td>
      <td>NO KONTRA BON</td>

    </tr>
    <tr>
      <td>
        <?php echo $kb['nama_supplier']; ?>
        <input type="hidden" name="supplier" value="<?php echo $kb['nama_supplier']; ?>">
      </td>
      <td><?php echo DateToIndo2($kb['tgl_kontrabon']); ?></td>
      <td>
        <?php echo $kb['no_kontrabon']; ?>
        <input type="hidden" name="nokontrabon" value="<?php echo $kb['no_kontrabon']; ?>">
      </td>
    </tr>
  </table>
  <table class="table table-bordered table-hover table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>No Bukti</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      $total = 0;
      foreach ($detail as $d) {
        $total = $total + $d->jmlbayar; ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><a href="#" class="detailpmb2" data-nobukti="<?php echo $d->nobukti_pembelian; ?>"><?php echo $d->nobukti_pembelian; ?></a></td>
          <td><?php echo $d->keterangan; ?></td>
          <td align="right"><?php echo number_format($d->jmlbayar, '2', ',', '.'); ?></td>
        </tr>
      <?php $no++;
      }  ?>
    </tbody>
    <tr>
      <td colspan="3">TOTAL</td>
      <td align="right">
        <b> <?php echo number_format($total, '2', ',', '.'); ?></b>
        <input type="hidden" name="jmlbayar" value="<?php echo $total; ?>">
      </td>
    </tr>
    <tr>
      <td>Terbilang</td>
      <td colspan="3" align="right"><b><?php echo strtoupper(terbilang($total)); ?></b></td>
    </tr>
  </table>
  <div id="loaddetailpmb2">
  </div>
  <!-- <table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <th colspan="6">Detail Pembelian</th>
      </tr>
      <tr>
        <th>No</th>
        <th>No BPB</th>
        <th>Nama Barang</th>
        <th>Ket</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody id="loaddetailpmb2">
    </tbody>
  </table> -->
  <div class="input-group demo-masked-input">
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" value="" id="tglbayar" name="tglbayar" class="form-control datepicker date" placeholder="Tanggal Bayar" required data-error=".errorTxt19" />
    </div>
  </div>

  <div class="form-group" style="z-index:100">
    <div class="form-line">
      <select class="form-control" id="via" name="via" data-error=".errorTxt1" required>
        <option value="">--VIA--</option>
        <?php foreach ($bank as $d) { ?>
          <option value="<?php echo $d->kode_bank; ?>"><?php echo $d->nama_bank; ?></option>
        <?php }  ?>
        <option value="CASH">CASH</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="form-line">
      <select class="form-control show-tick" id="kodeakun" name="kodeakun" data-error=".errorTxt1" required>
        <option value="">--Pilih Akun--</option>
        <option value="2-1300">Hutang Lainnya</option>
        <option value="2-1200">Hutang Dagang</option>
      </select>
    </div>
  </div>
  <div class="form-group nobkk">
    <div class="form-line">
      <input type="text" value="" required id="nobkk" name="nobkk" class="form-control" placeholder="No BKK" required data-error=".errorTxt19" />
    </div>
  </div>
  <div class="form-group keterangan">
    <div class="form-line">
      <input type="text" value="" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required data-error=".errorTxt19" />
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" name="submit" class="btn btn-sm btn-primary">Proses</button>
  </div>
</form>
<script type="text/javascript">
  $(function() {
    function cektutuplaporan() {
      var tgltransaksi = $("#tglbayar").val();
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
              swal("Oops!", "Laporan Untuk Periode Ini Sudah Di Tutup !", "warning");
              $("#tglbayar").val("");
            }
          }
        });
      }
    }
    cektutuplaporan();
    $("#tglbayar").change(function() {
      cektutuplaporan();
    });

    function hidenobkk() {
      $(".nobkk").hide();
      $("#keterangan").val("");
      $("#nobkk").val("-");
      $(".keterangan").show();

    }

    function shownobkk() {
      $(".nobkk").show();

      $("#keterangan").val("-");
      $("#nobkk").val("");
      $(".keterangan").hide();
    }

    hidenobkk();

    //$("#via").selectpicker('refresh');
    $("#via").change(function(e) {
      var via = $(this).val();
      if (via == "KAS KECIL") {
        shownobkk();
      } else {
        hidenobkk();
      }
    });
    $("#kodeakun").selectpicker('refresh');
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

    $(".detailpmb2").click(function(e) {
      e.preventDefault();
      var nobukti = $(this).attr("data-nobukti");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>pembelian/detailpembeliankb',
        data: {
          nobukti: nobukti
        },
        cache: false,
        success: function(respond) {
          $("#loaddetailpmb2").html(respond);
        }
      });
    });

  })
</script>