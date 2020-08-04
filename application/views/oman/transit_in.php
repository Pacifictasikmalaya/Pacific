<div class="row clearfix">
  <div class="col-md-8">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA TRANSIT IN / OUT
          <small>Data Transit IN / OUT</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" method="post" action="" autocomplete="off">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">chrome_reader_mode</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $no_sj; ?>"  name="no_sj" class="form-control" placeholder="No Surat Jalan" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tgl_sj; ?>"  name="tgl_sj" class="form-control datepicker" placeholder="Tanggal"/>
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
                    <th>No. Surat Jalan</th>
                    <th>Transit OUT</th>
                    <th>Transit IN</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sno  = $row+1;
                foreach ($result as $d){
                  $tanggal        = explode("-",$d['tgl_mutasi_gudang_cabang']);
                  $hari           = $tanggal[2];
                  $bulan          = $tanggal[1];
                  $tahun          = $tanggal[0];
                  $tgl_to         = $hari."/".$bulan."/".substr($tahun,2,2);
                  $transit_in     = $this->db->get_where('mutasi_gudang_cabang',array('no_suratjalan'=>$d['no_suratjalan'],'jenis_mutasi'=>'TRANSIT IN'));
                  $cek_transit_in = $transit_in->num_rows();
                  if($cek_transit_in != 0){
                    $t_in           = $transit_in->row_array();
                    $tgl_tin        = explode("-",$t_in['tgl_mutasi_gudang_cabang']);
                    $hari_tin       = $tgl_tin[2];
                    $bulan_tin      = $tgl_tin[1];
                    $tahun_tin      = $tgl_tin[0];
                    $tgl_transit_in = $hari_tin."/".$bulan_tin."/".substr($tahun_tin,2,2);
                  }else{
                    $tgl_transit_in = "";
                  }
                ?>
                <tr>
                  <td><?php echo $sno; ?></td>
                  <td>
                    <a href="#" data-sj="<?php echo $d['no_suratjalan']; ?>"  class="detailsj">
                      <?php echo $d['no_suratjalan']; ?>
                    </a>
                  </td>
                  <td><span class="badge bg-blue"><?php echo $tgl_to; ?></td>
                  <td>
                    <?php if($cek_transit_in != 0){ ?>
                      <span class="badge bg-green"><?php echo $tgl_transit_in; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if ($cek_transit_in == 0){ ?>
                      <a href="#" data-sj="<?php echo $d['no_suratjalan']; ?>" data-to="<?php echo $d['no_mutasi_gudang_cabang']; ?>"  class="btn bg-green btn-xs approve">Approve</a>
                    <?php }else{ ?>
                      <a href="<?php echo base_url(); ?>oman/cancel_transit_in/<?php echo $d['no_suratjalan']; ?>" class="btn bg-red btn-xs">Batalkan</a>
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
            INPUT TRANSIT IN
            <small>Input Data TRANSIT IN</small>
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
    $('.detailsj').click(function(e){
      e.preventDefault();
      var no_sj = $(this).attr('data-sj');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>oman/detail_sjcab',
        data    : {no_sj:no_sj},
        cache   : false,
        success : function(respond){
          $("#loaddetailsj").html(respond);
        }
      });
      $("#detailsj").modal("show");
    });

    $('.approve').click(function(e){
      e.preventDefault();
      var no_sj = $(this).attr('data-sj');
      var no_to = $(this).attr('data-to');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>oman/input_transit_in',
        data    : {no_sj:no_sj,no_to:no_to},
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
