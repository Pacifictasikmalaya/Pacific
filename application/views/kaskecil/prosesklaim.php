<form action="<?php echo base_url(); ?>kaskecil/insert_ledger" method="POST" name="prosesklaim" id="prosesklaim">
  <div class="card">
    <div class="header bg-cyan">
      <h2>
        Detail Klaim
        <small>Detail Klaim</small>
      </h2>
    </div>
    <div class="body">
      <div class="row clearfix">
        <div class="col-sm-12">
          <table class="table table-bordered table-hover">
            <tr>
              <td>Kode Klaim</td>
              <td>:</td>
              <td>
                <b><?php echo $klaim['kode_klaim']; ?></b>
                <input type="hidden" name="kode_klaim" value="<?php echo $klaim['kode_klaim']; ?>">
                <input type="hidden" name="kode_cabang" value="<?php echo $klaim['kode_cabang']; ?>">
              </td>
            </tr>
            <tr>
              <td>Tanggal Klaim</td>
              <td>:</td>
              <td><b><?php echo DateToIndo2($klaim['tgl_klaim']); ?></b></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td><b><?php echo $klaim['keterangan']; ?></b></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td>
                <?php
                  if($klaim['status']=='0'){
                    $keterangan = "Belum Di Proses";
                    $color 			= "bg-red";
                  }else{
                    $keterangan = "Sudah di Proses";
                    $color 			= "bg-green";
                  }
                ?>
                <span class="badge <?php echo $color; ?>"><?php echo $keterangan; ?></span>
              </td>

            </tr>
          </table>
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>TGL</th>
                <th>No Bukti</th>
                <th>Keterangan</th>
                <th>Kode Akun</th>
                <th>Penerimaan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
              </tr>
              <tr>
                <th>SALDO AWAL</th>
                <th colspan="5"></th>
                <th style="text-align:right"><?php if(!empty($saldoawal)){echo number_format($saldoawal,'0','','.');}?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                $saldo            = $saldoawal;
                $totalpenerimaan	= 0;
                $totalpengeluaran = 0;
                $totalpenerimaan2 = 0;
                foreach($detail as $d){
                  if($d->status_dk=='K'){
                    $penerimaan   = $d->jumlah;
                    $s 						= $penerimaan;
                    $pengeluaran  = 0;
                  }else{
                    $penerimaan   = 0;
                    $pengeluaran  = $d->jumlah;
                    $s 						= -$pengeluaran;
                  }

                  $saldo              = $saldo + $s;
                  $totalpenerimaan 		= $totalpenerimaan + $penerimaan;
                  $totalpengeluaran		= $totalpengeluaran + $pengeluaran;
                  if($d->keterangan != 'Penerimaan Kas Kecil'){
                    $totalpenerimaan2 = $totalpenerimaan2 + $penerimaan;
                  }
              ?>
              <tr>
                <td><?php echo $d->tgl_kaskecil;?></td>
                <td><?php echo $d->nobukti;?></td>
                <td><?php echo $d->keterangan;?></td>
                <td><?php echo $d->kode_akun."-".$d->nama_akun;?></td>
                <td align="right" style="color:green">
                  <?php if(!empty($penerimaan)){echo number_format($penerimaan,'0','','.');}?></td>
                <td align="right" style="color:red">
                  <?php 	if(!empty($pengeluaran)){echo number_format($pengeluaran,'0','','.');}?></td>
                <td align="right"><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfooter>
              <tr>
                <th colspan="3">TOTAL</th>
                <td align="right" style="color:green">
                  <b><?php if(!empty($totalpenerimaan)){echo number_format($totalpenerimaan,'0','','.');}?></b></td>
                <td align="right" style="color:red">
                  <b><?php 	if(!empty($totalpengeluaran)){echo number_format($totalpengeluaran,'0','','.');}?></b></td>
                <td align="right"><b><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></b></td>
              </tr>
              <tr>
                <td class="bg-green">Penggantian Kas Kecil</td>
                <?php
                  if($klaim['kode_cabang']=='PST'){
                    $penggantian = $totalpengeluaran - $totalpenerimaan2;
                  }else{
                    $penggantian = $totalpengeluaran- $totalpenerimaan2;
                  }
                ?>
                <td colspan="2" align="right">
                  <b><?php 	if(!empty($penggantian)){echo number_format($penggantian,'0','','.');}?></b></td>
                <td class="bg-green">Saldo Awal</td>
                <td colspan="2" align="right">
                  <b><?php 	if(!empty($saldoawal)){echo number_format($saldoawal,'0','','.');}?></b></td>
              </tr>
              <tr>
                <td class="bg-green">Terbilang</td>
                <td colspan="2" align="right"><b><?php  echo ucfirst(terbilang($penggantian)); ?></b></td>
                <td class="bg-green">Penerimaan Pusat</td>
                <td colspan="2" align="right">
                  <b><?php if(!empty($totalpenerimaan)){echo number_format($totalpenerimaan,'0','','.');}?></b></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"></td>
                <td class="bg-green">Total</td>
                <td colspan="2" align="right">
                  <b><?php if(!empty($saldoawal+$totalpenerimaan-$totalpenerimaan2)){echo number_format($saldoawal+$totalpenerimaan-$totalpenerimaan2,'0','','.');}?></b>
                </td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"></td>
                <td class="bg-green">Pengeluaran Kas Kecil</td>
                <td colspan="2" align="right">
                  <b><?php 	if(!empty($totalpengeluaran)){echo number_format($totalpengeluaran,'0','','.');}?></b></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"></td>
                <td class="bg-green">Saldo Akhir</td>
                <td colspan="2" align="right">
                  <b><?php 	if(!empty($saldo)){echo number_format($saldo,'0','','.');}?></b>
                  <input type="hidden" name="saldoakhir" value="<?php echo $saldo; ?>">
                </td>
              </tr>
            </tfooter>
          </table>

          <h2 class="card-inside-title">Tanggal</h2>
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="form-group">
                <div class="form-line focused">
                  <input type="text" id="tanggal" name="tanggal" class="form-control datepicker date"
                    placeholder="Tanggal" data-error=".errorTxt11">
                </div>
              </div>
            </div>
          </div>
          <h2 class="card-inside-title">Keterangan</h2>
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="form-group">
                <div class="form-line focused">
                  <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"
                    data-error=".errorTxt11">
                </div>
              </div>
            </div>
          </div>
          <h2 class="card-inside-title">Jumlah</h2>
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="form-group">
                <div class="form-line focused">
                  <input style="text-align:right" type="text" id="jumlah" name="jumlah" class="form-control"
                    placeholder="Jumlah" data-error=".errorTxt11">
                </div>
              </div>
            </div>
          </div>
          <h2 class="card-inside-title">Bank</h2>
          <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="bank" name="bank" data-error=".errorTxt1">
                    <option value="">-- Pilih Bank --</option>
                    <?php foreach($bank as $b){ ?>
                    <option <?php if($b->kode_bank =='BNI CV'){echo "selected";} ?>
                      value="<?php echo $b->kode_bank; ?>"><?php echo strtoupper($b->nama_bank); ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="body">
              <div class="form-group">
                <button type="submit" name="submit" class="btn bg-blue waves-effect">
                  <i class="material-icons">save</i>
                  <span>SIMPAN</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

  var jumlah = document.getElementById("jumlah");
  jumlah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    jumlah.value = formatRupiah(this.value, "");
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
  }
</script>
<script type="text/javascript">
	$(function(){
		$(".datepicker").bootstrapMaterialDatePicker({
      format: "YYYY-MM-DD",
      clearButton: true,
      weekStart: 1,
      time: false
    });

  $("#bank").selectpicker("refresh");

  $("#prosesklaim").submit(function() {
    var tanggal = $("#tanggal").val();
    var keterangan = $("#keterangan").val();
    var jumlah = $("#jumlah").val();

    if (tanggal == "") {
      swal("Oops!", "Tanggal Masih Kosong!", "warning");
      $("#tanggal").focus();
      return false;
    } else if (keterangan == "") {
      swal("Oops!", "Keterangan Masih Kosong!", "warning");
      $("#keterangan").focus();
      return false;
    } else if (jumlah == "") {
      swal("Oops!", "Jumlah Masih Kosong!", "warning");
      $("#jumlah").focus();
      return false;
    } else {
      return true;
    }
  });

 });
</script>
