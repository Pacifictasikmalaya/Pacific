<div class="row clearfix">
	<div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          INPUT PERMINTAAN PENGIRIMAN
          <small>Permintaan Pengiriman</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>oman/input_permintaan_pengiriman">
          	<div class="row">
              <div class="body">
                <div class="col-md-12">
                  <div class="input-group" >
                    <span class="input-group-addon">
                      <i class="material-icons">chrome_reader_mode</i>
                    </span>
                    <div class="form-line">
                      <input type="text" readonly  id="no_permintaan" name="no_permintaan" class="form-control" placeholder="No Permintaan" data-error=".errorTxt1" />
                    </div>
                  </div>
                  <div class="input-group demo-masked-input"  >
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                      <input type="text" value=""  id="tgl_permintaan" name="tgl_permintaan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                    </div>
                  </div>
                  <div class="input-group" >
                    <span class="input-group-addon">
                      <i class="material-icons">chrome_reader_mode</i>
                    </span>
                    <div class="form-line">
                      <select class="form-control" id="cabang" name="cabang">
                        <option value="">Pilih Cabang</option>
                        <?php foreach($cabang as $c){ ?>
                            <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                         <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="input-group" >
                    <span class="input-group-addon">
                      <i class="material-icons">chrome_reader_mode</i>
                    </span>
                    <div class="form-line">
                      <input type="text"   id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" data-error=".errorTxt1" />
                      <input type="hidden"   id="cekdetailpermintaanpengiriman" name="cekdetailpermintaanpengiriman" class="form-control" data-error=".errorTxt1" />
                    </div>
                  </div>
                </div>
              </div>
          	</div>
	          <div class="row">
	            <div class="col-md-12">
	              <div class="body">
	                <div class="col-md-6">
	                  <div class="input-group" >
	                    <span class="input-group-addon">
	                      <i class="material-icons">chrome_reader_mode</i>
	                    </span>
	                    <div class="form-line">
	                      <input type="hidden" readonly id="kodebarang" name="kodebarang" class="form-control" placeholder="Barang"/>
	                      <input type="text" readonly id="barang" name="barang" class="form-control" placeholder="Barang"  />
	                      <input type="hidden" readonly id="kodecabang" name="kodecabang" class="form-control" placeholder="Kode Cabang"  />
	                      <input type="hidden" readonly id="stok" name="stok" class="form-control" placeholder="Stok"  />
	                    </div>
	                  </div>
	              	</div>
	                <div class="col-md-4">
				            <div class="input-group demo-masked-input">
				              <span class="input-group-addon">
				                <i class="material-icons">chrome_reader_mode</i>
				              </span>
				              <div class="form-line">
				                <input type="text" style="text-align:right" value="" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt19" />
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
	          </div>
	          <div class="row">
              <div class="body">
                <div class="col-md-12  table-responsive" >
                  <table class="table table-bordered table-striped table-hover" id="detailbarang">
                    <thead class="bg-green">
                      <tr>
                        <th>Kode Produk</th>
                        <th>Nama Barang</th>
                        <th>Jml</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="loaddetailpermintaan">
                    </tbody>
                  </table>
                </div>
              </div>
	          </div>
	          <div class="row">
              <div style="float:right; margin-right: 100px;">
                <button type="submit" name="submit" class="btn btn-sm bg-blue"><span>Simpan</span> <i class="material-icons">send</i></button>
              </div>
	          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA PERMINTAAN PENGIRIMAN
          <small>Data PERMINTAAN PENGIRIMAN</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
        	<div class="col-md-12">
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>oman/permintaan_pengiriman" autocomplete="off">
							<div class="input-group" >
								<span class="input-group-addon">
									<i class="material-icons">chrome_reader_mode</i>
								</span>
								<div class="form-line">
									<input type="text" value="<?php echo $no_permintaan; ?>"  id="no_permintaan" name="no_permintaan" class="form-control" placeholder="No Permintaan" data-error=".errorTxt1" />
								</div>
							</div>
							<div class="input-group" >
								<span class="input-group-addon">
									<i class="material-icons">date_range</i>
								</span>
								<div class="form-line">
									<input type="text" value="<?php echo $tgl_permintaan; ?>"  id="tgl_permintaan" name="tgl_permintaan" class="form-control datepicker" placeholder="Tanggal" data-error=".errorTxt1" />
								</div>
							</div>
              <div class="row clearfix">
                <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10">
                  <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>No. Permintaan</th>
                    <th>Tanggal</th>
                    <th>Cabang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $sno  = $row+1;
                      foreach ($result as $d){
                        if($d['status']==0){
                          $color = "bg-red";
                          $status = "Belum di Proses";
                        }else{
                          $color  = "bg-green";
                          $status = "Sudah di Proses";
                        }

                         $tanggal = explode("-",$d['tgl_permintaan_pengiriman']);
                         $hari    = $tanggal[2];
                         $bulan   = $tanggal[1];
                         $tahun   = $tanggal[0];
                         $tgl     = $hari."/".$bulan."/".substr($tahun,2,2);
                      ?>
                      <tr>
                        <td><?php echo $sno; ?></td>
                        <td>
                          <a href="#" data-nopermintaan="<?php echo $d['no_permintaan_pengiriman']; ?>"  class="detail">
                            <?php echo $d['no_permintaan_pengiriman']; ?>
                          </a>
                        </td>
                        <td><?php echo $tgl; ?></td>
                        <td><?php echo $d['kode_cabang']; ?></td>
                        <td><span class="badge <?php echo $color; ?>"><?php echo $status; ?></span></td>
                        <td>
                          <?php if($d['status']==0){ ?>
                            <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>oman/hapus_permintaanpengiriman/<?php echo $d['no_permintaan_pengiriman']; ?>/<?php echo $this->uri->segment(3); ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php
                        $sno++;
                      }
                    ?>
                </tbody>
              </table>
              <div style='margin-top: 10px;'>
                <?php echo $pagination; ?>
              </div>
            </div>
          </div>
      	</div>
   		</div>
		</div>
	</div>
</div>


<!--------------------------------------MODAL DATA BARANG---------------------------------------->
<div class="modal fade" id="databarang" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
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
            <div class="col-sm-12">
	            <div class="table-responsive">
	              <div id="loadBarang"></div>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailpermintaanpengiriman" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Permintaan Pengiriman
            <small>Detail Permintaan Pengiriman</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
	            <div class="table-responsive">
	              <div id="loadpermintaanpengiriman"></div>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  $(function(){
    function loadPermintaan(){
      $("#loaddetailpermintaan").load('<?php echo base_url(); ?>oman/view_detail_permintaan_pengiriman_temp/');
    }

    function cek_detailpermintaanpengiriman(){
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>oman/cek_detailpermintaanpengiriman',
        cache   :false,
        success : function(respond){
          $("#cekdetailpermintaanpengiriman").val(respond);
        }
      });
    }
    cek_detailpermintaanpengiriman();
    loadPermintaan();
      //loaddetailpp();
    $('.detail').click(function(e){
      e.preventDefault();
      var no_permintaan = $(this).attr('data-nopermintaan');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>oman/detail_permintaan_pengiriman',
        data    : {no_permintaan:no_permintaan},
        cache   : false,
        success : function(respond){
          $("#loadpermintaanpengiriman").html(respond);
        }
      });
      $("#detailpermintaanpengiriman").modal("show");
    });
    $("#cabang").change(function(){
      var tgl_permintaan = $("#tgl_permintaan").val();
      var cabang         = $("#cabang").val();
      if(tgl_permintaan !=""){
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>oman/buat_nomor_permintaan',
          data    : {tgl_permintaan:tgl_permintaan,cabang:cabang},
          cache   : false,
          success : function(respond){
            console.log(respond);
            $("#no_permintaan").val("");
            $("#no_permintaan").val(respond);
          }
        });
      }
    });

    $('.datepicker').bootstrapMaterialDatePicker({
      format			: 'YYYY-MM-DD',
      clearButton	: true,
      weekStart		: 1,
      time				: false
    });


    $("#tgl_permintaan").change(function(){
      var tgl_permintaan = $("#tgl_permintaan").val();
      var cabang         = $("#cabang").val();
      if(cabang !=""){
         $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>oman/buat_nomor_permintaan',
          data    : {tgl_permintaan:tgl_permintaan,cabang:cabang},
          cache   : false,
          success : function(respond){
            console.log(respond);
            $("#no_permintaan").val("");
            $("#no_permintaan").val(respond);
          }

        });
      }
  	});

    $("#barang").click(function(){
      $("#databarang").modal("show");
      $.ajax({
    	  type    : 'POST',
        url     : '<?php echo base_url(); ?>oman/view_barang',
        cache   : false,
        success : function(respond){
          //alert(kodecabang);
          $("#loadBarang").html(respond);
        }
      });
    });
    $("#tambahbarang").click(function(e){
      e.preventDefault();
      var kode_produk  = $("#kodebarang").val();
      var  jumlah      = $("#jumlah").val();
      var  stok        = $("#stok").val();
      if(stok != ""){
        stok = $("#stok").val();
      }else{
        stok = 0;
      }

      if(kode_produk ==""){
        swal("Oops!", "Silahkan Pilih Barang/Produk Terlebih Dahulu !", "warning");
      }else if(jumlah==""){
        swal("Oops!", "Jumlah Tidak Boleh 0!", "warning");
      }else if(parseInt(jumlah) > parseInt(stok)){
        swal("Oops!", "Stok Gudang Tidak Mencukupi ! Stok Tersedia "+stok, "warning");
      }else {
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>oman/insert_detailpermintaantmp',
          data    : {kode_produk:kode_produk,jumlah:jumlah},
          cache   : false,
          success : function(respond){
            if(respond == 1){
              swal("Oops!", "Data Untuk Produk "+kode_produk+" Sudah Ada!", "warning");
            }else{
              loadPermintaan();
              cek_detailpermintaanpengiriman();
            }
          }
        });
      }
    });

    $(".formValidate").submit(function(){

      var no_permintaan     = $("#no_permintaan").val();
      var tgl_permintaan    = $("#tgl_permintaan").val();
      var cabang            = $("#cabang").val();
      var keterangan        = $("#keterangan").val();
      var cek               = $("#cekdetailpermintaanpengiriman").val();
      if(no_permintaan == ""){
        swal("Oops!", "No Permintaan Masih Kosong!", "warning");
        return false;
      }else if(tgl_permintaan == ""){
        swal("Oops!", "Tanggal Permintaan Masih Kosong!", "warning");
        return false;
      }else if(cabang == ""){
        swal("Oops!", "Silahkan Pilih Cabang!", "warning");
        return false;
      }else if(keterangan == ""){
        swal("Oops!", "Keterangan Masih Kosong!", "warning");
        return false;
      }else if(cek == ""){
        swal("Oops!", "Data Barang Masih Kosong!", "warning");
        return false;
      }else{
        return true;
      }
    });
  });
</script>
