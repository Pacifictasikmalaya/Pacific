
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Pemasukan
      <small>Input Data Pemasukan</small>
    </h2>
  </div>
  <div class="body">
    <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>gudanglogistik/insert_pemasukan">
      <div class="row clearfix">
        <div class="col-sm-6">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="hidden" value="" id="cekdata" name="cekdata" />
              <input type="text" value="" id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" id="tgl_pemasukan" name="tgl_pemasukan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="info-box bg-cyan hover-zoom-effect" style="min-height:170px">
            <div class="icon" style="height:170px; padding:40px 0; width:200px">
              <i class="material-icons">shopping_cart</i>
            </div>
            <div class="content">
              <div id="grandtotal" style="padding:30px 0px 50px 0px; font-size:60px; margin-left:90px"></div>
            </div>
          </div>
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
                <input type="hidden" value="" id="nobpb" name="nobpb" class="form-control" placeholder="No BPB" data-error=".errorTxt19" />
                <input type="hidden" value="" id="kodebarang" name="kodebarang" class="form-control" placeholder="Kode Barang" data-error=".errorTxt19" />
                <input type="text" readonly value="" id="barang" name="barang" class="form-control" placeholder="Nama Barang" data-error=".errorTxt19" />
              </div>
            </div>
            <div class="input-group demo-masked-input"  >
              <div class="form-line">
                <input type="text"  value="" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt19" />
              </div>
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
                <input type="text" style="text-align:right" value="" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" style="text-align:right" value="" id="harga" name="harga" class="form-control" placeholder="Harga" style="text-align:right" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" style="text-align:right" value="" id="kodeakun" name="kodeakun" class="form-control" placeholder="Kode Akun" data-error=".errorTxt19" />
              </div>

            </div>
            <div class="input-group demo-masked-input"  >
              <div class="form-line">
                <input type="text" readonly style="text-align:right" value="" id="namaakun" name="namaakun" class="form-control" placeholder="Nama Akun" data-error=".errorTxt19" />
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
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Kode Akun</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="loadpemasukanbarang">

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

      var kodebarang    = $('#kodebarang').val();

      if (kodebarang != "") {

        $("#tabelakun").load("<?php echo base_url(); ?>gudanglogistik/tabelakun");
        $("#dataakun").modal("show");

      }else{

        swal("Oops!", "Nama Barang Harus Diisi !", "warning");

      }


    });

    $("#barang").click(function(){

      $("#tabelbarang").load("<?php echo base_url(); ?>gudanglogistik/tabelbarang/");
      $("#databarang").modal("show");

    });

    function tampiltemp(){

      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>gudanglogistik/view_detailpemasukan_temp',
        data    : '',
        cache   : false,
        success : function(html){

          $("#loadpemasukanbarang").html(html);

          $('#barang').val("");
          $('#kodeakun').val("");
          $('#kodebarang').val("");
          $('#namaakun').val("");
          $('#jumlah').val("");
          $('#harga').val("");
          $('#keterangan').val("");
          $('#jenisbarang').val("");
          $('#barang').focus();

        }

      });
    }

    $("#tambahbarang").click(function(e){
      e.preventDefault();

      var kodebarang    = $('#kodebarang').val();
      var jumlah        = $('#jumlah').val();
      var harga         = $('#harga').val();
      var kodeakun      = $('#kodeakun').val();
      var keterangan    = $('#keterangan').val();

      if (kodebarang == 0) {

        swal("Oops!", "Nama Barang Harus Diisi !", "warning");

      }else if(jumlah == 0){

        swal("Oops!", "Jumlah Harus Diisi!", "warning");

      }else if(harga == 0){

        swal("Oops!", "Harga Harus Diisi!", "warning");

      }else if(kodeakun == 0){

        swal("Oops!", "Kode Akun Harus Diisi!", "warning");

      }else{

        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>gudanglogistik/inputpemasukan_temp',
          data    :
          {
            kodebarang      : kodebarang,
            jumlah          : jumlah,
            harga           : harga,
            keterangan      : keterangan,
            kodeakun        : kodeakun
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

      var nobukti          = $('#nobukti').val();
      var tgl_pemasukan    = $('#tgl_pemasukan').val();
      var cekdata          = $('#cekdata').val();
      var cekdata          = cekdata.replace(/[^\d]/g,"");

      if (nobukti == 0) {

        swal("Oops!", "No Bukti Harus Diisi!", "warning");
        return false;

      }else if(tgl_pemasukan == 0){

        swal("Oops!", "Tanggal Harus Diisi!", "warning");
        return false;

      }else if(cekdata == 0){

        swal("Oops!", "Barang Masih Kosong!", "warning");
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
