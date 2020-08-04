<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA PERINCIAN BARANG (DPB)
          <small>Data Perincian Barang (DPB)</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="post" action="" autocomplete="off">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" value="<?php echo $tgl_pengambilan; ?>" id="tgl_pengambilan" name="tgl_pengambilan" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                </div>
              </div>
              <?php if($cb == 'pusat'){ ?>
              <div class="input-group" >
                <div class="form-line">
                  <select class="form-control" id="cabang" name="cabang">
                    <option value="">Pilih Cabang</option>
                    <?php foreach($cabang as $c){ ?>
                      <option <?php if($cbg==$c->kode_cabang){echo "selected"; } ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <?php }else{ ?>
                <input type="hidden" readonly id="cabang" name="cabang" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
              <?php } ?>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control show-tick" id="salesman" name="salesman" data-error=".errorTxt1">
                    <option value="<?php echo $salesman; ?>"><?php echo $sales['nama_karyawan']; ?></option>
                  </select>
                </div>
              </div>
              <br>
              <div class="row clearfix">
                <div class="col-md-offset-10">
                  <input type="submit" name="submit" class="btn bg-blue  waves-effect" value="CARI DATA">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="<?php echo base_url();?>dpb/inputdpb" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>No DPB</th>
                    <th>Tanggal Pengambilan</th>
                    <th>Nama Salesman</th>
                    <th>Nama Cabang</th>
                    <th>Tujuan</th>
                    <th>No Kendaraan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno  = $row+1;
                    foreach ($result as $d){
                      if(empty($d['tgl_pengembalian'])){
                        $bg = "pink";
                      }else{
                        $bg = "teal";
                      }
                  ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo $d['no_dpb']; ?></td>
                      <td><?php echo DateToIndo2($d['tgl_pengambilan']); ?></td>
                      <td><?php echo $d['nama_karyawan']; ?></td>
                      <td><?php echo $d['kode_cabang']; ?></td>
                      <td><?php echo $d['tujuan']; ?></td>
                      <td><?php echo $d['no_kendaraan']; ?></td>
                      <td>
                        <a href="#" class="btn btn-xs btn-info detail" data-nodpb="<?php echo $d['no_dpb']; ?>">Detail</a>
                        <a href="<?php echo base_url(); ?>dpb/updatedpb/<?php echo $d['no_dpb']; ?>" class="btn btn-xs bg-<?php echo $bg; ?>">Update DPB</a>
                        <a href="<?php echo base_url(); ?>dpb/hapusdpb/<?php echo $d['no_dpb']; ?>" class="btn btn-xs btn-danger">Hapus</a>
                      </td>
                    </tr>
                    <?php
                      $sno++;
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <div style='margin-top: 10px;'>
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detaildpb" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            DATA PERINCIAN BARANG (DPB)
            <small>DPB</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loaddpb"></div>
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
     var no_dpb        = $(this).attr('data-nodpb');
     $.ajax({
       type    : 'POST',
       url     : '<?php echo base_url(); ?>dpb/detail_dpb',
       data    : {no_dpb:no_dpb},
       cache   : false,
       success : function(respond){
         $("#loaddpb").html(respond);
       }
     });
     $("#detaildpb").modal("show");
   });
   function loadsalesman()
   {
     var cabang = $("#cabang").val();
     $.ajax({
       type    : 'POST',
       url     : '<?php echo base_url();?>laporanpenjualan/get_salesman',
       data    : {cabang:cabang},
       cache   : false,
       success : function(respond){
         $("#salesman").html(respond);
         $("#salesman").selectpicker("refresh");
       }
     });
   }

   loadsalesman();
   $('.datepicker').bootstrapMaterialDatePicker({
     format      : 'YYYY-MM-DD',
     clearButton : true,
     weekStart   : 1,
     time        : false
   });
  });
</script>
