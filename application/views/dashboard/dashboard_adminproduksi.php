<?php

    function uang($nilai){

       return number_format($nilai,'0','','.');
    
    }

    $b      = date('m')+0;
    $bulan  = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<div class="row clearfix">
  <div class="col-md-6">
    <div class="card">
      <div class="header bg-cyan">
          <h2>
              Permintaan Produksi Bulan <?php echo $bulan[$b];  ?>
              <small>Dashbaoard</small>
          </h2>
      </div>
      <div class="body">
         <?php if ($cek != 0){ ?>

           <div class="table-responsive">
               
               <table class="table table-bordered table-striped table-hover" style="width: 100%">
                    <tr>
                        <td><b>No Permintaan</b></td>
                        <td>:</td>
                        <td><?php echo $permintaan['no_permintaan']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Permintaan</b></td>
                        <td>:</td>
                        <td><?php echo DateToIndo2($permintaan['tgl_permintaan']); ?></td>
                    </tr>
                    <tr>
                        <td><b>No Order</b></td>
                        <td>:</td>
                        <td><?php echo $permintaan['no_order']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Bulan</b></td>
                        <td>:</td>
                        <td><?php echo $bulan[$permintaan['bulan']]; ?></td>
                    </tr>
                    <tr>
                        <td><b>Tahun</b></td>
                        <td>:</td>
                        <td><?php echo $permintaan['tahun']; ?></td>
                    </tr>
               </table>
               <table class="table table-bordered table-striped table-hover" id="mytable">
                    <thead>
                        <tr >
                            <th width="10px" style="vertical-align: middle;" >No</th>
                            <th style="vertical-align: middle; text-align: center;" >Produk</th>
                            <th style="text-align:center;vertical-align: middle;">Total Permintaan</th>
                            <th style="text-align:center;vertical-align: middle;">Reliasi</th>
                            <th style="text-align:center;vertical-align: middle;">%</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php 
                                $no =1;
                                foreach($oman as $d){
                                  $permintaan= ($d->oman_mkt - $d->stok_gudang + $d->buffer_stok); 
                                  $realisasi = "SELECT SUM(jumlah) as jmlproduksi FROM detail_mutasi_produksi
                                                INNER JOIN mutasi_produksi 
                                                ON detail_mutasi_produksi.no_mutasi_produksi = mutasi_produksi.no_mutasi_produksi
                                                WHERE jenis_mutasi = 'BPBJ' AND kode_produk = '$d->kode_produk' AND MONTH(tgl_mutasi_produksi)='$b'";
                                  $r          = $this->db->query($realisasi)->row_array();
                                  if($r['jmlproduksi']!=0){
                                    $persen     = ($r['jmlproduksi'] / $permintaan ) * 100;
                                  }else{
                                    $persen     = 0;
                                  }

                                  if($persen < 50){

                                    $color ="bg-red";
                                  }else if($persen < 90){
                                    $color ="bg-orange";
                                  }else{
                                    $color = "bg-green";
                                  }
                                  
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $d->nama_barang; ?></td>
                                    <td align="right"><?php echo uang($d->oman_mkt - $d->stok_gudang + $d->buffer_stok); ?></td>
                                    <td align="right"><?php if($r['jmlproduksi'] != 0){echo uang($r['jmlproduksi']);} ?></td>
                                    <td align="right">
                                      <span class="badge <?php echo $color; ?>"><?php if($persen != 0){echo uang($persen)."%";} ?></span>
                                    </td>
                                </tr>
                            <?php 
                                $no++;
                            }
                            ?>
                    </tbody>
                </table>
                
          </div>
        <?php }else{ ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Data Permintaan Produksi Untuk Bulan Ini Belum Tersedia ! atau Belum Di Proses..!
              </div>
        <?php }  ?>
      </div>
    </div>
  </div>
</div>