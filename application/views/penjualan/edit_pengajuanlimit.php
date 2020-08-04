<form autocomplete="off" class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>penjualan/updatepengajuanlimit">
  <input type="hidden" value="<?php echo $pengajuan['no_pengajuan']; ?>" name="nopengajuan">
  <input type="hidden" value="<?php echo $pengajuan['status']; ?>" name="status">
  <input type="hidden" value="<?php echo $pengajuan['jumlah']; ?>" name="jumlahold">
  <input type="hidden" value="<?php echo $pengajuan['kode_pelanggan']; ?>" name="kodepelanggan">
  <?php
  if (!empty($pengajuan['jumlah_rekomendasi'])) {
    $persentase = ($pengajuan['jumlah_rekomendasi'] - $pengajuan['jumlah']) / $pengajuan['jumlah'] * 100;
  } else {
    $persentase = 0;
  }

  if (!empty($pengajuan['jatuhtempo_rekomendasi'])) {
    $jatuhtempo = $pengajuan['jatuhtempo_rekomendasi'];
  } else {
    $jatuhtempo = $pengajuan['jatuhtempo'];
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="form-label">Jumlah</label>
        <div class="input-icon">
          <input type="text" style="text-align:right" id="jumlah" value="<?php echo number_format($persentase, '0', '', '.'); ?>" name="jumlah" class="form-control" placeholder="Jumlah" />
          <div id="terbilang" style="float:right;"></div>
          <span class="input-icon-addon">
            <i class="fa fa-money"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <label class="form-label">Jatuh Tempo</label>
      <div class="form-group">
        <select id="jatuhtempo" name="jatuhtempo" class="form-select">
          <option value="">Pilih Jatuh Tempo</option>
          <option <?php if ($jatuhtempo == '14') {
                    echo "selected";
                  } ?> value="14">14 Hari</option>
          <option <?php if ($jatuhtempo == '30') {
                    echo "selected";
                  } ?> value="30">30 Hari</option>
          <option <?php if ($jatuhtempo == '45') {
                    echo "selected";
                  } ?> value="45">45 Hari</option>
        </select>
      </div>
    </div>
  </div>
  <small style="color:red">*) Kosongkan Jika Sudah Melakukan Pengajuan Jatuh Tempo</small>
  <div class="row ">
    <div class="form-group">
      <div class="d-flex justify-content-end">
        <button type="submit" name="simpan" class="btn btn-primary btn-block" value="1"><i class="fa fa-save mr-2"></i>SIMPAN</button>
      </div>
    </div>
  </div>
</form>