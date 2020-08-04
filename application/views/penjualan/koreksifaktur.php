<?php
  
    function uang($nilai){

      return number_format($nilai,'0','','.');
    }
?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
             <div class="card">
                <div class="header bg-cyan">
                    <h2>
                       KOREKSI FAKTUR<small>Koreksi Faktur</small>
                    </h2>
                </div>
               

             
                <div class="body">
                  <div class="row">
                  <div class="col-md-12">
                      <form class="form-horizontal" method="post" action="" autocomplete="off">
                          <div class="row clearfix">
                              <div class="col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label>No Faktur</label>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" id="nofaktur" value="<?php echo $nofaktur; ?>"  name="nofaktur" class="form-control" placeholder="No Faktur">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="row clearfix">
                              <div class="col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label>Nama Pelanggan</label>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" value="<?php echo $namapel; ?>" id="namapel" name="namapel" class="form-control" placeholder="Nama Pelanggan">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row clearfix">
                              <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                  <input type="submit" name="submit" class="btn bg-blue m-2-15 waves-effect" value="CARI DATA">
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                  <div class="body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-hover" id="datatable">
                          <thead>
                              <tr>
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Piutang</th>
                                 <th>Jml Bayar</th>
                                <th>Sisa Bayar</th>
                                <th>Salesman</th>
                                <th>Ket</th>
                                <th>Aksi</th>
                               
                              </tr>
                          </thead>
                          <tbody>
                                <?php 
                                    $sno  = $row+1;
                                    foreach ($result as $d){ 

                                      if($d['sisabayar'] == 0){
                                            $color ="bg-green";
                                            $ket   ="LUNAS";
                                        }else{

                                            $color ="bg-red";
                                            $ket   = "BELUM LUNAS" ;   
                                        }
                                ?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $d['no_fak_penj']; ?></td>
                                        <td><?php echo $d['nama_pelanggan']; ?></td>
                                        <td><?php echo $d['tgltransaksi']; ?></td>
                                        <td align="right"><?php echo uang($d['totalpiutang']); ?></td>
                                        <td align="right"><?php echo uang($d['totalbayar']); ?></td>
                                        <td align="right"><?php echo uang($d['sisabayar']); ?></td>
                                        <td><?php echo $d['nama_karyawan']; ?></td>
                                        <td><span class="badge <?php echo $color ?>"><?php echo $ket; ?></span></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>penjualan/editfaktur/<?php echo $d['no_fak_penj']; ?>" class="btn btn-xs bg-green">Koreksi</a>
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

</div>