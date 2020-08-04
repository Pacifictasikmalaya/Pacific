<div class="row clearfix">
	<div class="col-md-12">
        <div class="card">
            <div class="header bg-cyan">
                <h2>
                    DATA ORDER MANAGEMENT ( OMAN ) MARKETING
                    <small>Data Order Managemen Marketing</small>
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
                                        <th>No. Order</th>
                                        <th>Tanggal Order</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($oman as $o ){
                                         if($o->status=='0'){
                                            $status = "Pending";
                                            $bg     = "bg-orange";
                                         }else if($o->status=='1'){
                                            $status = "Sudah di Proses Gudang";
                                            $bg     = "bg-blue";
                                         }else if($o->status=='2'){
                                            $status ="Sudah di Proses oleh Produksi";
                                            $bg     = "bg-green";
                                         }
                                         $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Novemer","Desember");
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $o->no_order; ?></td>
                                            <td><?php echo DateToIndo2($o->tgl_order); ?></td>
                                            <td><?php echo $bulan[$o->bulan]; ?></td>
                                            <td><?php echo $o->tahun; ?></td>
                                            <td><span class="badge <?php echo $bg; ?>"><?php echo $status; ?></span></td>
                                            <td>
                                                <a href="#" data-noorder="<?php echo $o->no_order; ?>" class="btn btn-xs bg-pink detail">Detail Oman</a>
                                            <?php if($o->status==0){?>
                                                <a href="<?php echo base_url(); ?>oman/input_permintaan/<?php echo $o->no_order; ?>" class="btn btn-xs bg-green">Buat Permintaan</a>
                                            <?php }else if($o->status=='1' OR $o->status=='2'){ ?>
                                                <a href="#" data-noorder="<?php echo $o->no_order; ?>" class="btn btn-xs bg-teal detailpermintaan">Detail Permintaan</a>
                                            <?php } ?>
                                               
                                            </td>
                                        </tr>
                                    <?php $no++;} ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
<!--------------------------------------MODAL DATA BARANG---------------------------------------->
<div class="modal fade" id="detailoman" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Detail ORDER MANAGEMENT MARKETING
                        <small>Detail Oman</small>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        <div class="table-responsive">
                           <div id="loaddetailoman"></div>
                        </div>
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

        $('.detail').click(function(){
            var no_order = $(this).attr('data-noorder');
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>oman/detail_oman',
                data    : {no_order:no_order},
                cache   : false,
                success : function(respond){

                    $("#loaddetailoman").html(respond);
                }


            });
            $("#detailoman").modal("show");

        });

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