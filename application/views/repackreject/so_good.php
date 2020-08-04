
<div class="row clearfix">
  <div class="col-md-10">
        <div class="card">
            <div class="header bg-cyan">
                <h2>
                     STOK OPNAME GOOD STOK
                    <small>Stok Opname Good Stok</small>
                </h2>
            </div>

            <div class="body">
                <div class="row clearfix">
                    <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>repackreject/input_sogood">
                    <div class="row">
                        <div class="body">
                            <div class="col-md-6">  
                                <div class="input-group demo-masked-input"  >
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" value=""  id="tgl_so" name="tgl_so" class="datepicker form-control date" placeholder="Tanggal" data-error=".errorTxt19" />
                                        <input type="hidden" name="status" value="GOOD">
                                       
                                    </div>
                                </div>
                                <?php if($cb == 'pusat'){ ?>
                                  <div class="form-group" >
                                      <div class="form-line">
                                            <select class="form-control" id="cabang" name="cabang">
                                                <option value="">Pilih Cabang</option>
                                                <?php foreach($cabang as $c){ ?>
                                                    <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                                                 <?php } ?>
                                            </select>
                                      </div>
                                  </div>
                                <?php }else{ ?>
                                     <input type="hidden" readonly id="cabang" name="cabang" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
                                <?php } ?>
                                
                                 
                                    <div class="input-group" >
                                        <span class="input-group-addon">
                                            <i class="material-icons">chrome_reader_mode</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="hidden" readonly id="kodebarang" name="kodebarang" class="form-control" placeholder="Barang"/>
                                            <input type="text" readonly id="barang" name="barang" class="form-control" placeholder="Barang"  />
                                            <input type="hidden" readonly id="kodecabang" name="kodecabang" class="form-control" placeholder="Kode Cabang"  />
                                            <input type="hidden"   id="cekdetailsogoodtemp" name="cekdetailpenyesuaiantemp" class="form-control" data-error=".errorTxt1" />
                                            <input type="hidden" readonly id="stok" name="stok" class="form-control" placeholder="Stok"  />
                                        </div>
                                       
                                    </div>
                            
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="body">
                          <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="3">Data Stok</th>
                                    </tr>
                                    <tr>
                                        <th>DUS</th>
                                        <th>PAK</th>
                                        <th>PCS</th>
                                    </tr>
                                </thead>
                                <tbody id="loadStok">

                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="body">
                            <div class="col-md-2">
                                <label>Jumlah</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                         <input type="text" style="text-align:center" value="0"  id="jmldus" name="jmldus" class="form-control" />
                                        
                                    </div>
                                    <div class="form-line">
                                          <input style="text-align:right; font-weight: bold" readonly type="hidden" id="hargadus" name="hargadus" class="form-control"  placeholder="Harga" />
                                       
                                    </div>
                                  
                                    <div class="form-line">
                                          <input style="text-align:right; font-weight: bold" readonly type="hidden" id="isipcsdus" name="isipcsdus" class="form-control"  />
                                       
                                    </div>
                                     <div class="form-line">
                                          <input style="text-align:right; font-weight: bold" readonly type="hidden" id="isipcspack" name="isipcspack" class="form-control" />
                                       
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-2" id="pack">
                                <label>Jumlah Pack</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                         <input type="text" style="text-align:center" value="0"  id="jmlpack" name="jmlpack" class="form-control"  />
                                       
                                    </div>
                                    <div class="form-line">
                                        <input style="text-align:right; font-weight: bold" type="hidden" id="hargapack" name="hargapack" class="form-control" readonly   placeholder="Harga / Pack"/>
                                       
                                    </div>
                                    
                                </div>
                            </div>
                           
                            <div class="col-md-2" >
                                <label>Jumlah Pcs</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                         <input type="text"  style="text-align:center" value="0"  id="jmlpcs" name="jmlpcs" class="form-control" placeholder="Jumlah Pcs"  />
                                       
                                    </div>
                                    <div class="form-line">
                                        <input style="text-align:right; font-weight: bold"  type="hidden" id="hargapcs" name="hargapcs" class="form-control" readonly placeholder="Harga / Pcs"  />
                                       
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <label>Keterangan</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                         <input type="text"  style="text-align:left"   id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"  />
                                       
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
                    <div class="row">
                        <div class="body">
                            <div class="col-md-12  table-responsive" >
                                <table class="table table-bordered table-striped table-hover" id="detailbarang">
                                    <thead class="bg-cyan">
                                        <tr>
                                            <th rowspan="2" style="text-align:center; vertical-align: middle">Kode Produk</th>
                                            <th rowspan="2" style="text-align:center; vertical-align: middle">Nama Barang</th>
                                            <th colspan="3" style="text-align:center; vertical-align: middle">Jumlah Stok</th>
                                            <th colspan="3" style="text-align:center; vertical-align: middle">Jumlah Fisik</th>
                                            <th rowspan="2" style="text-align:center; vertical-align: middle">Keterangan</th>
                                            <th rowspan="2" style="text-align:center; vertical-align: middle">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">DUS</th>
                                            <th style="text-align: center">PACK</th>
                                            <th style="text-align: center">PCS</th>
                                            <th style="text-align: center">DUS</th>
                                            <th style="text-align: center">PACK</th>
                                            <th style="text-align: center">PCS</th>
                                        </tr>
                                    </thead>

                                    <tbody id="loadDetail">

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
    
</div>
<div class="row clearfix">
    <div class="col-md-10">
        <div class="card">
            <div class="header bg-cyan">
                <h2>
                    DATA STOK OPNAME GOOD STOK
                    <small>Data Stok Opname Good Stok</small>
                </h2>
            </div>

            <div class="body">
                <div class="row">
                  <div class="col-md-12">
                      <form class="form-horizontal" method="post" action="" autocomplete="off">
                          
                          <div class="row clearfix">
                               <div class="col-md-2 form-control-label">
                                  <label>Tanggal</label>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" value="<?php echo $tgl_mutasi; ?>" id="tgl_mutasi" name="tgl_mutasi" class="form-control datepicker" placeholder="Tanggal">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                                  <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>Kode Stok Opname</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sno  = $row+1;
                                        foreach ($result as $d){

                                           $tanggal = explode("-",$d['tgl_so']);
                                           $hari    = $tanggal[2];
                                           $bulan   = $tanggal[1];
                                           $tahun   = $tanggal[0];
                                           $tgl     = $hari."/".$bulan."/".substr($tahun,2,2);
                                           
                                           
                                    ?>
                                        <tr>
                                           <td><?php echo $sno; ?></td>
                                           <td><?php echo $d['no_so']; ?></td>
                                           <td><?php echo $tgl; ?></td>
                                           <td>
                                              
                                                <a href="#" data-target="#konfirmasi_hapus" data-toggle="modal" data-href="<?php echo base_url(); ?>repackreject/hapus_so/<?php echo $d['no_so']; ?>/GOOD" class="btn bg-red btn-xs"><i class="material-icons">delete</i></a>
                                                 <a href="#" data-nomutasi="<?php echo $d['no_so']; ?>"   class="btn bg-blue btn-xs detail">Detail</a>
                                       

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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Detail Stok Opname Good Stok
                        <small>Detail Stok Opname Good Stok</small>
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

<!-------------------------------------- MODAL DATA BARANG ---------------------------------------->
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

        function loadDetail(){
          var cabang = $("#cabang").val();
          $("#loadDetail").load("<?php echo base_url();?>repackreject/view_detailsogoodtemp/"+cabang);
        }

        

        function cekdetail(){
            var cabang  = $("#cabang").val();
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>repackreject/cekdetailsogoodtemp',
                data    : {cabang:cabang},
                cache   :false,
                success : function(respond){
                    console.log(cabang);
                    $("#cekdetailsogoodtemp").val(respond);
                }

            });
        }
        cekdetail();
        loadDetail();

         $("#cabang").change(function(e){

            e.preventDefault();
            cekdetail();
            loadDetail();
            $("#loadStok").load("<?php echo base_url();?>repackreject/view_detailstok/");
            $("#barang").val("");

        });

        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });

        $("#barang").click(function(){
           
            var cabang   = $("#cabang").val();
            if(cabang == ""){
                 swal("Oops!", "Silahkan Pilih Cabang Terlebih Dahulu!", "warning");
            }else{           
               $("#databarang").modal("show");
                $.ajax({

                        type    : 'POST',
                        url     : '<?php echo base_url(); ?>barang/view_barangcab_gj',
                        data    : {kodecabang:cabang},
                        cache   : false,
                        success : function(respond){
                            //alert(kodecabang);
                            $("#loadBarang").html(respond);

                        }

                });
            }
            

        });

        $("#tambahbarang").click(function(e){
            e.preventDefault();
            var kode_produk = $("#kodebarang").val();
            var jmldus      = $("#jmldus").val();
            var hargadus    = $("#hargadus").val();
            var jmlpack     = $("#jmlpack").val();
            var hargapack   = $("#hargapack").val();
            var jmlpcs      = $("#jmlpcs").val();
            var hargapcs    = $("#hargapcs").val();
            var isipcsdus   = $("#isipcsdus").val();
            var isipcspack  = $("#isipcspack").val();
            var cabang      = $("#cabang").val();
            var keterangan  = $("#keterangan").val();
            var jumlahpcs   = (jmldus * isipcsdus) + (jmlpack * isipcspack) + (jmlpcs * 1);
            var stok        = $("#stok").val();
            if(stok != ""){

                stok = $("#stok").val();
            }else{

                stok = 0;
            }
            if(kode_produk ==""){
                swal("Oops!", "Silahkan Pilih Barang Terlebih Dahulu !", "warning");
            }
            else if(jmldus == 0 && jmlpack ==0 && jmlpcs== 0){

                swal("Oops!", "Jumlah Tidak Boleh 0!", "warning");
        
            }else if(parseInt(jumlahpcs) != parseInt(stok) && keterangan ==""){

                swal("Oops!", "Stok Memiliki Selisih Silahkan Isi Keterangan ! ", "warning");
        
            }else{
                    $.ajax({

                        type    : 'POST',
                        url     : '<?php echo base_url();?>repackreject/insert_detailsogoodtemp',
                        data    : {
                                    kode_produk:kode_produk,
                                    stok:stok,
                                    jmldus:jmldus,
                                    hargadus:hargadus,
                                    jmlpack:jmlpack,
                                    hargapack:hargapack,
                                    jmlpcs:jmlpcs,
                                    hargapcs:hargapcs,
                                    cabang:cabang,
                                    isipcsdus:isipcsdus,
                                    isipcspack:isipcspack,
                                    keterangan:keterangan


                                },
                        cache   : false,
                        success : function(respond){
                            console.log(respond);

                             if(respond == 1){

                                swal("Oops!", "Data Sudah Di Inputkan!", "warning");
                             }
                            cekdetail();
                            loadDetail();
                            
                        }


                    });
            }

        });

        $("#salesman").change(function(e){
            cekdetail();
            loadDetail();
        });
        

        $(".formValidate").submit(function(){

          
            var tgl_so            = $("#tgl_so").val();
            var cabang            = $("#cabang").val();
            var cek               = $("#cekdetailsogoodtemp").val();
          
            
            if(tgl_so == ""){
                swal("Oops!", "Tanggal Stok Opname Masih Kosong!", "warning");
                return false;
            }else if(cabang == ""){
                swal("Oops!", "Silahkan Pilih Cabang Terlebih Dahulu!", "warning");
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
            
            $.ajax({

                type    : 'POST',
                url     : '<?php echo base_url(); ?>repackreject/detail_so',
                data    : {nomutasi:nomutasi},
                cache   : false,
                success : function(respond){

                    $("#loadmutasi").html(respond);
                }


            });
            $("#detailmutasi").modal("show");

        });


     });
</script>