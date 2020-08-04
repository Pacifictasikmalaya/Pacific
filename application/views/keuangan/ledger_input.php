
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
        <form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>keuangan/insertledger">

          <input type="hidden" id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt11">
          <input type="hidden" id="cekdata" name="cekdata">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" id="tglledger" name="tglledger" class="form-control datepicker date" placeholder="Tanggal" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="noref" name="noref" class="form-control" placeholder="No Ref" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="pelanggan" name="pelanggan" class="form-control" placeholder="Pelanggan" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt11">
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1"
            data-live-search="true">
            <?php foreach($coa as $r){ ?>
              <option value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="input-group demo-masked-input"  >
        <span class="input-group-addon">
          <i class="material-icons">chrome_reader_mode</i>
        </span>
        <div class="form-line">
          <input type="text" id="jumlah" style="text-align:right" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt11">
        </div>
      </div>
      <div class="form-group">
        <div class="form-line">
          <select class="form-control show-tick" id="lbank" name="lbank" data-error=".errorTxt1">
            <?php foreach($lbank as $b){ ?>
              <option value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="errorTxt1"></div>
      </div>
      <div class="input-group demo-masked-input"  >
        <select class="form-control show-tick " id="debetkredit" name="debetkredit" data-error=".errorTxt1">
          <option value="D">Debet</option>
          <option value="K">Kredit</option>
        </select>
      </div>
      <div class="form-group" >
        <a href="#" id="simpantemp" class="btn btn-sm bg-blue m-2-15 waves-effect">
          <i class="material-icons">add_box</i>
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th>No Ref</th>
              <th>Pelanggan</th>
              <th>Jumlah</th>
              <th>Akun</th>
              <th>Bank</th>
              <th>Keterangan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tampiltemp">  

          </tbody>
        </table>
      </div>
      <br>
      <div class="form-group" >
        <button type="submit" id="simpan" name="submit" class="btn bg-blue waves-effect">
          <i class="material-icons"  id="simpan" >save</i>
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

    function tampiltemp(){

      var noref  = $("#noref").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>keuangan/view_templedger',
        data    : 
        {
          noref : noref
        },
        success : function (html) {

          $("#tampiltemp").html(html);

        }
      });

      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>keuangan/cekdata/',
        cache   : false,
        data    : 
        {
          noref : noref
        },
        success :function(respond){

          $("#cekdata").val(respond);

        }

      });
    }

    $("#noref").on('keyup keydown change',function(){

      tampiltemp();

    });


    $("#simpan").click(function(){

      var tglledger       = $("#tglledger").val();
      var cekdata         = $("#cekdata").val();

      if (cekdata == 0 ){

        swal("Oops", "Input Data Terlebih Dahulu", "warning");
        return false;

      } else if (tglledger == "") {

        swal("Oops", "Tanggal Harus Diisi", "warning");
        return false;

      }else{

        return true;

      }

    });

    $("#simpantemp").click(function(e){
      e.preventDefault();

      var noref           = $("#noref").val();
      var pelanggan       = $("#pelanggan").val();
      var tanggal         = $("#tanggal").val();
      var keterangan      = $("#keterangan").val();
      var jumlah          = $("#jumlah").val();
      var kodeakun        = $("#kodeakun").val();
      var lbank           = $("#lbank").val();
      var debetkredit     = $("#debetkredit").val();
      var jumlah          = jumlah.replace(/[^\d]/g,"");

      if (pelanggan == 0) {

        swal("Oops", "Pelanggan Harus Diisi", "warning");
        return false;

      } else if (keterangan == 0) {

        swal("Oops", "Keterangan Harus Diisi", "warning");
        return false;

      } else if (noref == 0) {

        swal("Oops", "No Ref Harus Diisi", "warning");
        return false;

      }  else if (tglledger == 0) {

        swal("Oops", "Tanggal Harus Diisi", "warning");
        return false;

      } else if (jumlah == 0) {

        swal("Oops", "Jumlah Harus Diisi", "warning");
        return false;

      } else {

        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>keuangan/insertledger_temp',
          data    :
          {
            pelanggan       : pelanggan,
            keterangan      : keterangan,
            noref           : noref,
            debetkredit     : debetkredit,
            kodeakun        : kodeakun,
            lbank           : lbank,
            jumlah          : jumlah
          },
          cache   : false,
          success : function(respond){

            tampiltemp();

            $('#pelanggan').val("");
            $('#keterangan').val("");
            $('#jumlah').val("");
            $('#pelanggan').focus();

          }

        });
      }
    });


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

