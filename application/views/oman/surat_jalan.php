<?php
  error_reporting(0);
?>
<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA PERMINTAAN PENGIRIMAN
          <small>DATA PERMINTAAN PENGIRIMAN</small>
        </h2>
      </div>
        <div class="body">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>oman/view_suratjalan" autocomplete="off">
                <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                    <i class="material-icons">chrome_reader_mode</i>
                  </span>
                  <div class="form-line">
                    <input type="text" value="<?php echo $no_permintaan; ?>"  id="no_permintaan" name="no_permintaan" class="form-control " placeholder="No Permintaan" data-error=".errorTxt19" />
                  </div>
                </div>
                <div class="input-group demo-masked-input"  >
                  <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                    <input type="text" value="<?php echo $tgl_permintaan; ?>"  id="tgl_permintaan" name="tgl_permintaan" class="form-control datepicker " placeholder="Tanggal" data-error=".errorTxt19" />
                  </div>
                </div>
                <div class="input-group" >
                  <div class="form-line">
                    <select class="form-control" id="cbg" name="cabang">
                      <option value="">Semua Cabang</option>
                      <?php foreach($cabang as $c){ ?>
                          <option <?php if($cbg==$c->kode_cabang){echo "selected";} ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
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
                      <th>No. Permintaan</th>
                      <th>Tanggal</th>
                      <th>Cabang</th>
                      <th>Status Order</th>
                      <th>No. Surat Jalan</th>
                      <th>Tgl Surat Jalan</th>
                      <th>Status SJ</th>
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
                        $sj       = $this->db->get_where('mutasi_gudang_jadi',array('no_permintaan_pengiriman'=>$d['no_permintaan_pengiriman']))->row_array();
                        $tanggal = explode("-",$d['tgl_permintaan_pengiriman']);
                        $hari    = $tanggal[2];
                        $bulan   = $tanggal[1];
                        $tahun   = $tanggal[0];
                        if(!empty($sj['tgl_mutasi_gudang'])){
                          $tglsj     = explode("-",$sj['tgl_mutasi_gudang']);
                          $harisj    = $tglsj[2];
                          $bulansj   = $tglsj[1];
                          $tahunsj   = $tglsj[0];
                          $tglsj     = $harisj."/".$bulansj."/".substr($tahunsj,2,2);
                          if($sj['status_sj']==0){
                            $color_sj     = "bg-red";
                            $status_sj    = "Belum di Terima Cabang";
                            $tgl_diterima = "";
                          }else if($sj['status_sj']==2){
                            $color_sj       = "bg-blue";
                            $status_sj      = "Transit Out";
                            $tgl_sj         = $this->db->get_where('mutasi_gudang_cabang',array('no_suratjalan'=>$sj['no_mutasi_gudang']))->row_array();
                            $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                            $tgl_terima     = explode("-",$tgl_diterima);
                            $harisjc        = $tgl_terima[2];
                            $bulansjc       = $tgl_terima[1];
                            $tahunsjc       = $tgl_terima[0];
                            $tgl_terima_sj  = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                          }else if($sj['status_sj']==1){
                            $color_sj       = "bg-green";
                            $status_sj      = "Sudah di Terima Cabang";
                            $tgl_sj         = $this->db->get_where('mutasi_gudang_cabang',array('no_mutasi_gudang_cabang'=>$sj['no_mutasi_gudang']))->row_array();
                            $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                            $tgl_terima     = explode("-",$tgl_diterima);
                            $harisjc        = $tgl_terima[2];
                            $bulansjc       = $tgl_terima[1];
                            $tahunsjc       = $tgl_terima[0];
                            $tgl_terima_sj  = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                          }
                        }else{
                         $tglsj     = "";
                         $color_sj  = "";
                         $status_sj = "";
                        }
                        $tgl = $hari."/".$bulan."/".substr($tahun,2,2);
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
                          <a href="#" data-sj="<?php echo $sj['no_mutasi_gudang']; ?>"  class="detailsj">
                            <?php echo $sj['no_mutasi_gudang']; ?>
                          </a>
                        </td>
                        <td><?php echo $tglsj; ?></td>
                        <td><span class="badge <?php echo $color_sj; ?>"><?php echo $status_sj; ?></span></td>
                        <td>
                          <?php if($d['status']==0){ ?>
                            <a href="#" data-nopermintaan="<?php echo $d['no_permintaan_pengiriman']; ?>" class="btn bg-blue btn-xs inputsuratjalan">Buat Surat Jalan</a>
                          <?php }else if($d['status']==1 AND $sj['status_sj']==0){ ?>
                            <a href="<?php echo base_url(); ?>oman/hapus_sj/<?php echo $sj['no_mutasi_gudang']; ?>/<?php echo $d['no_permintaan_pengiriman']; ?>/<?php echo $this->uri->segment(3); ?>" class="btn bg-red btn-xs">Batalkan</a>
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
