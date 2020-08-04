
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Pengeluaran
      <small>Input Data Pengeluaran</small>
    </h2>
  </div>
  <div class="body">
    <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>produksi/insert_pengeluaran">
      <div class="row clearfix">
        <div class="col-sm-6">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" value="" id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" value="" id="tgl_pengeluaran" name="tgl_pengeluaran" class="form-control datepicker date" placeholder="Tanggal pengeluaran" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="form-group" >
            <div class="form-line">
              <select class="form-control show-tick" id="departemen" name="departemen" data-error=".errorTxt1">
                <option value="">--Pilih Jenis Pengeluaran--</option>
                <option value="Pemakaian">Pemakaian</option>
                <option value="Retur Out">Retur Out</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-6">

        </div>
      </div>
      <div class="row">
        <div class="body">
          <div class="col-md-3">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="hidden" value="" id="kode_edit" name="kode_edit" class="form-control" data-error=".errorTxt19" />
                <input type="hidden" value="" id="kodebarang" name="kodebarang" class="form-control" placeholder="Kode Barang" data-error=".errorTxt19" />
                <input type="text" readonly value="" id="barang" name="barang" class="form-control" placeholder="Nama Barang" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="" id="jenisbarang" name="jenisbarang" class="form-control" placeholder="Jenis Barang" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" style="text-align:right" value="" id="qty" name="qty" class="form-control" placeholder="QTY" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text"  value="" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <a href="#" id="tambahbarang" class="btn bg-blue waves-effect">
              <i class="material-icons">add_shopping_cart</i>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="body">
          <div class="col-md-12">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Keterangan</th>
                  <th>Qty</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="loadpengeluaranbarang">

              </tbody>
            </table>
          </div>
        </div>
      </div>


      <div class="row clearfix">
        <div class="col-md-offset-10">
          <input type="submit" name="submit" id="simpan" class="btn btn-lg bg-teal  waves-effect" value="SIMPAN">
        </div>
      </div>
      
    </form>
  </div>
</div>
<!---MODAL DATA BARANG-->
<div class="modal fade" id="databarang" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Data Barang
            <small>Pilih Data Barang</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12" id="tabelbarang">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!---MODAL DATA AKUN-->
<div class="modal fade" id="dataakun" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Data Akun
            <small>Pilih Data Akun</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12" id="tabelakun">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>

  $(function(){

    function formatAngka(angka) {
      if (typeof(angka) != 'string') angka = angka.toString();
      var reg = new RegExp('([0-9]+)([0-9]{3})');
      while(reg.test(angka)) angka = angka.replace(reg, '$1,$2');
      return angka;
    }

    $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url();?>produksi/codeotomatispengeluaran',
      data    : '',
      success : function (respond) {

        $("#nobukti").val(respond);

      }
    });

    tampiltemp();

    $('#harga,#jumlah').on("input",function(){

      var harga     = $('#harga').val();
      var jumlah    = $('#jumlah').val();

      var harga     = harga.replace(/[^\d]/g,"");
      var jumlah    = jumlah.replace(/[^\d]/g,"");

      $('#harga').val(formatAngka(harga*1));
      $('#jumlah').val(formatAngka(jumlah*1));

    });

    $("#kodeakun").click(function(){

      $("#tabelakun").load("<?php echo base_url(); ?>produksi/tabelakun");
      $("#dataakun").modal("show");

    });

    $("#barang").click(function(){

      $("#tabelbarang").load("<?php echo base_url(); ?>produksi/tabelbarang/");
      $("#databarang").modal("show");
      $('#kode_edit').val("");

    });

    function tampiltemp(){

      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>produksi/view_detailpengeluaran_temp',
        data    : '',
        cache   : false,
        success : function(html){

          $("#loadpengeluaranbarang").html(html);

          $('#barang').val("");
          $('#kodeakun').val("");
          $('#kodebarang').val("");
          $('#namaakun').val("");
          $('#qty').val("");
          $('#kode_edit').val("");
          $('#keterangan').val("");
          $('#jenisbarang').val("");
          $('#kode_edit').val("");

        }

      });
    }

    $("#tambahbarang").click(function(e){
      e.preventDefault();

      var kodebarang    = $('#kodebarang').val();
      var keterangan    = $('#keterangan').val();
      var qty           = $('#qty').val();
      var kode_edit     = $('#kode_edit').val();

      if (kodebarang == 0) {

        swal("Oops!", "Nama Barang Harus Diisi !", "warning");

      }else if (qty == "") {

        swal("Oops!", "QTY Masih Kosong !", "warning");

      }else{

        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>produksi/inputpengeluaran_temp',
          data    :
          {
            kodebarang      : kodebarang,
            kode_edit       : kode_edit,
            qty             : qty,
            keterangan      : keterangan
          },
          cache   : false,
          success : function(respond){

            if(respond == 1){
              swal("Oops!", "Data Sudah Di Inputkan!", "warning");
            }

            tampiltemp();
            $('#barang').focus();

          }

        });

      }
    });

    $("#simpan").click(function(){

      var nobukti           = $('#nobukti').val();
      var tgl_pengeluaran   = $('#tgl_pengeluaran').val();
      var departemen        = $('#departemen').val();

      if (nobukti == 0) {

        swal("Oops!", "No Bukti Harus Diisi!", "warning");
        return false;

      }else if(tgl_pengeluaran == ""){

        swal("Oops!", "Tanggal Harus Diisi!", "warning");
        return false;

      }else if(departemen == ""){

        swal("Oops!", "Jenis Pengeluaran Masih Kosong!", "warning");
        return false;

      }else{

        return true;

      }

    });

    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });

  });

</script>
