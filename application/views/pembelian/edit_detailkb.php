<form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>pembelian/updatedetailkb">
  <input type="hidden" name="nokontrabon" value="<?php echo $bayar['no_kontrabon']; ?>">
  <input type="hidden" name="nobukti" value="<?php echo $bayar['nobukti_pembelian']; ?>">
  <div class="input-group demo-masked-input"  >
    <span class="input-group-addon">
      <i class="material-icons">chrome_reader_mode</i>
    </span>
    <div class="form-line">
      <input type="text" style="text-align:right" value="<?php echo number_format($bayar['jmlbayar'],'2',',','.'); ?>" id="jmlbayar" name="jmlbayar" class="form-control" placeholder="Jumlah Bayar" data-error=".errorTxt19" />
    </div>
  </div>
  <div class="col-md-offset-10">
    <input type="submit" name="submit" class="btn btn-sm bg-teal  waves-effect" value="UPDATE">
  </div>

</form>
<script>
  var h = document.getElementById('jmlbayar');
  h.addEventListener('keyup', function(e){
    h.value = formatRupiah(this.value, '');
    //alert(b);
  });
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
