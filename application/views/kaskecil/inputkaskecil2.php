
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Kas Kecil
      <small>Input Kas Kecil</small>
    </h2>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
       <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>kaskecil/insert_kaskecil2">
          <input type="hidden" id="cekkaskeciltemp">
          <div class="row">
            <div class="body">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text"   id="tanggal" name="tanggal" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt1" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">chrome_reader_mode</i>
                </span>
                <div class="form-line">
                  <input type="text"  id="nobukti_input" name="nobukti" class="form-control" placeholder="No Bukti" data-error=".errorTxt2" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">assignment</i>
                </span>
                <div class="form-line">
                  <input type="text"  id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt2" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">assignment</i>
                </span>
                <div class="form-line">
                  <input type="text" style="text-align:right"  id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt2" />
                </div>
              </div>

              <label>Akun</label>
              <div class="input-group" >
                <div class="form-line">
                  <select class="form-control show-tick " id="kodeakun" name="kodeakun" data-error=".errorTxt1" data-live-search="true">
                    <?php foreach($coa as $r){ ?>
                    <option value="<?php echo $r->kode_akun; ?>"><?php echo $r->kode_akun." ".$r->nama_akun; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="demo-radio-button">
                 <input name="inout" type="radio" value="K" id="radio_1" class="inout"  />
                 <label for="radio_1">IN</label>
                 <input name="inout" type="radio" checked value="D" id="radio_2" class="inout" />
                 <label for="radio_2">OUT</label>
              </div>
              <br>
              <div class="form-group" >
                <a href="#" id="simpantemp" class="btn btn-sm bg-green m-2-15 waves-effect">
                  <i class="material-icons">add_box</i>
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>IN/OUT</th>
                      <th>Akun</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tampilkaskeciltemp">  

                  </tbody>
                </table>
              </div>
              <!-- <?php
                if($this->session->userdata('cabang') == "pusat"){
              ?> -->


              <!-- <?php
                }
               ?> -->
            </div>
          </div>
          <div class="row" style="float:right">
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
    function cektutuplaporan()
		{
			var tgltransaksi = $("#tanggal").val();
			var jenis = 'kaskecil';
			$.ajax({
	  		type 		: 'POST',
	  		url 		:'<?php echo base_url();?>setting/cektutuplaporan',
	  		data 		:{tanggal:tgltransaksi,jenis:jenis},
	  		cache		:false,
	  		success	: function(respond){
					console.log(respond);
	  			var status = respond;
	  			if(status !=0){
	  				swal("Oops!", "Laporan Untuk Periode Ini Sudah Di Tutup !", "warning");
	  				$("#tanggal").val("");
	  			}
	  		}
	  	});
		}

    $("#tanggal").change(function(){
			cektutuplaporan();
		});
    $('.datepicker').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD',
				clearButton: true,
				weekStart: 1,
				time: false
		});

    $("#kodeakun").selectpicker('refresh');
    
    function loadtampilkaskeciltemp()
    {
      var nobukti = $("#nobukti_input").val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url(); ?>kaskecil/tampilkaskeciltemp',
        data : {nobukti:nobukti},
        cache : false,
        success : function(respond)
        {
          $("#tampilkaskeciltemp").html(respond);
        }
      });
    }

    function cekkaskeciltemp()
    {
      var nobukti = $("#nobukti_input").val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url(); ?>kaskecil/cekkaskeciltemp',
        data : {nobukti:nobukti},
        cache : false,
        success : function(respond)
        {
          $("#cekkaskeciltemp").val(respond);
        }
      });
    }

    cekkaskeciltemp();
    $("#nobukti_input").on('keyup keydown change',function(){
      loadtampilkaskeciltemp();
      cekkaskeciltemp();
    });
    $("#simpantemp").click(function(e){
      e.preventDefault();
       var tanggal       = $("#tanggal").val();
       var nobukti       = $("#nobukti_input").val();
       var keterangan    = $("#keterangan").val();
       var jumlah        = $("#jumlah").val();
       var kodeakun      = $("#kodeakun").val();
       var inout         = $("input[name='inout']:checked").val();

       //alert(inout);
       if(tanggal == ""){
          swal("Oops!", "Tanggal Masih Kosong!", "warning");
          $("#tanggal").focus()
       }else if(nobukti == ""){
           swal("Oops!", "No Bukti Masih Kosong!", "warning");
           $("#nobukti").focus()
       }else if(keterangan == ""){
           swal("Oops!", "Keterangan Masih Kosong!", "warning");
           $("#penerima").focus()
       }else if(jumlah == ""){
           swal("Oops!", "Jumlah Masih Kosong!", "warning");
           $("#jumlah").focus()
       }else if(kodeakun == ""){
           swal("Oops!", "Akun Masih Kosong!", "warning");
           $("#kodeakun").focus()
       }else{
         $.ajax({
          type : 'POST',
          url : '<?php echo base_url(); ?>kaskecil/insert_kaskecil_temp',
          data : {tanggal:tanggal,keterangan:keterangan,nobukti:nobukti,jumlah:jumlah,kodeakun:kodeakun,inout:inout},
          cache : false,
          success : function(respond){
            loadtampilkaskeciltemp();
            cekkaskeciltemp();
          }
         });
       }
    });
    $("#formValidate").submit(function(){
       var tanggal       = $("#tanggal").val();
       var nobukti       = $("#nobukti_input").val();
       
       var cekkaskeciltemp = $("#cekkaskeciltemp").val();
       if(tanggal == ""){
           swal("Oops!", "Tanggal Masih Kosong!", "warning");
           $("#tanggal").focus()
           return false;
       }else if(nobukti == ""){
           swal("Oops!", "No Bukti Masih Kosong!", "warning");
           $("#nobukti").focus()
           return false;
       }else if(cekkaskeciltemp == 0 || cek==""){
           swal("Oops!", "Data Masih Kosong!", "warning");
           $("#penerima").focus()
           return false;
       }else{
         return true;
       }
    });
	});
</script>
