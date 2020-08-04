<form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>penjualan/insertbelumsetorsales">
  <input type="hidden" id="ceksetoran" name="ceksetoran" class="form-control">
  <input type="hidden" readonly  id="getsa" name="getsa" value="0" class="form-control" />
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" id="kodebelumsetor" name="kodebelumsetor" class="form-control" placeholder="Kode Belum Setor" data-error=".errorTxt11">
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">date_range</i>
    </span>
    <div class="form-line">
      <input type="text" id="tanggal" name="tanggal" class="form-control datepicker date tanggal" placeholder="Tanggal" data-error=".errorTxt11">
    </div>
  </div>
  <?php if($cb == 'pusat'){ ?>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control cbg" id="cabanginput" name="cabang2">
        <option value="">Pilih Cabang</option>
        <?php foreach($cabang as $c){ ?>
          <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <?php }else{ ?>
    <input type="hidden" readonly id="cabanginput" name="cabang2" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
  <?php } ?>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control bulan" id="bulan2" name="bulan">
        <option value="">Bulan</option>
        <?php for($a=1; $a<=12; $a++){ ?>
          <option value="<?php echo $a;  ?>"><?php echo $bulan[$a]; ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group" >
    <div class="form-line">
      <select class="form-control tahun" id="tahun2" name="tahun">
        <option value="">Tahun</option>
        <?php for($t=2019; $t<=$tahun; $t++){ ?>
          <option value="<?php echo $t;  ?>"><?php echo $t; ?></option>
         <?php } ?>
      </select>
    </div>
  </div>
  <hr>
  <label>Salesman</label>
  <div class="form-group">
    <div class="form-line">
      <select class="form-control show-tick salesman" id="salesman2" name="salesman" data-error=".errorTxt1">
        <option value="">Pilih Salesman</option>
      </select>
    </div>
    <div class="errorTxt1"></div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" id="uangkertas" name="jumlah" class="form-control" placeholder="Jumlah" style="text-align:right" data-error=".errorTxt11">
    </div>
  </div>
  
  
  <div style="float:right">
    <hr>
    <a href="#" id="tambahsaldosales" class="btn btn-success btn-xs">Tambah</a>
    <hr>
  </div>
  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Salesman</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="loadsalestemp">

    </tbody>
  </table>
  <div style="color:red; float:right">
    <div class="form-group">
      <button type="submit"  name="submit" class="btn bg-blue waves-effect">
        <i class="material-icons">save</i>
        <span>SIMPAN</span>
      </button>
      <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
        <i class="material-icons">cancel</i>
        <span>Batal</span>
      </button>
    </div>
  </div>
  
</form>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  var uk = document.getElementById('uangkertas');
  var ul = document.getElementById('uanglogam');
  
  uk.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    uk.value = formatRupiah(this.value, '');
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
    $("#cabanginput").selectpicker("refresh");
    $(".bulan").selectpicker("refresh");
    $(".tahun").selectpicker("refresh");
    $(".salesman2").selectpicker("refresh");
    function loadsales(){
      var cabang = $("#cabanginput").val();
    //alert(cabang);
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url();?>laporanpenjualan/get_salesman',
        data    : {cabang:cabang},
        cache   : false,
        success : function(respond){
          $("#salesman2").html(respond);
          $("#salesman2").selectpicker("refresh");
        }
      });
    }
    loadsales();
    $("#cabanginput").change(function(){
      loadsales();
    });
    function loadNoMutasi()
    {
      var bulan   = $("#bulan2").val();
      var cabang  = $("#cabanginput").val();
      var tahun   = $("#tahun2").val();
      var thn     = tahun.substr(2,2);
      if(parseInt(bulan.length)==1){
        var bln = "0"+bulan;
      }else{
        var bln = bulan;
      }
      var kode    = "SABS"+cabang+bln+thn;
      $("#kodebelumsetor").val(kode);
    }

    $('.datepicker').bootstrapMaterialDatePicker({
      format     : 'YYYY-MM-DD',
      clearButton: true,
      weekStart  : 1,
      time       : false
    });

    function loadsalestemp()
    {
      var bulan     = $("#bulan2").val();
      var cabang    = $("#cabanginput").val();
      var tahun     = $("#tahun2").val();

      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>penjualan/getbelumsetortemp',
        data    : {bulan:bulan,tahun:tahun,cabang:cabang},
        cache   : false,
        success : function(respond)
        {
          $("#loadsalestemp").html(respond);
        }
      });
    }
    
   
    $("#cabanginput").change(function(){
      loadNoMutasi();
      loadsalestemp();
    });

    $("#bulan2").change(function(){
      loadNoMutasi();
      loadsalestemp();
    });

    $("#tahun2").change(function(){
      loadNoMutasi();
      loadsalestemp();
    });

    $("#tambahsaldosales").click(function(e){
      e.preventDefault();
      //alert('test');
      //var getsa = $("#getsa").val();
      var bulan = $("#bulan2").val();
      var tahun = $("#tahun2").val();
      var salesman = $("#salesman2").val();
      var jumlah = $("#uangkertas").val();
      if(bulan == ""){
        swal("Oops!", "Bulan Harus Diisi !", "warning");
      }else if(tahun == ""){
        swal("Oops!", "Tahun Harus Diisi !", "warning");
      }else if(salesman == ""){
        swal("Oops!", "Salesman Harus Diisi !", "warning");
      }else if(jumlah == ""){
        swal("Oops!", "Jumlah Harus Diisi !", "warning");
      }else{
        $.ajax({
          type : 'POST',
          url : '<?php echo base_url(); ?>penjualan/simpanbelumsetortemp',
          data : {bulan:bulan,tahun:tahun,salesman:salesman,jumlah:jumlah},
          cache : false,
          success : function(respond)
          {
            if (respond == 1){
              swal("Oops!", "Data Sudah Ada.. !", "warning");
            }
            loadsalestemp();
          }
        });
      }
    });
    $("#formValidate").submit(function(){
      var tanggal = $(".tanggal").val();
      var cabang  = $("#cabanginput").val();
      var bulan   = $("#bulan2").val();
      var tahun   = $("#tahun2").val();
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
      }else{
       return true;
      }
    });



  });
</script>
