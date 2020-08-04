
<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          INPUT DATA REPACK
          <small>Input Data Repack</small>
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>repackreject/input_repack">
            <div class="row">
              <div class="body">
                <div class="col-md-12">
                  <div class="input-group" >
                    <span class="input-group-addon">
                      <i class="material-icons">chrome_reader_mode</i>
                    </span>
                    <div class="form-line">
                      <input type="text" readonly  id="no_repack" name="no_repack" class="form-control" placeholder="No Repack" data-error=".errorTxt1" />
                    </div>
                  </div>
                  <div class="input-group demo-masked-input"  >
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                      <input type="text" value=""  id="tgl_repack" name="tgl_repack" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
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
                        <input type="hidden"   id="cekdetailrepacktemp" name="cekdetailrepacktemp" class="form-control" data-error=".errorTxt1" />
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
                    <tbody id="loaddetailrepack">
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
          DATA REPACK
          <small>Data Repack</small>
        </h2>
      </div>
      <div class="body">
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="post" action="" autocomplete="off">
            <div class="input-group" >
              <span class="input-group-addon">
                <i class="material-icons">chrome_reader_mode</i>
              </span>
              <div class="form-line">
                <input type="text"  value="<?php echo $nomutasi; ?>"   id="no_mutasi" name="no_mutasi" class="form-control" placeholder="No Repack" data-error=".errorTxt1" />
              </div>
            </div>
            <div class="input-group" >
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text"  value="<?php echo $tgl_mutasi; ?>"   id="tgl_mutasi" name="tgl_mutasi" class="form-control datepicker" placeholder="Tanggal" data-error=".errorTxt1" />
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
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
                  <th>No. Repack</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sno  = $row+1;
                  foreach ($result as $d){
                    $tanggal = explode("-",$d['tgl_mutasi_gudang']);
                    $hari    = $tanggal[2];
                    $bulan   = $tanggal[1];
                    $tahun   = $tanggal[0];
                    $tgl     = $hari."/".$bulan."/".substr($tahun,2,2);
                ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td>
                      <a href="#" data-nomutasi="<?php echo $d['no_mutasi_gudang']; ?>"  class="detail">
                        <?php echo $d['no_mutasi_gudang']; ?>
                      </a>
                    </td>
                    <td><?php echo $tgl; ?></td>
                    <td>
                      <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>repackreject/hapus_repack/<?php echo $d['no_mutasi_gudang']; ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
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
<div class="modal fade" id="detailmutasi" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Repack
            <small>Detail Repack</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loadmutasi"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!---MODAL DATA BARANG-->
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

<script type="text/javascript">
   $(function(){
      function loadRepack(){
        $("#loaddetailrepack").load('<?php echo base_url(); ?>repackreject/view_detail_repack_temp/');
      }
      function cekdetailrepacktemp(){
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>repackreject/cekdetailrepacktemp',
          cache   :false,
          success : function(respond){
            $("#cekdetailrepacktemp").val(respond);
          }
        });
      }
      cekdetailrepacktemp();
      loadRepack();
      $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
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
        var kode_produk = $("#kodebarang").val();
        var jumlah      = $("#jumlah").val();
        if(kode_produk ==""){
            swal("Oops!", "Silahkan Pilih Barang/Produk Terlebih Dahulu !", "warning");
        }
        else if(jumlah==""){
          swal("Oops!", "Jumlah Tidak Boleh 0!", "warning");
        }else {
          $.ajax({
            type    : 'POST',
            url     : '<?php echo base_url(); ?>repackreject/insert_detailrepacktemp',
            data    : {kode_produk:kode_produk,jumlah:jumlah},
            cache   : false,
            success : function(respond){
                if(respond == 1){
                    swal("Oops!", "Data Untuk Produk "+kode_produk+" Sudah Ada!", "warning");
                }else{
                    loadRepack();
                    cekdetailrepacktemp();
                }
            }
          });
        }
      });

      $("#tgl_repack").change(function(){
        var tgl_repack     = $("#tgl_repack").val();
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url();?>repackreject/buat_nomor_repack',
          data    : {tgl_repack:tgl_repack},
          cache   : false,
          success : function(respond){
            console.log(respond);
            $("#no_repack").val("");
            $("#no_repack").val(respond);
          }
        });
      });
      $(".formValidate").submit(function(){
        var no_repack         = $("#no_repack").val();
        var tgl_repack        = $("#tgl_permintaan").val();
        var cek               = $("#cekdetailrepacktemp").val();
        if(no_repack == ""){
          swal("Oops!", "No Repack Masih Kosong!", "warning");
          return false;
        }else if(tgl_repack == ""){
          swal("Oops!", "Tanggal Repack Masih Kosong!", "warning");
          return false;
        }else if(cek == ""){
          swal("Oops!", "Data Barang Masih Kosong!", "warning");
          return false;
        }else{
          return true;
        }
      });

      $('.detail').click(function(e){
        e.preventDefault();
        var nomutasi        = $(this).attr('data-nomutasi');
        var jenis_mutasi    = "REPACK";
        $.ajax({
          type    : 'POST',
          url     : '<?php echo base_url(); ?>repackreject/detail_mutasi',
          data    : {nomutasi:nomutasi,jenis_mutasi:jenis_mutasi},
          cache   : false,
          success : function(respond){
            $("#loadmutasi").html(respond);
          }

        });
        $("#detailmutasi").modal("show");
      });
    });
</script>
