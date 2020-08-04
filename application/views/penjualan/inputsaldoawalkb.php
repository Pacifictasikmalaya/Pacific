<form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>penjualan/insertsaldoawalkb">
  <input type="hidden" id="ceksetoran" name="ceksetoran" class="form-control">
  <input type="hidden" readonly  id="getsa" name="getsa" value="0" class="form-control" />
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" id="kode_saldoawal" name="kode_saldoawal" class="form-control" placeholder="Kode Saldo Awal" data-error=".errorTxt11">
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" id="tanggal" name="tanggal" class="form-control datepicker date tanggal" placeholder="Tanggal Saldo Awal" data-error=".errorTxt11">
    </div>
  </div>
  <?php if($cb == 'pusat'){ ?>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control cbg" id="cabang" name="cabang">
        <option value="">Pilih Cabang</option>
        <?php foreach($cabang as $c){ ?>
          <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <?php }else{ ?>
    <input type="hidden" readonly id="cabang" name="cabang" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
  <?php } ?>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control bulan" id="bulan" name="bulan">
        <option value="">Bulan</option>
        <?php for($a=1; $a<=12; $a++){ ?>
          <option value="<?php echo $a;  ?>"><?php echo $bulan[$a]; ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control tahun" id="tahun" name="tahun">
        <option value="">Tahun</option>
        <?php for($t=2019; $t<=$tahun; $t++){ ?>
          <option value="<?php echo $t;  ?>"><?php echo $t; ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <hr>
    <a href="#" id="getsaldo" class="btn btn-sm bg-green  waves-effect">GET SALDO</a>
  <hr>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" id="uangkertas" name="uangkertas" class="form-control" placeholder="Uang Kertas" style="text-align:right" data-error=".errorTxt11">
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" id="uanglogam" name="uanglogam" class="form-control" placeholder="Uang Logam" style="text-align:right" data-error=".errorTxt11">
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" id="giro" name="giro" class="form-control" placeholder="Giro" style="text-align:right" data-error=".errorTxt11">
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" id="transfer" name="transfer" class="form-control" placeholder="Transfer" style="text-align:right" data-error=".errorTxt11">
    </div>
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
<script type="text/javascript">
  var uk = document.getElementById('uangkertas');
  var ul = document.getElementById('uanglogam');
  var gr = document.getElementById('giro');
  var tr = document.getElementById('transfer');
  uk.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    uk.value = formatRupiah(this.value, '');
  });

  ul.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    ul.value = formatRupiah(this.value, '');
  });

  gr.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    gr.value = formatRupiah(this.value, '');
  });

  tr.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    tr.value = formatRupiah(this.value, '');
  });
	/* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		      = number_string.split(','),
    sisa     		      = split[0].length % 3,
    rupiah     		    = split[0].substr(0, sisa),
    ribuan     		    = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }


</script>
<script type="text/javascript">
  $(function(){

    function loadNoMutasi()
    {
      var bulan   = $(".bulan").val();
      var cabang  = $(".cbg").val();
      var tahun   = $(".tahun").val();
      var thn     = tahun.substr(2,2);
      if(parseInt(bulan.length)==1){
        var bln = "0"+bulan;
      }else{
        var bln = bulan;
      }
      var kode    = "SA"+cabang+bln+thn;
      $("#kode_saldoawal").val(kode);
    }
    $('.datepicker').bootstrapMaterialDatePicker({
      format     : 'YYYY-MM-DD',
      clearButton: true,
      weekStart  : 1,
      time       : false
    });
    function loaddetailsaldo()
    {
      var bulan   = $(".bulan").val();
      var cabang  = $(".cbg").val();
      var tahun   = $(".tahun").val();
      var thn     = tahun.substr(2,2);
      if(cabang == ""){
        swal("Oops!", "Cabang Harus Diisi !", "warning");
        return false;
      }else if(bulan == ""){
        swal("Oops!", "Bulan Harus Diisi !", "warning");
        return false;
      }else if(tahun == ""){
        swal("Oops!", "Tahun Harus Diisi !", "warning");
        return false;
      }else if(tanggal == ""){
        swal("Oops!", "Tanggal Harus Diisi !", "warning");
        return false;
      }else{
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>penjualan/getdetailsaldo',
          data    : {bulan:bulan,tahun:tahun,cabang:cabang},
          cache   : false,
          success : function(respond)
          {
            if(respond==1)
            {
              $("#getsa").val(0);
              swal("Oops!", "Saldo Bulan Sebelumnya Belum Diset! Atau Saldo Bulan Tersebut Sudah Ada", "warning");
              nonaktifsaldo();
            }else{
              $("#getsa").val(1);
              aktifsaldo();
              //readonly();
              var data = respond.split("|");
              var kertas  = data[0];
              var logam   = data[1];
              var giro    = data[2];
              var trf     = data[3];
              $("#uangkertas").val(kertas);
              $("#uanglogam").val(logam);
              $("#giro").val(giro);
              $("#transfer").val(trf);
            }
            console.log(respond);
          }
        });
      }

    }
    function nonaktifsaldo()
    {
      $("#uangkertas").attr('disabled','disabled');
      $("#uanglogam").attr('disabled','disabled');
      $("#giro").attr('disabled','disabled');
    }

    function readonly()
    {
      $("#uangkertas").attr('readonly','readonly');
      $("#uanglogam").attr('readonly','readonly');
      $("#giro").attr('readonly','readonly');
    }
    function aktifsaldo()
    {
      $("#uangkertas").removeAttr('disabled');
      $("#uanglogam").removeAttr('disabled');
      $("#giro").removeAttr('disabled');
      $("#uangkertas").removeAttr('readonly');
      $("#uanglogam").removeAttr('readonly');
      $("#giro").removeAttr('readonly');
    }
    nonaktifsaldo();
    $("#getsaldo").click(function(e){
      e.preventDefault();
      loaddetailsaldo();
    });
    $(".cbg").change(function(){
      loadNoMutasi();
    });

    $(".bulan").change(function(){
      loadNoMutasi();
    });

    $(".tahun").change(function(){
      loadNoMutasi();
    });
    $("#formValidate").submit(function(){
      var tanggal = $(".tanggal").val();
      var cabang  = $(".cbg").val();
      var bulan   = $(".bulan").val();
      var tahun   = $(".tahun").val();
      var uk      = $("#uangkertas").val();
      var ul      = $("#uanglogam").val();
      var giro    = $("#giro").val();
      var getsa   = $("#getsa").val();
      if(tanggal == ""){
        swal("Oops!", "Tanggal Harus Diisi.. !", "warning");
        return false;
      }else if(cabang == ""){
        swal("Oops!", "Cabang Harus Diisi.. !", "warning");
        return false;
      }else if(cabang == ""){
        swal("Oops!", "Cabang Harus Diisi.. !", "warning");
        return false;
      }else if(bulan == ""){
        swal("Oops!", "Bulan Harus Diisi.. !", "warning");
        return false;
      }else if(tahun == ""){
        swal("Oops!", "Tahun Harus Diisi.. !", "warning");
        return false;
      }else if(uk == ""){
        swal("Oops!", "Saldo Uang Kertas Harus Diisi.. !", "warning");
        return false;
      }else if(ul == ""){
        swal("Oops!", "Saldo Uang Logam Harus Diisi.. !", "warning");
        return false;
      }else if(ul == ""){
        swal("Oops!", "Saldo Giro Harus Diisi.. !", "warning");
        return false;
      }else if(getsa == 0){
        swal("Oops!", "Lakukan Get Saldo Terlebih Dahulu !", "warning");
        return false;
      }else{
       return true;
      }
    });



  });
</script>
