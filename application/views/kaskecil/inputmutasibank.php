<div class="card">
  <div class="header bg-cyan">
    <h2>
      Mutasi Bank
      <small>Input Mutasi Bank</small>
    </h2>

  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form autocomplete="off" class="formValidate" id="formValidate" method="POST" action="<?php echo base_url(); ?>keuangan/insertmutasicabang">
        <input type="hidden" name="nobukti">
          <input type="hidden" id="cekdetailtmp">
          <div class="row">
            <div class="body">
              <label>Tanggal</label>
              <div class="input-group demo-masked-input">
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" id="tanggal" name="tanggal" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt1" />

                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Keterangan</label>
              <div class="input-group demo-masked-input">
                <span class="input-group-addon">
                  <i class="material-icons">assignment</i>
                </span>
                <div class="form-line">
                  <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt2" />
                </div>
                <div class="errorTxt2"></div>
              </div>
              <label>Jumlah</label>
              <div class="input-group">
                <div class="form-line">
                  <input type="text" style="text-align:right" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt2" />
                </div>
              </div>
              <div class="form-group">
                <div class="form-line">
                  <select class="form-control show-tick" id="bank" name="bank" data-error=".errorTxt1">
                    <?php foreach($lbank as $b){ ?>
                      <option  value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="errorTxt1"></div>
              </div>
              <label>Akun</label>
              <div class="input-group">
                <div class="form-line">
                  <select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
                    <?php foreach($coa as $r){ ?>
                    <option value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <label>Debet / Kredit</label>
              <div class="input-group">
                <div class="form-line">
                  <select class="form-control show-tick " id="debetkredit" name="debetkredit" data-error=".errorTxt1">
                    <option value="D">Debet</option>
                    <option value="K">Kredit</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="body">
              <div class="form-group">
                <button type="submit" name="submit" class="btn bg-blue waves-effect">
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
    $("#bank").selectpicker('refresh');
    $('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});

    $("#kodeakun").selectpicker('refresh');
    $("#debetkredit").selectpicker('refresh');

    $("#formValidate").submit(function(){
       var tanggal       = $("#tanggal").val();
       var keterangan    = $("#keterangan").val();
       var jumlah        = $("#jumlah").val();

       if(tanggal == ""){
           swal("Oops!", "Tanggal Masih Kosong!", "warning");
           $("#tanggal").focus()
           return false;
       }else if(keterangan == ""){
            swal("Oops!", "Keterangan Masih Kosong!", "warning");
            $("#keterangan").focus()
            return false;
        }else if(jumlah == ""){
             swal("Oops!", "Jumlah Masih Kosong!", "warning");
             $("#jumlah").focus()
             return false;
         }else{
         return true;
       }
    });
	});
</script>
