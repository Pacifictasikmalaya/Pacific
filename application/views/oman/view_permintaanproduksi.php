<div class="row clearfix">
	<div class="col-md-12">
        <div class="card">
            <div class="header bg-cyan">
                <h2>
                    DATA PERMINTAAN PRODUKSI
                    <small>Data Permintaan Produksi</small>
                </h2>
            </div>

            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                       
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped table-hover" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>No. Permintaan</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>OMAN</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=1;
                                        foreach ($permintaan as $p){

                                            if($p->status=='0' OR empty($p->status)){
                                                $status = "Pending";
                                                $bg     = "bg-orange";
                                             }else if($p->status=='1'){
                                                $status = "Sudah di Proses oleh Produksi";
                                                $bg     = "bg-green";
                                             }
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $p->no_permintaan;?></td>
                                            <td><?php echo DateToIndo2($p->tgl_permintaan);?></td>
                                            <td><?php echo $p->no_order;?></td>
                                            <td><span class="badge <?php echo $bg; ?>"><?php echo $status; ?></span></td>
                                            <td>
                                                <a href="#" data-noorder="<?php echo $p->no_order; ?>" class="btn btn-xs bg-teal detailpermintaan">Detail Permintaan</a>
                                                 <?php if($p->status==0 OR empty($p->status)){?>
                                                    <a href="<?php echo base_url(); ?>oman/hapus_permintaan/<?php echo $p->no_permintaan; ?>/<?php echo $p->no_order; ?>" class="btn btn-xs bg-red">Batalkan</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php 
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<!--------------------------------------MODAL Detail Permintaan Produksi---------------------------------------->
<div class="modal fade" id="detailpermintaan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Detail Permintaan Produksi
                        <small>Detail Permintaan Produksi</small>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        <div class="table-responsive">
                           <div id="loaddetailpermintaan"></div>
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

        

        $('.detailpermintaan').click(function(){
            var no_order = $(this).attr('data-noorder');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>oman/detail_permintaan',
                data    : {no_order:no_order},
                cache   : false,
                success : function(respond){

                    $("#loaddetailpermintaan").html(respond);
                }


            });
            $("#detailpermintaan").modal("show");

        });

        $('#mytable').DataTable({
            
            responsive: true
        
        });

    });

</script>