<form autocomplete="off" class="formValidate" id="EditDetailBarang"  method="POST" action="<?php echo base_url(); ?>pembelian/update_detailbarang">
  <input type="hidden" name="nobukti" value="<?php echo $brg['nobukti_pembelian']; ?>">
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" value="<?php echo $brg['kode_barang']; ?>" readonly id="kodebarang" name="kodebarang" class="form-control" placeholder="Kode Barang" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" readonly value="<?php echo $brg['nama_barang']; ?>" id="nama_barang" name="nama_barang" class="form-control" placeholder="Nama Barang" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" value="<?php echo $brg['keterangan']; ?>" id="keteranganedit" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" value="<?php echo $brg['qty']; ?>" id="qtyedit" name="qty" class="form-control" placeholder="Qty" data-error=".errorTxt19" />
    </div>
  </div>
  
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" style="text-align:right" value="<?php echo number_format($brg['harga'],'2',',','.'); ?>" id="hargaedit" name="harga" class="form-control" placeholder="Harga" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" style="text-align:right" value="<?php echo number_format($brg['penyesuaian'],'2',',','.'); ?>" id="penyedit" name="penyharga" class="form-control" placeholder="Penyesuaian" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="input-group" >
    <div class="form-line">
      <select class="form-control show-tick " id="coa" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
        <?php foreach($coa as $r){ ?>
        <option <?php if($brg['kode_akun']==$r->kode_akun){echo "selected"; } ?> value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
        <?php } ?>
      </select>
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/forms/advanced-form-elements.js"></script>
<script>
  var h = document.getElementById('hargaedit');
  h.addEventListener('keyup', function(e){
    h.value = formatRupiah(this.value, '');
    //alert(b);
  });

  // var p = document.getElementById('penyhargaedit');
  // p.addEventListener('keyup', function(e){
  //   p.value = formatRupiah(this.value, '');
  //   //alert(b);
  // });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
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
      $("#coa").selectpicker('refresh');
      $("#EditDetailBarang").submit(function(){
        var kodeakun    = $("#coa").val();
        var keterangan  = $("#keteranganedit").val();
        var qty         = $("#qtyedit").val();
        var harga       = $("#hargaedit").val();
        if(kodebarang=="")
        {
          swal("Oops!", "Kode Barang Harus Diisi !", "warning");
          return false;
        }else if(qty=="")
        {
          swal("Oops!", "Qty Harus Diisi !", "warning");
          return false;
        }else if(keterangan=="")
        {
          swal("Oops!", "Keterangan Harus Diisi !", "warning");
          return false;
        }else if(kodeakun=="")
        {
          swal("Oops!", "Kode Akun Harus Diisi !", "warning");
          return false;
        }else if(harga=="")
        {
          swal("Oops!", "Harga Harus Diisi !", "warning");
          return false;
        }else{
          return true;
        }
      });

    });

</script>
