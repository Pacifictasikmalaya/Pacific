
<div class="card">
    <div class="header bg-cyan">
        <h2>
            Edit Pembayaran Kurang / lebih Setor <?php echo $kl['pembayaran']; ?>
            <small>Pembayaran Kurang / lebih Setor</small>
        </h2>
        
    </div>
    <div class="body">
        <div class="row clearfix">
            <div class="col-sm-12">
                 <form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>penjualan/editkuranglebihsetor">
                    <input type="hidden" value="<?php echo $kl['kode_kl']; ?>" name="kode_kl">
                    <label>Tgl Pembayaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" value="<?php echo $kl['tgl_kl'] ?>" id="tglbayarkl" name="tglbayarkl" class="form-control datepicker date" placeholder="Tanggal Pembayaran" data-error=".errorTxt11">
                        </div>
                    </div>
                    
                    <?php if ($sess_cab == 'pusat'){ ?>
                        <label>Cabang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select disabled class="form-control show-tick" id="cabangkb" name="cabangkb" data-error=".errorTxt1">
                                    <option value="">-- Pilih Cabang --</option>
                                    <?php foreach($cabang as $c){ ?>
                                        <option <?php if($kl['kode_cabang']==$c->kode_cabang){ echo "selected";} ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="errorTxt1"></div>
                        </div>
                    <?php }else{ ?>                    
                        <input type="hidden" name="cabangkb" id="cabangkb" value="<?php echo $kl['kode_cabang']; ?>" >
                    <?php } ?>                
                
                    <label>Salesman</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select disabled class="form-control show-tick" id="salesmankb" name="salesmankb" data-error=".errorTxt1">
                                <option value="<?php echo $kl['id_karyawan'] ?>"><?php echo $kl['nama_karyawan'] ?></option>
                            </select>
                        </div>
                        <div class="errorTxt1"></div>
                    </div>
                    <label style="margin-bottom:2px; !important">Uang Kertas</label>
                    <div class="form-group" style="margin-bottom:2px; !important">
                        <div class="form-line">
                            <input type="text"  value="<?php echo number_format($kl['uang_kertas'],'0','','.'); ?>" onkeyup="calc()" style="text-align:right; font-weight:bold; color:#dc3545" id="uangkertas" name="uangkertas" class="form-control" placeholder="Uang Kertas" data-error=".errorTxt11">
                        </div>
                        <div id="terbilanguangkertaslogam" style="float:right; color:#dc3545"></div>
                    </div>
               
                   
                    <label style="margin-bottom:2px; margin-top:1px !important">Uang Logam</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text"  value="<?php echo number_format($kl['uang_logam'],'0','','.'); ?>" style="text-align:right; font-weight:bold; color:#dc3545" id="uanglogam" name="uanglogam" class="form-control" placeholder="Uang Logam" data-error=".errorTxt11">
                        </div>
                        <div id="terbilanguanglogam" style="float:right; color:#dc3545"></div>
                    </div>
                    <label>Jumlah</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" readonly value="<?php echo number_format($kl['uang_logam']+$kl['uang_kertas'],'0','','.'); ?>" style="text-align:right; font-weight:bold" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt11">
                        </div>
                    </div>
                    <label>Pembayaran</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control show-tick" id="pembayaran" name="pembayaran" data-error=".errorTxt1">
                                <option value="">Pilih Pembayaran</option>
                                <option <?php if($kl['pembayaran']=="1"){ echo "selected";} ?> value="1">Kurang Setor</option>
                                <option <?php if($kl['pembayaran']=="2"){ echo "selected";} ?> value="2">Lebih Setor</option>
                            </select>
                        </div>
                        <div class="errorTxt1"></div>
                    </div>
                    <label style="margin-bottom:2px; !important">Keterangan</label>
                    <div class="form-group" style="margin-bottom:10px; !important"> 
                        <div class="form-line">
                            <input type="text" value="<?php echo $kl['keterangan'] ?>"  id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt11">
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
            </div>
        </div>
    </div>
</div>

<script>
    var uk = document.getElementById('uangkertas');
    var ul = document.getElementById('uanglogam');
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

    function calc(){
		uangkertasrupiah       	= document.getElementById("uangkertas").value;
        uangkertas              = uangkertasrupiah.replace(/\./g,'');
        uanglogamrupiah       	= document.getElementById("uanglogam").value;
        uanglogam               = uanglogamrupiah.replace(/\./g,'');
        
        if(uangkertas == ""){

            uangkertas = 0;
        }

        if(uanglogam == ""){

            uanglogam = 0;
        }
        var result  = parseInt(uangkertas) + parseInt(uanglogam);
      
        if (!isNaN(result)) {
         totalsetoran = document.getElementById('jumlah').value = result;
         document.getElementById("jumlah").value=convertToRupiah(totalsetoran);
        }

        
        
        
	}
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

    function convertToRupiah(angka)
	{
		var rupiah = '';		
		var angkarev = angka.toString().split('').reverse().join('');
		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');

	}
    
</script>
<script>
    $(function(){   
        $("#cabangkb").selectpicker("refresh");
        $("#pembayaran").selectpicker("refresh");
        
        
        
        $("#cabangkb").change(function(){
            
            var cabang = $("#cabangkb").val();
            $.ajax({
                type    : 'POST',
                url     : '<?php echo base_url();?>laporanpenjualan/get_salesman',
                data    : {cabang:cabang},
                cache   : false,
                success : function(respond){

                    $("#salesmankb").html(respond);
                    $("#salesmankb").selectpicker("refresh");

                }

            });
            
        });

        
        

             
        
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });
        

        $("#formValidate").submit(function(){

            var tgl         = $("#tglbayarkl").val();
            var cabang      = $("#cabangkb").val();
            var salesman    = $("#salesmankb").val();
            var jumlah      = $("#jumlah").val();
            var keterangan  = $("#keterangan").val();
            
            if(tgl == ""){
                 swal("Oops!", "Tanggal Harus Diisi.. !", "warning");
                 return false;
            }else if(cabang==""){
                swal("Oops!", "Cabang Harus Diisi!", "warning");
                return false;
            }else if(salesman==""){
                swal("Oops!", "Salesman Harus Diisi!", "warning");
                return false;
            }else if(jumlah==""){
                swal("Oops!", "Jumlah Harus Diisi!", "warning");
                return false;
            }else if(keterangan==""){
                swal("Oops!", "Keterangan Harus Diisi!", "warning");
                return false;
            }else{

                return true;
            }
        
        });

    });
</script>
  
 


  
