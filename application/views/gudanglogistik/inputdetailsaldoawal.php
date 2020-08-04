
<div class="row clearfix">
  <div class="col-md-8">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
         INPUT SALDOAWAL STOK
         <small>Input SALDOAWAL STOK</small>
       </h2>
     </div>
     <div class="body">
      <div class="row">
        <div class="col-md-12">
          <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>gudanglogistik/input_saldoawal">
            <label>Kode Saldoawal</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['kode_saldoawal_gl'];?>" id="kode_saldoawal_gl" name="kode_saldoawal_gl" class="form-control" placeholder="Kode saldoawal Awal" data-error=".errorTxt19" />
              </div>
            </div>
            <label>Bulan</label>
            <div class="input-group demo-masked-input">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['bulan'];?>" id="bulan" name="bulan" class="form-control" data-error=".errorTxt19" />
              </div>
            </div>
            <label>Tahun</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['tahun'];?>" id="tahun" name="tahun" class="form-control" data-error=".errorTxt19" />
              </div>
            </div>
            <label>Kode Kategori</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['kode_kategori'];?>" id="kode_kategori" name="kode_kategori" class="form-control" data-error=".errorTxt19" />
              </div>
            </div>
            <label>Nama Katgeori</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['kategori'];?>" class="form-control" data-error=".errorTxt19" />
              </div>
            </div>
            <label>Tanggal Input</label>
            <div class="input-group demo-masked-input"  >
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text" readonly value="<?php echo $saldoawal['tanggal'];?>" id="tanggal" name="tanggal" class="form-control datepicker" placeholder="Tanggal" data-error=".errorTxt19" />
              </div>
            </div>
            <hr>
            <div class="row clearfix">
              <div class="col-md-offset-10">
              </div>
            </div>
            <hr>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th><a href="#" class="btn btn-sm bg-blue waves-effect" id="barang">Barang</a></th>
                  <th id="kode_saldoawal_gl2"></th>
                  <th hidden=""><input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Kode Barang"></th>
                  <th hidden=""><input type="text" name="kode_edit" id="kode_edit" class="form-control" placeholder="Kode Edit"></th>
                  <th><h5 id="kode_barang2"></h5></th>
                  <th><h5 id="nama_barang"></h5></th>
                  <th><input type="text" name="qty" id="qty" class="form-control" placeholder="Qty"></th>
                  <th><input type="text" name="harga" id="harga" class="form-control" placeholder="Harga"></th>
                  <th><a href="#" id="getsaldoawal" class="btn btn-sm bg-green  waves-effect">GET</a> | <a href="#" class="btn btn-sm bg-blue waves-effect simpan">Ok</a></th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th style="text-align:left">No</th>
                  <th style="text-align:left;width: 150px">Kode Saldoawal</th>
                  <th style="text-align:left;width: 150px">Kode Barang</th>
                  <th style="text-align:left">Nama Barang</th>
                  <th style="text-align:left;width: 150px">Qty</th>
                  <th style="text-align:left;width: 150px">Harga</th>
                  <th style="text-align:left;width: 150px">Aksi</th>
                </tr>
              </thead>
              <tbody id="loaddetailsaldoawal">

              </tbody>
            </table>
          </form>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-sm-12">

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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
    $("#qty").focus();

    // $("#getsaldoawal").click(function(e){
    //   e.preventDefault();
    //   loaddetailsaldoawal();
    // });

    function loaddetailsaldo()
    {
      var bulan                   = $("#bulan").val();
      var tahun                   = $("#tahun").val();
      var kode_barang             = $("#kode_barang").val();
      var kode_kategori           = $("#kode_kategori").val();
      var thn                     = tahun.substr(2,2);
      if(bulan == ""){
        swal("Oops!", "Bulan Harus Diisi !", "warning");
        return false;
      }else if(tahun == ""){
        swal("Oops!", "Tahun Harus Diisi !", "warning");
        return false;
      }else{
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>gudanglogistik/gethasildetailsaldo',
          data    : {bulan:bulan,tahun:tahun,kode_kategori:kode_kategori,kode_barang:kode_barang},
          cache   : false,
          success : function(respond)
          {
            $("#qty").val(respond);
          }
        });
      }
    }
    
    $("#getsaldoawal").click(function(e){
      e.preventDefault();
      loaddetailsaldo();
    });


    loaddetailsaldoawal();
    function loaddetailsaldoawal()
    {
      var kode_saldoawal_gl = $("#kode_saldoawal_gl").val();
      var tahun          = $("#tahun").val();
      var bulan          = $("#bulan").val();
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>gudanglogistik/getdetailsaldo',
        data    : 
        {
          kode_saldoawal_gl : kode_saldoawal_gl,
          bulan          : bulan,
          tahun          : tahun
        },
        cache   : false,
        success : function(respond)
        {
          $("#loaddetailsaldoawal").html(respond);
        }
      });
    }

    function simpansaldoawal()
    {
      var kode_saldoawal_gl = $("#kode_saldoawal_gl").val();
      var qty            = $("#qty").val();
      var harga          = $("#harga").val();
      var kode_barang    = $("#kode_barang").val();
      var kode_edit      = $("#kode_edit").val();

      if (kode_barang == "") {
        swal(
          'Peringatan',
          'Silahkan pilih dulu barang seblum isi saldoawal',
          'warning'
          );

      }else{
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>gudanglogistik/simpansaldoawal',
          data    : 
          {
            kode_saldoawal_gl   : kode_saldoawal_gl,
            kode_edit           : kode_edit,
            harga               : harga,
            qty                 : qty,
            kode_barang         : kode_barang
          },
          cache   : false,
          success : function(respond)
          {
            loaddetailsaldoawal();
            $("#loaddetailsaldoawal").html(respond);
            $("#kode_barang").val("");
            $("#kode_barang2").html("");
            $("#kode_saldoawal_gl2").html("");
            $("#nama_barang").html("");
            $("#harga").val("");
            $("#qty").val("");
            $("#kode_edit").val("");
          }
        });
      }
    }

    $("#barang").click(function(){
      var kode_kategori  = $("#kode_kategori").val();
      var tahun          = $("#tahun").val();
      var bulan          = $("#bulan").val();
     // alert(kode_kategori);

     $.ajax({
      type    : 'POST',
      url     : '<?php echo base_url(); ?>gudanglogistik/tabelbarangsaldoawal',
      data    : {
        kode_kategori  : kode_kategori,
        bulan          : bulan,
        tahun          : tahun
      },
      cache   : false,
      success : function(respond)
      {
        $("#tabelbarang").html(respond);
        $("#databarang").modal("show");
      }
    });
   });
    
    $(".simpan").click(function(e){
      e.preventDefault();
      simpansaldoawal();
    });

  });
</script>
