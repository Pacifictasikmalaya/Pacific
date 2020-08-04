
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Kas Kecil
      <small>Edit Kas Kecil</small>
    </h2>
  </div>
    <div class="body">
      <div class="row clearfix">
        <div class="col-sm-12">
         <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>kaskecil/update_kaskecil">
            <input type="hidden" id="cekdetailtmp">
            <div class="row">
              <div class="body">
							  <label>Tanggal</label>
							  <div class="input-group demo-masked-input"  >
								  <span class="input-group-addon">
										<i class="material-icons">date_range</i>
								  </span>
								  <div class="form-line">
										<input type="text" value="<?php echo $kaskecil['tgl_kaskecil'] ?>"   id="tanggal" name="tanggal" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt1" />
								  </div>
								  <div class="errorTxt1"></div>
							  </div>
								<label>No Bukti</label>
								<div class="input-group demo-masked-input"  >
									<span class="input-group-addon">
										<i class="material-icons">chrome_reader_mode</i>
									</span>
									<div class="form-line">
										<input type="text" value="<?php echo $kaskecil['nobukti'] ?>"  id="nobukti_edit" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt2" />
                    <input type="hidden" value="<?php echo $kaskecil['id'] ?>"  id="id" name="id" class="form-control" placeholder="No Bukti" data-error=".errorTxt2" />
									</div>
									<div class="errorTxt2"></div>
								</div>
                <label>Keterangan</label>
								<div class="input-group demo-masked-input"  >
									<span class="input-group-addon">
										<i class="material-icons">assignment</i>
									</span>
									<div class="form-line">
										<input type="text" value="<?php echo $kaskecil['keterangan'] ?>"  id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt2" />
									</div>
									<div class="errorTxt2"></div>
								</div>
                <label>Jumlah</label>
                <div class="input-group" >
                  <div class="form-line">
                    <input type="text" value="<?php echo number_format($kaskecil['jumlah'],'0','','.'); ?>" style="text-align:right"  id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt2" />
                  </div>
                </div>
                <label>Akun</label>
                <div class="input-group" >
                  <div class="form-line">
                    <select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
                      <?php foreach($coa as $r){ ?>
                        <option <?php if($kaskecil['kode_akun']==$r->kode_akun){ echo "selected";} ?> value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="demo-radio-button">
                   <input name="inout" type="radio" <?php if($kaskecil['status_dk'] == 'K'){ echo "checked";} ?> value="K" id="radio_1" class="inout"  />
                   <label for="radio_1">IN</label>
                   <input name="inout" type="radio" <?php if($kaskecil['status_dk'] == 'D'){ echo "checked";} ?>  value="D" id="radio_2" class="inout" />
                   <label for="radio_2">OUT</label>
                </div>
                <?php
                  if($this->session->userdata('cabang') == "pusat"){
                ?>


                <?php
                  }
                 ?>
              </div>
            </div>
            <div class="row">
              <div class="body">
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
              </div>
            </div>
         </form>
        </div>
      </div>
    </div>
</div>



<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

    var jumlah = document.getElementById('jumlah');
    jumlah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        jumlah.value = formatRupiah(this.value, '');
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
</script>
<script type="text/javascript">
	$(function(){

    $('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});

    $("#kodeakun").selectpicker('refresh');

    $("#formValidate").submit(function(){
       var tanggal       = $("#tanggal").val();
       var nobukti       = $("#nobukti_edit").val();
       var keterangan    = $("#keterangan").val();

       if(tanggal == ""){
           swal("Oops!", "Tanggal Masih Kosong!", "warning");
           $("#tanggal").focus()
           return false;
       }else if(nobukti == ""){
           swal("Oops!", "No Bukti Masih Kosong!", "warning");
           $("#nobukti").focus()
           return false;
       }else if(keterangan == ""){
           swal("Oops!", "Penerima Masih Kosong!", "warning");
           $("#keterangan").focus()
           return false;
       }else{
         return true;
       }
    });
	});
</script>
