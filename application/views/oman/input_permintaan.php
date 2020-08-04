<?php 

    function uang($nilai){

        return number_format($nilai,'0','','.');
    }

     $bulan  = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Novemer","Desember");

?>
<form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>oman/input_permintaan">
    <div class="row clearfix">
    	<div class="col-md-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        INPUT PERMINTAAN PRODUKSI
                        <small>Input Permintaan Dari Gudang Jadi Pusat Ke Bagian Produksi</small>
                    </h2>
                </div>

                <div class="body">
                    <div class="row clearfix">
                        
                        <table class="table table-bordered table-striped table-hover" style="width: 50%">
                            <tr>
                                <td><b>No Order</b></td>
                                <td>:</td>
                                <td>
                                    <?php echo $oman['no_order']; ?>
                                    <input type="hidden" name="no_order" value="<?php echo $oman['no_order']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Bulan</b></td>
                                <td>:</td>
                                <td><?php echo $bulan[$oman['bulan']]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Tahun</b></td>
                                <td>:</td>
                                <td><?php echo $oman['tahun']; ?></td>
                            </tr>

                       </table> 
                       <div class="col-md-3">
                            <label>No Permintaan Produksi</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $no_permintaan; ?>"  readonly  id="no_permintaan"  name="no_permintaan" class="form-control"  data-error=".errorTxt4" placeholder="No Permintaan Produksi" />
                                   
                                </div>
                                <div class="errorTxt4"></div>
                            </div>
                            <div class="form-group errorTxt11"></div>
                        </div> 
                        <div class="col-md-3">
                            <label>Tanggal Permintaan</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo date('Y-m-d'); ?>"  id="tgl_permintaan"  name="tgl_permintaan" class="form-control datepicker"  data-error=".errorTxt4" placeholder="Tanggal Order" />
                                   
                                </div>
                                <div class="errorTxt4"></div>
                            </div>
                            <div class="form-group errorTxt11"></div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped table-hover" style="width:80%" id="mytable">
                                    <thead>
                                        <tr >
                                            <th width="10px" style="vertical-align: middle;" >No</th>
                                            <th  style="vertical-align: middle; text-align: center;" >Produk</th>
                                            <th  style="text-align: center">OMAN MKT</th>
                                            <th style="text-align: center">Stok Gudang</th>
                                            <th  style="text-align:center;vertical-align: middle;">Total</th>
                                            <th style="text-align: center">Buffer Stok</th>
                                            <th style="text-align: center">Grand Total</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no =1; 
                                        foreach($produk as $p){ 

                                             $qtotalmkt  = "SELECT SUM(jumlah) as jumlah FROM detail_oman 
                                                            WHERE kode_produk ='$p->kode_produk' AND no_order = '$no_order'
                                                            GROUP BY kode_produk";
                                             $totalmkt   =  $this->db->query($qtotalmkt)->row_array();

                                             $qstokgudang= "SELECT 
                                                            SUM(IF(`inout`='IN' AND d.kode_produk='$p->kode_produk',jumlah,0)) -  
                                                            SUM(IF(`inout`='OUT' AND d.kode_produk='$p->kode_produk',jumlah,0))  as saldoakhir
                                                            FROM detail_mutasi_gudang d 
                                                            INNER JOIN mutasi_gudang_jadi m 
                                                            ON d.no_mutasi_gudang = m.no_mutasi_gudang";
                                            $stokgudang = $this->db->query($qstokgudang)->row_array(); 
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td>
                                                    <input type="hidden" name="kode_produk<?php echo $no; ?>" value="<?php echo $p->kode_produk;?>">
                                                    <b><?php echo $p->nama_barang; ?></b>
                                                </td>
                                                <td align="right">
                                                    <?php echo uang($totalmkt['jumlah']);  ?>
                                                    <input type="hidden" name="oman_mkt<?php echo $no; ?>" value="<?php echo $totalmkt['jumlah']; ?>">
                                                </td>
                                                <td align="right">
                                                     <?php echo uang($stokgudang['saldoakhir']);  ?>
                                                     <input type="hidden" name="stok_gudang<?php echo $no; ?>" value="<?php echo $stokgudang['saldoakhir']; ?>">
                                                </td>
                                                <td align="right">
                                                    <?php echo uang($totalmkt['jumlah']-$stokgudang['saldoakhir']);  ?>
                                                    <input type="hidden"  id="totalpermintaan" class="totalpermintaan" name="totalpermintaan<?php echo $no; ?>" value="<?php echo $totalmkt['jumlah']-$stokgudang['saldoakhir']; ?>">
                                                </td>
                                                <td style="width:120px">
                                                    
                                                     <div class="form-line">
                                                         <input type="text" id="bufferstok" name="bufferstok<?php echo $no; ?>" class="form-control bufferstok"  style="text-align:right"  />
                                                    </div>

                                                </td>
                                                 <td style="width:120px">
                                                    
                                                     <div class="form-line">
                                                         <input type="text" readonly id="subtotal"   name="subtotal<?php echo $no; ?>"  class="form-control subtotal" style="text-align:right"    />
                                                    </div>

                                                </td>
                                                
                                            </tr>
                                        <?php $no++; $jumproduk = $no-1;} ?>
                                        <input type="hidden" value ="<?php echo $jumproduk; ?>" name="jumproduk">
                                        
                                    </tbody>
                                </table>
                                
                            </div>  
                            <div class="row">
                                <div class="col-md-9">
                                    <div style="margin-left:30px; float:right">
                                        <button type="submit" name="submit" style=" font-size:16px" class="btn btn-lg bg-blue"><span>PROSES</span> <i class="material-icons">send</i></button>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</form>
<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
    
        $(function(){

            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });

             

            var $tblrows = $("#mytable tbody tr");
              $tblrows.each(function (index) {
              var $tblrow = $(this);
            

                 $tblrow.find('.bufferstok').on('input', function () {
                    var totalpermintaan  = $tblrow.find("[id=totalpermintaan]").val();
                    var bufferstok       = $tblrow.find("[id=bufferstok]").val();
                   

                    if(totalpermintaan.length=== 0){

                        var totalpermintaan = 0;

                    }else{
                        var totalpermintaan = parseInt(totalpermintaan);
                    }
                    if(bufferstok.length=== 0){

                        var bufferstok = 0;

                    }else{
                        var bufferstok = parseInt(bufferstok);
                    }
                    
                    var subTotal    = totalpermintaan + bufferstok;


                    if (!isNaN(subTotal)) {

                        $tblrow.find('.subtotal').val(subTotal);
                        var grandTotal = 0;
                        $(".subtotal").each(function () {
                            var stval = parseInt($(this).val());
                            grandTotal += isNaN(stval) ? 0 : stval;
                        });

                        //$('.grdtot').val(grandTotal.toFixed(2));
                    }

                 });

             });

                    

             
             $("form").submit(function(){


                    
                    


             });


            
        });

            


        
</script>