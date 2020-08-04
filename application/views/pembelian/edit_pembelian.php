
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Pembelian
      <small>Input Data Pembelian</small>
    </h2>
  </div>
  <div class="body">
    <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>pembelian/update_pembelian">
      <div class="row clearfix">
        <div class="col-sm-6">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo $pmb['nobukti_pembelian']; ?>"  id="nobuktinew" name="nobuktinew" class="form-control" placeholder="No Bukti" data-error=".errorTxt19" />
              <input type="hidden" value="<?php echo $pmb['nobukti_pembelian']; ?>" readonly id="nobukti" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">contacts</i>
            </span>
            <div class="form-line">
              <input type="hidden" value="<?php echo $pmb['kode_supplier']; ?>" id="kodesupplier" name="kodesupplier" class="form-control" placeholder="Kode Supplier" data-error=".errorTxt19" />
              <input type="text" value="<?php echo $pmb['nama_supplier']; ?>" id="supplier" name="supplier" class="form-control" placeholder="Supplier" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo $pmb['tgl_pembelian']; ?>" id="tgl_pembelian" name="tgl_pembelian" class="form-control datepicker date" placeholder="Tanggal Pembelian" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="form-group" >
            <div class="form-line">
              <!-- <select disabled class="form-control show-tick" id="departemen" name="departemen" data-error=".errorTxt1">
                <option value="">--Pilih Departemen--</option>
                <?php foreach($pemohon as $d){ ?>
                  <option <?php if($pmb['kode_dept']==$d->kode_dept){ echo "selected";} ?> value="<?php echo $d->kode_dept; ?>"><?php echo $d->nama_dept; ?></option>
                <?php }  ?>
              </select> -->
              <input type="hidden" value="<?php echo $pmb['kode_dept']; ?>" id="departemen" name="departemen" class="form-control" placeholder="Departemen" data-error=".errorTxt19" />
              <input type="text" readonly value="<?php echo $pmb['nama_dept']; ?>" id="dept" name="dept" class="form-control" placeholder="Departemen" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo $pmb['tgl_jatuhtempo']; ?>" id="jatuhtempo" name="jatuhtempo" class="form-control datepicker date" placeholder="Tanggal Jatuh Tempo" data-error=".errorTxt19" />
            </div>
          </div>
          <!-- <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo strtoupper($pmb['jenistransaksi']); ?>" id="jenistransaksi" name="jenistransaksi" class="form-control" placeholder="Jenis Transaksi" readonly data-error=".errorTxt19" />
            </div>
          </div> -->
          <input type="hidden" name="jtold" value="<?php echo $pmb['jenistransaksi'] ?>">
          <div class="form-group" >
            <div class="form-line">

              <select class="form-control show-tick" id="jenistransaksi" name="jenistransaksi" data-error=".errorTxt1">
                <option value="">--Jenis Transaksi--</option>
                <option <?php if($pmb['jenistransaksi']=='tunai'){echo "selected";} ?> value="tunai">Tunai</option>
                <option  <?php if($pmb['jenistransaksi']=='kredit'){echo "selected";} ?> value="kredit">Kredit</option>
              </select>
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
          <div class="col-md-1">
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
          <div class="col-md-2">
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" style="text-align:right" value="" id="penyharga" name="penyharga" class="form-control" placeholder="Penyesuaian Harga" style="text-align:right" data-error=".errorTxt19" />
              </div>
            </div>
          </div>
          <div class="col-md-2">
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
                  <<th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Keterangan</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Subtoal</th>
                  <th>Penyesuaian</th>
                  <th>Total</th>
                  <th>Kode Akun</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="loaddetailpmb">
              </tbody>
            </table>
            <hr>

            <a href="#" id="tambahpenjualan" class="btn btn-sm btn-primary">Tambah Potongan</a>
            <hr>
            <table class="table table-bordered table-primary">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Keterangan</th>
                  <th>Kode Akun</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="loaddatapenjualan">

              </tbody>
            </table>

          </div>
        </div>
      </div>
      <div class="demo-switch">
        <div class="switch">
          <label>Non PPN<input type="checkbox" <?php if($pmb['ppn']==1){ echo "checked";} ?> name="ppn" value='1'><span class="lever"></span>PPN</label>
        </div>

      </div>
      <div class="row clearfix">
        <div class="col-md-offset-10">
          <input type="submit" id="simpan" name="submit" class="btn btn-lg bg-teal  waves-effect" value="SIMPAN">
        </div>
      </div>
    </form>
  </div>
</div>
<!---MODAL DATA SUPPLIER-->
<div class="modal fade" id="datasupplier" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
      <div class="header bg-cyan">
        <h2>
          Data Supplier
          <small>Pilih Data Supplier</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12" id="tabelsupplier">
          </div>
        </div>
      </div>
			</div>
		</div>
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

<!---EDIT DATA BARANG-->
<div class="modal fade" id="editdatabarang" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
      <div class="header bg-cyan">
        <h2>
          Edit Barang
          <small>Edit Data Barang</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12" id="loadeditdatabarang">
          </div>
        </div>
      </div>
			</div>
		</div>
  </div>
</div>
<!---MODAL DATA PENJUALAN-->
<div class="modal fade" id="datapenjualan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
      <div class="header bg-cyan">
        <h2>
          Data Penjualan
          <small>Input Data Penjualan</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12" id="tabelpenjualan">
          </div>
        </div>
      </div>
			</div>
		</div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>
  var h = document.getElementById('harga');
  h.addEventListener('keyup', function(e){
    h.value = formatRupiah(this.value, '');
    //alert(b);
  });
  var p = document.getElementById('penyharga');
  p.addEventListener('keyup', function(e){
    p.value = formatRupiah(this.value, '');
    //alert(b);
  });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d-]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }
  function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
  }
</script>

<script type="text/javascript">
  $(function(){
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
              swal("Oops!", "Laporan Untuk Periode Ini Sudah Di Tutup !", "warning");
              $("#tgl_pembelian").attr('disabled', 'disabled');
              $("#simpan").hide();
              $("#tambahbarang").hide();
              $("#tambahpenjualan").hide();
            }
          }
        });
      }
    }
    cektutuplaporan();
    $(".formValidate").submit(function(){
      var nobukti         = $("#nobukti").val();
      var supplier        = $("#supplier").val();
      var tglpembelian    = $("#tgl_pembelian").val();
      var departemen      = $("#departemen").val();1
      var grandtot        = $("#grandtot").val();
      if(nobukti == "")
      {
        swal("Oops!", "NO Bukti Harus Diisi !", "warning");
        return false;
      }else if(supplier == "")
      {
        swal("Oops!", "Supplier Harus Diisi !", "warning");
        return false;
      }else if(tglpembelian == "")
      {
        swal("Oops!", "Tanggal Pembelian Harus Diisi !", "warning");
        return false;
      }else if(departemen == "")
      {
        swal("Oops!", "Departemen Harus Diisi !", "warning");
        return false;
      }else if(grandtot == "" || grandtot==0)
      {
        swal("Oops!", "Data Barang Masih Kosong !", "warning");
        return false;
      }else{
        return true;
      }
    });


    function loadtabelbarang()
    {
      var departemen = $("#departemen").val();
      //alert(departemen);
      $("#tabelbarang").load("<?php echo base_url(); ?>pembelian/tabelbarangpembelian/"+departemen);
    }

    function loadpembelianbarang()
    {
      var nobukti = $("#nobukti").val();
      $.ajax({
        type   : 'POST',
        url    : '<?php echo base_url(); ?>pembelian/view_detailpembelian',
        data   : {nobukti:nobukti},
        cache  : false,
        success:function(respond)
        {
          $("#loaddetailpmb").html(respond);
        }
      });
    }

    function loadtabelsupplier()
    {
      $("#tabelsupplier").load("<?php echo base_url(); ?>pembelian/tabelsupplieredit");
    }

    loadtabelbarang();
    loadpembelianbarang();
    loadtabelsupplier();

    $("#barang").click(function(){
      var departemen = $("#departemen").val();
      if(departemen =="")
      {
        swal("Oops!", "Departemen Harus Diisi !", "warning");
      }else{
        loadtabelbarang();
        $("#databarang").modal("show");
      }

    });

    $("#supplier").click(function(){
      $("#datasupplier").modal("show");
    });

    function loadakun()
    {
      $("#tabelakun").load("<?php echo base_url(); ?>pembelian/tabelakunpembelian");
    }

    function resetBrg()
    {
      $("#kodebarang").val("");
      $("#barang").val("");
      $("#jumlah").val("");
      $("#keterangan").val("");
      $("#jenisbarang").val("");
      $("#jumlahpengajuan").val("");
      $("#kodeakun").val("");
      $("#namaakun").val("");
    }
    $("#kodeakun").click(function(){
      loadakun();
      $("#dataakun").modal("show");
    });

    $("#tambahbarang").click(function(e){
      e.preventDefault();
      var kodebarang  = $("#kodebarang").val();
      var barang      = $("#barang").val();
      var jumlah      = $("#jumlah").val();
      var keterangan  = $("#keterangan").val();
      var harga       = $("#harga").val();
      var kodeakun    = $("#kodeakun").val();
      var kodedept    = $("#departemen").val();
      var nobukti     = $("#nobukti").val();
      var penyharga   = $("#penyharga").val();
      if(barang ==""){
        swal("Oops!", "Nama Barang Harus Diisi !", "warning");
      }else if(jumlah ==""){
        swal("Oops!", "Jumlah Tidak Boleh Kosong!", "warning");
      }else if(harga ==""){
        swal("Oops!", "Harga Harus Diisi!", "warning");
      }else if(kodeakun ==""){
        swal("Oops!", "Kode Akun Harus Diisi!", "warning");
      }else{
        $.ajax({
          type      : 'POST',
          url       : '<?php echo base_url(); ?>pembelian/insertdetailpembelian',
          data      : {nobukti:nobukti,kodebarang:kodebarang,jumlah:jumlah,harga:harga,kodeakun:kodeakun,keterangan:keterangan,penyharga:penyharga},
          cache     : false,
          success   : function(respond){
            if(respond == 1){
            swal("Oops!", "Data Sudah Di Inputkan!", "warning");
            }
            loadpembelianbarang();
            resetBrg();
          }
        });
      }
    });

    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });

    $("#tambahpenjualan").click(function(e){
      e.preventDefault();
      var nobukti = $("#nobukti").val();
      var jenistransaksi = $("#jenistransaksi").val();
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>pembelian/inputpenjualan',
        data  : {nobukti:nobukti,jenistransaksi:jenistransaksi},
        cache : false,
        success : function(respond)
        {
          $("#tabelpenjualan").html(respond);
          $("#datapenjualan").modal("show");
        }
      });
    });

    function loaddatapenjualan()
    {
      var nobukti = $("#nobukti").val();
      $.ajax({
        type   : 'POST',
        url    : '<?php echo base_url(); ?>pembelian/loaddatapenjualan',
        data   : {nobukti:nobukti},
        cache  : false,
        success: function (respond)
        {
          $("#loaddatapenjualan").html(respond);
        }
      });
    }

    loaddatapenjualan();
  });
</script>
