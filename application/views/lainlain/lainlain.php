<div class="row clearfix">
	<div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          INPUT MUTASI LAIN LAIN
          <small>Mutasi Lain Lain</small>
        </h2>
      </div>
      <div class="body">
      <div class="row clearfix">
        <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>bpbj/input_lainlain">
	        <div class="row">
            <div class="body">
              <div class="col-md-12">
                <div class="input-group" >
                  <span class="input-group-addon">
                    <i class="material-icons">chrome_reader_mode</i>
                  </span>
                  <div class="form-line">
                    <input type="text" readonly  id="no_mutasi" name="no_mutasi" class="form-control" placeholder="No Mutasi" data-error=".errorTxt1" />
                  </div>
                  <div class="errorTxt1"></div>
                </div>
                <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                    <input type="text" value=""  id="tgl_mutasi" name="tgl_mutasi" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                  </div>
                  <div class="errorTxt19"></div>
                </div>
                <div class="input-group" >
                  <span class="input-group-addon">
                    <i class="material-icons">chrome_reader_mode</i>
                  </span>
                  <div class="form-line">
                    <input type="hidden" readonly id="kodebarang" name="kodebarang" class="form-control" placeholder="Barang"/>
                    <input type="text" readonly id="barang" name="barang" class="form-control" placeholder="Barang"  />
                  </div>
                  <div class="errorTxt1"></div>
                </div>
                <div class="input-group" >
                  <span class="input-group-addon">
                    <i class="material-icons">chrome_reader_mode</i>
                  </span>
                  <div class="form-line">
                    <input type="text"   id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" data-error=".errorTxt1" />
                  </div>
                  <div class="errorTxt1"></div>
                </div>
                <div class="demo-radio-button">
                  <input name="inout" type="radio" value="IN" id="radio_1" class="inout"  />
                  <label for="radio_1">IN</label>
                  <input name="inout" type="radio" value="OUT" id="radio_2" class="inout" />
                  <label for="radio_2">OUT</label>
                </div>
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
        DATA BUKTI MUTASI LAIN LAIN
        <small>Data Mutasi Lain Lain</small>
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
							<input type="text" id="no_mutasi" value="<?php echo $nomutasi; ?>"  name="no_mutasi" class="form-control" placeholder="No Mutasi" />
						</div>
						<div class="errorTxt1"></div>
					</div>
					<div class="input-group" >
						<span class="input-group-addon">
							<i class="material-icons">date_range</i>
						</span>
						<div class="form-line">
							<input type="text" value="<?php echo $tgl_mutasi; ?>" id="tgl_mutasi" name="tgl_mutasi" class="form-control datepicker" placeholder="Tanggal" />
						</div>
						<div class="errorTxt1"></div>
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
                <th>No. Mutasi</th>
                <th>Tanggal</th>
                <th>IN/OUT</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sno  = $row+1;
                foreach ($result as $d){
              ?>
                <tr>
                  <td><?php echo $sno; ?></td>
                  <td><?php echo $d['no_mutasi_produksi']; ?></td>
                  <td><?php echo DateToIndo2($d['tgl_mutasi_produksi']); ?></td>
                  <td><span class="badge bg-green"><?php echo $d['inout']; ?></span></td>
                  <td>
                    <a href="#" data-nomutasi="<?php echo $d['no_mutasi_produksi']; ?>"  class="btn bg-blue btn-xs detail"><i class="material-icons">remove_red_eye</i></a>
                    <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>bpbj/hapus_lainlain/<?php echo $d['no_mutasi_produksi']; ?>" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>

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
<div class="modal fade" id="detailmutasi" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Detail Mutasi Lain Lain
            <small>Detail Mutasi Lain Lain</small>
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
<!--MODAL DATA BARANG---------------------------------------->
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<script type="text/javascript">

    $(function(){

        $('.detail').click(function(e){
            e.preventDefault();
            var nomutasi = $(this).attr('data-nomutasi');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>bpbj/detail_mutasilainlain',
                data    : {nomutasi:nomutasi},
                cache   : false,
                success : function(respond){

                    $("#loadmutasi").html(respond);
                }


            });
            $("#detailmutasi").modal("show");

        });
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });

        $("#barang").click(function(){
            var tgl_mutasi    = $("#tgl_mutasi").val();
             if(tgl_mutasi==""){

                swal("Oops!", "Isi Tanggal Terlebih Dahulu!", "warning");

            }else{
                $("#databarang").modal("show");
                $.ajax({

                    type    : 'POST',
                        url     : '<?php echo base_url(); ?>bpbj/view_baranglainlain',
                        cache   : false,
                        success : function(respond){
                            //alert(kodecabang);
                            $("#loadBarang").html(respond);

                        }

                });
            }

        });

        $("#tgl_mutasi").change(function(){

            var tgl_mutasi     = $("#tgl_mutasi").val();
            var kode_produk    = $("#kodebarang").val();
            if(kode_produk !=""){
                    $.ajax({

                        type    : 'POST',
                        url     : '<?php echo base_url();?>bpbj/buat_nomor_lainlain',
                        data    : {tgl_mutasi:tgl_mutasi,kode_produk:kode_produk},
                        cache   : false,
                        success : function(respond){

                            console.log(respond);
                            $("#no_mutasi").val("");
                            $("#no_mutasi").val(respond);
                        }

                    });
            }
        });

         $("#formValidate").submit(function(){

            var no_mutasi       = $("#no_mutasi").val();
            var tgl_mutasi      = $("#tgl_mutasi").val();
            var kodebarang      = $("#kodebarang").val();
            var jumlah          = $("#jumlah").val();

            if(no_mutasi == ""){
                swal("Oops!", "No Mutasi Masih Kosong!", "warning");
                return false;
            }else if(tgl_mutasi == ""){
                swal("Oops!", "Tanggal Mutasi Masih Kosong!", "warning");
                return false;
            }else if(kodebarang == ""){
                swal("Oops!", "Barang Masih Kosong!", "warning");
                return false;
            }else if(jumlah == ""){
                swal("Oops!", "Jumlah Masih Kosong!", "warning");
                return false;
            }else{
                if($(".inout").is(':checked')){
                     return true;
                }else{
                    swal("Oops!", "Pilih IN / OUT!", "warning");
                    return false;
                }
            }




         });


    });



</script>
