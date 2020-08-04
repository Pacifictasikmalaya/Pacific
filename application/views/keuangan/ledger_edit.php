
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Input Ledger
      <small>Input Ledger</small>
    </h2>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>keuangan/updateledger">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo $ledger['no_bukti']; ?>" readonly id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" id="tglledger" value="<?php echo $ledger['tgl_ledger']; ?>" name="tglledger" class="form-control datepicker date" placeholder="Tanggal" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="noref" value="<?php echo $ledger['no_ref']; ?>" name="noref" class="form-control" placeholder="No Ref" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="pelanggan" value="<?php echo $ledger['pelanggan']; ?>" name="pelanggan" class="form-control" placeholder="Pelanggan" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="keterangan" value="<?php echo $ledger['keterangan']; ?>" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1"
              data-live-search="true">
              <?php foreach($coa as $r){ ?>
              <option <?php if($ledger['kode_akun']==$r->kode_akun){echo "selected";} ?> value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?>
              </option>
              <?php } ?>
            </select>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="jumlah" value="<?php echo number_format($ledger['jumlah'],'2',',','.'); ?>" style="text-align:right" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt11">
            </div>
          </div>
          <div class="form-group">
            <div class="form-line">
              <select class="form-control show-tick" id="lbank" name="lbank" data-error=".errorTxt1">
                <?php foreach($lbank as $b){ ?>
                  <option <?php if($ledger['bank']==$b->kode_bank){echo "selected";} ?> value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <div class="input-group demo-masked-input"  >
            <select class="form-control show-tick " id="debetkredit" name="debetkredit" data-error=".errorTxt1">
              <option <?php if($ledger['status_dk']=='D'){echo "selected";} ?> value="D">Debet</option>
              <option <?php if($ledger['status_dk']=='K'){echo "selected";} ?> value="K">Kredit</option>
            </select>
          </div>
          <div class="form-group" >
            <button type="submit"  name="submit" class="btn bg-blue waves-effect">
              <i class="material-icons">save</i>
              <span>SIMPAN</span>
            </button>
            <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
              <i class="material-icons">cancel</i>
              <span>Batal</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  var jml = document.getElementById("jumlah");
    jml.addEventListener("keyup", function(e) {
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    jml.value = formatRupiah(this.value, "");
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
  });

</script>
<script>
  $(function(){
    $("#kodeakun").selectpicker("refresh");
    $("#debetkredit").selectpicker("refresh");
    $("#lbank").selectpicker("refresh");

    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY-MM-DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

  });
</script>

