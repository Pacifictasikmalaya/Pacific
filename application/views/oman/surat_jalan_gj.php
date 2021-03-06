<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA SURAT JALAN
          <small>Data Surat Jalan</small>
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
									<input type="text" value="<?php echo $no_sj; ?>"  id="no_sj" name="no_sj" class="form-control" placeholder="No Surat Jalan" data-error=".errorTxt1" />
								</div>
							</div>
              <div class="input-group" >
								<span class="input-group-addon">
									<i class="material-icons">date_range</i>
								</span>
								<div class="form-line">
									<input type="text" value="<?php echo $tgl_sj; ?>"  id="tgl_sj" name="tgl_sj" class="form-control datepicker" placeholder="Tanggal" data-error=".errorTxt1" />
								</div>
							</div>
              <div class="input-group" >
                <div class="form-line">
                  <select class="form-control" id="cbg" name="cabang">
                    <option value="">Semua Cabang</option>
                    <?php foreach($cbg as $c){ ?>
                        <option <?php if($cabang==$c->kode_cabang){echo "selected";} ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                     <?php } ?>
                  </select>
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
                  <th>No. SJ</th>
                  <th>Cabang</th>
                  <th>Tanggal</th>
                  <th>No Permintaan</th>
                  <th>Status SJ</th>
                  <th>Tgl Diterima / Transit Out</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sno  = $row+1;
                  foreach ($result as $d){
                    if($d['status_sj']==0){
                      $color_sj      = "bg-red";
                      $status_sj     = "Belum di Terima Cabang";
                      $tgl_terima_sj = "";
                     }else if($d['status_sj']==2){
                      $color_sj       = "bg-blue";
                      $status_sj      = "Transit Out";
                      $tgl_sj            = $this->db->get_where('mutasi_gudang_cabang',array('no_suratjalan'=>$d['no_mutasi_gudang']))->row_array();
                      $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                      $tgl_terima  = explode("-",$tgl_diterima);
                      $harisjc = $tgl_terima[2];
                      $bulansjc= $tgl_terima[1];
                      $tahunsjc= $tgl_terima[0];
                      $tgl_terima_sj = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                    }else if($d['status_sj']==1){
                      $color_sj  = "bg-green";
                      $status_sj = "Sudah di Terima Cabang";
                      $tgl_sj            = $this->db->get_where('mutasi_gudang_cabang',array('no_mutasi_gudang_cabang'=>$d['no_mutasi_gudang']))->row_array();
                      $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                      $tgl_terima  = explode("-",$tgl_diterima);
                      $harisjc = $tgl_terima[2];
                      $bulansjc= $tgl_terima[1];
                      $tahunsjc= $tgl_terima[0];
                      $tgl_terima_sj = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                    }
                    $tanggal = explode("-",$d['tgl_mutasi_gudang']);
                    $hari    = $tanggal[2];
                    $bulan   = $tanggal[1];
                    $tahun   = $tanggal[0];
                    $tgl     = $hari."/".$bulan."/".substr($tahun,2,2);
                  ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td>
                      <a href="#" data-sj="<?php echo $d['no_mutasi_gudang']; ?>"  class="detailsj">
                        <?php echo $d['no_mutasi_gudang']; ?>
                      </a>
                    </td>
                    <td><?php echo $d['kode_cabang']; ?></td>
                    <td><?php echo $tgl; ?></td>
                    <td>
                      <a href="#" data-nopermintaan="<?php echo $d['no_permintaan_pengiriman']; ?>"  class="detail">
                        <?php echo $d['no_permintaan_pengiriman']; ?>
                      </a>
                    </td>

                    <?php if($d['tgl_mutasi_gudang'] < '2019-09-30'){ ?>
                      <td><span class="badge bg-blue">Reset</span></td>
                      <td><span class="badge bg-blue">Reset</span></td>
                    <?php }else{ ?>
                      <td><span class="badge <?php echo $color_sj; ?>"><?php echo $status_sj; ?></span></td>
                      <td><span class="badge <?php echo $color_sj; ?>"><?php echo $tgl_terima_sj; ?></td>
                    <?php } ?>
                    <td>
                      <?php if ($d['status_sj']==0){ ?>
                        <a href="<?php echo base_url(); ?>oman/hapus_sj/<?php echo $d['no_mutasi_gudang']; ?>/<?php echo $d['no_permintaan_pengiriman']; ?>" class="btn bg-red btn-xs">Batalkan</a>
                      <?php } ?>
                      <a href="<?php echo base_url(); ?>/oman/cetak_suratjalan/<?php echo $d['no_mutasi_gudang']; ?>" target="_blank" class="btn btn-xs bg-blue"><i class="material-icons">print</i></a>
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
<div class="modal fade" id="detailsj" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Detail Surat Jalan
                        <small>Detail Surat Jalan</small>
                    </h2>

                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        <div class="table-responsive">
                           <div id="loaddetailsj"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputsuratjalan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        INPUT SURAT JALAN
                        <small>Input Data Surat Jalan</small>
                    </h2>

                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                          <div id="loadinputsuratjalan"></div>
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
            var no_permintaan = $(this).attr('data-nopermintaan');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>oman/detail_permintaan_pengiriman_gj',
                data    : {no_permintaan:no_permintaan},
                cache   : false,
                success : function(respond){

                    $("#loadpermintaanpengiriman").html(respond);
                }


            });
            $("#detailpermintaanpengiriman").modal("show");

        });

        $('.detailsj').click(function(e){
            e.preventDefault();
            var no_sj = $(this).attr('data-sj');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>oman/detail_sj',
                data    : {no_sj:no_sj},
                cache   : false,
                success : function(respond){

                    $("#loaddetailsj").html(respond);
                }


            });
            $("#detailsj").modal("show");

        });





        $('.inputsuratjalan').click(function(e){
            e.preventDefault();
            var no_permintaan = $(this).attr('data-nopermintaan');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>oman/input_suratjalan',
                data    : {no_permintaan:no_permintaan},
                cache   : false,
                success : function(respond){

                    $("#loadinputsuratjalan").html(respond);
                }


            });
            $("#inputsuratjalan").modal("show");

        });


        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });







    });



</script>
