<div class="row clearfix">
	<div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          Barang
          <small>List Data Barang</small>
        </h2>
      </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <?php if($leveluser == "Administrator"){ ?>
                <a href="#" class="btn bg-red waves-effect" id="tambahbarang"> Tambah Data </a>
              <?php } ?>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="mytable" style="font-size:12px">
                  <thead>
                    <tr>
                      <th width="10px">No</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Satuan</th>
                      <th>Harga/Dus</th>
                      <th>Harga/Pack</th>
                      <th>Harga/Pcs</th>
                       <?php if($leveluser == "Administrator"){ ?>
                        <th>Aksi</th>
                       <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      foreach($barang as $b){
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->kode_barang; ?></td>
                      <td><a href="#" data-kode="<?php echo $b->kode_barang; ?>" class="detailbrg"><?php echo $b->nama_barang; ?></a></td>
                      <td><?php echo $b->kategori; ?></td>
                      <td><?php echo $b->satuan; ?></td>
                      <td align="right"><?php echo number_format($b->harga_dus,'0','','.'); ?></td>
                      <td align="right"><?php echo number_format($b->harga_pack,'0','','.'); ?></td>
                      <td align="right"><?php echo number_format($b->harga_pcs,'0','','.'); ?></td>
                      <?php if($leveluser == "Administrator"){ ?>
                        <td>
                         <a href="#" data-id="<?php echo $b->kode_barang; ?>" class="btn bg-green  btn-xs waves-effect edit">Edit</a>
                         <a href="#"  class="btn bg-red  btn-xs waves-effect" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url("barang/hapus/".$b->kode_barang);?>">Hapus</a>
                        </td>
                      <?php } ?>
                    </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
            	</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!--------------------------------------INPUT DATA PELANGGAN---------------------------------------->
<div class="modal fade" id="inputbarang" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){

        $("#tambahbarang").click(function(){
            $("#inputbarang").modal("show");
            $(".modal-content").load("<?php echo base_url();?>barang/input_barang");
        });

        $(".edit").click(function(){
            $id = $(this).attr('data-id');
            $("#inputbarang").modal("show");
            $(".modal-content").load("<?php echo base_url();?>barang/edit_barang/"+$id);
        });

        $(".detailbrg").click(function(){
            $id = $(this).attr('data-kode');
            $("#inputbarang").modal("show");
            $(".modal-content").load("<?php echo base_url();?>barang/detail_barang/"+$id);
        });

        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
         });

    });
</script>
