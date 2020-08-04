
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Update Pembayaran Giro
      <small>Update Data Pembayaran Giro</small>
    </h2>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>pembayaran/editbayargiro">
          <input type="hidden" name="no_giro" value="<?php echo $giro['no_giro']; ?>">
          <input type="hidden" id="statusgiro" name="statusgiro" value="<?php echo $status; ?>">
          <input type="hidden" name="tgl_giro" value="<?php echo $giro['tgl_giro']; ?>">
          <input type="hidden" name="pelanggan" value="<?php echo $giro['nama_pelanggan']; ?>">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <table class="table">
            <tr>
              <td><b>Nama Pelanggan</b></td>
              <td>:</td>
              <td><?php echo $giro['nama_pelanggan']; ?></td>
            </tr>
            <tr>
              <td><b>No Giro</b></td>
              <td>:</td>
              <td><?php echo $giro['no_giro']; ?></td>
            </tr>
            <tr>
              <td><b>Nama Bank</b></td>
              <td>:</td>
              <td><?php echo $giro['namabank']; ?></td>
            </tr>
            <tr>
              <td><b>Jumlah</b></td>
              <td>:</td>
              <td><?php echo number_format($giro['jumlah'],'0','','.'); ?></td>
            </tr>
            <tr>
              <td><b>Jatuh Tempo</b></td>
              <td>:</td>
              <td><?php echo DateToIndo2($giro['tglcair']); ?></td>
            </tr>
          </table>
          <div class="form-group"  >
            <label>Status</label>
             <select class="form-control showtick" id="status" name="status">
              <option value="">-- Pilih Status --</option>
              <option value="1">Diterima</option>
              <option value="2">Ditolak</option>
              <option value="0">Pending</option>
            </select>
            <div class="errorTxt5"></div>
          </div>
          <div id="tanggalcair">
            <label>Tanggal Cair/Diterima</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text"   value="<?php echo date('Y-m-d'); ?>"  id="tglcair" name="tglcair" class="datepicker form-control date" placeholder="Tanggal Cair" data-error=".errorTxt1" />
              </div>
              <div class="errorTxt1"></div>
            </div>
          </div>
          <div id="tanggalditolak">
            <label>Tanggal Ditolak</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text"   value="<?php echo date('Y-m-d'); ?>"  id="tglditolak" name="tglditolak" class="datepicker form-control date" placeholder="Tanggal Ditolak" data-error=".errorTxt1" />
              </div>
              <div class="errorTxt1"></div>
            </div>
          </div>
          <div class="form-group" id="bank" >
            <label>Bank Penerima</label>
             <select class="form-control showtick" id="bank_penerima" name="bank_penerima">
                <option value="">-- Pilih Bank --</option>
                <?php foreach($bank as $b){ ?>
                    <option value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                <?php } ?>
            </select>
            <div class="errorTxt5"></div>
          </div>
          <div id="jumlahbayar">
            <label>Jumlah Bayar</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">account_balance_wallet</i>
              </span>
              <div class="form-line">
                <input  type="text" value="<?php echo $giro['jumlah']; ?>" style="text-align:right" readonly  id="jmlbayar" name="jmlbayar" class="form-control" placeholder="Jumlah Bayar" data-error=".errorTxt2" />
              </div>
              <div id="terbilang" style="float:right;"></div>
              <div class="errorTxt2"></div>
            </div>
          </div>
          <label>Omset Bulan</label>
          <div class="form-group">
            <div class="form-line">
              <select required class="form-control show-tick" id="bulan" name="bulan" data-error=".errorTxt1">
                <option value="">Bulan</option>
                <?php
                  $bulanini = date("m");
                  for($i=1; $i<count($bulan); $i++){
                ?>
                  <option <?php if($bulanini==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <label>Omset Tahun</label>
          <div class="form-group">
            <div class="form-line">
              <select required class="form-control show-tick" id="tahun2" name="tahun" data-error=".errorTxt1">
                <?php
                  $tahunmulai = 2020;
                  
                  for($thn = $tahunmulai; $thn<=date('Y'); $thn++){
                ?>
                  <option <?php if(date('Y')==$thn){echo "Selected";} ?>  value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php 
                  }
                ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <div class="form-group" style="margin-left:10px" >
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

$(function () {

  function cektutuplaporan() {
    var tanggal = $("#tglcair").val();
    var jenis = "penjualan";
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>setting/cektutuplaporan',
      data: { tanggal: tanggal, jenis: jenis },
      cache: false,
      success: function (respond) {
        console.log(respond);
        var status = respond;
        if (status != 0) {
          swal("Oops!", "Laporan Untuk Periode Ini Sudah Di Tutup !", "warning");
          $("#tglcair").val("");
        }
      }
    });
  }

  function cektutuplaporantolak() {
    var tanggal = $("#tglditolak").val();
    var jenis = "penjualan";
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>setting/cektutuplaporan',
      data: { tanggal: tanggal, jenis: jenis },
      cache: false,
      success: function (respond) {
        console.log(respond);
        var status = respond;
        if (status != 0) {
          swal("Oops!", "Laporan Untuk Periode Ini Sudah Di Tutup !", "warning");
          $("#tglcair").val("");
        }
      }
    });
  }
  $("#tglcair").change(function(){
    cektutuplaporan();
  });

  $("#tglditolak").change(function(){
    cektutuplaporantolak();
  });


  $("#bank_penerima").selectpicker("refresh");
  $("#status").selectpicker("refresh");
  function diterima() {

    $("#tanggalcair").show();
    $("#tanggalditolak").hide();
    $("#jumlahbayar").show();
    $("#bank").show();
  }

  function ditolak() {
    $("#tanggalditolak").show();
    $("#tanggalcair").hide();
    $("#jumlahbayar").hide();
    $("#bank").show();
  }

  function hidetanggal() {
    $("#tanggalditolak").hide();
    $("#tanggalcair").hide();
    $("#jumlahbayar").hide();
    $("#bank").hide();
  }

  hidetanggal();
  $("#status").change(function () {

    var status = $("#status").val();

    if (status == 1) {

      diterima();
    } else if (status == 2) {

      ditolak();
    } else {

      hidetanggal();
    }

  });

  $('.datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    clearButton: true,
    weekStart: 1,
    time: false
  });



});

</script>
