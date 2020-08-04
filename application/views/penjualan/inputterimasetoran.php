
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Input Penerimaan Setoran
    </h2>
    <small>Input Penerimaan Setoran</small>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <form autocomplete="off" class="formValidate" name="autoSumForm" id="formValidate"  method="POST" action="<?php echo base_url(); ?>penjualan/terimasetoran">
          <input type="hidden" value="<?php echo $setoranpusat['kode_setoranpusat']; ?>" name="kode_setoranpusat" class="form-control">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Tgl Setoran</th>
              <td><?php echo $setoranpusat['tgl_setoranpusat']; ?></td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td><?php echo $setoranpusat['keterangan']; ?></td>
            </tr>
            <tr>
              <th>Cabang</th>
              <td><?php echo $setoranpusat['kode_cabang']; ?></td>
            </tr>
            <tr>
              <th>Via</th>
              <td><?php echo $setoranpusat['bank']; ?></td>
            </tr>
            <?php if(empty($setoranpusat['no_ref'])){ ?>
              <tr>
                <th>Uang Kertas</th>
                <td align="right"><?php echo number_format($setoranpusat['uang_kertas'],'0','','.'); ?></td>
              </tr> 
              <tr>
                <th>Uang Logam</th>
                <td align="right"><?php echo number_format($setoranpusat['uang_logam'],'0','','.'); ?></td>
              </tr> 
            <?php }else{?>
              <tr>
                <th>No Ref</th>
                <td><?php echo $setoranpusat['no_ref']; ?></td>
              </tr>
              <?php if(!empty($setoranpusat['giro'])){?>
                <tr>
                  <th>Giro</th>
                  <td align="right"><?php echo number_format($setoranpusat['giro'],'0','','.'); ?></td>
                </tr> 
              <?php } ?>
              <?php if(!empty($setoranpusat['transfer'])){?>
                <tr>
                  <th>Transfer</th>
                  <td align="right"><?php echo number_format($setoranpusat['transfer'],'0','','.'); ?></td>
                </tr> 
              <?php } ?>
            <?php } ?>
            
          </table>
          <label>Tgl Diterima Pusat</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" required value="<?php echo $setoranpusat['tgl_setoranpusat']; ?>"  id="tgl_terimapusat" name="tgl_terimapusat" class="form-control datepicker date" placeholder="Tanggal Terima Pusat" data-error=".errorTxt11">
            </div>
          </div>
          <div class="form-group" id="bank" >
            <label>Bank Penerima</label>
             <select required class="form-control showtick" id="bank_penerima" name="bank_penerima">
                <option value="">-- Pilih Bank --</option>
                <?php foreach($lbank as $b){ ?>
                    <option value="<?php echo $b->kode_bank; ?>"><?php echo $b->nama_bank; ?></option>
                <?php } ?>
            </select>
            <div class="errorTxt5"></div>
          </div>
          <label>Omset Bulan</label>
          <div class="form-group">
            <div class="form-line">
              <select required class="form-control show-tick" id="bulan" name="bulan" data-error=".errorTxt1">
                <option value="">Bulan</option>
                <?php
                  $bulanini = date("m");
                  for($i=1; $i<count($bulan); $i++){
                ?>
                  <option <?php if($bulanini==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $bulan[$i]; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <label>Omset Tahun</label>
          <div class="form-group">
            <div class="form-line">
              <select required class="form-control show-tick" id="tahun2" name="tahun" data-error=".errorTxt1">
                <?php
                  $tahunmulai = 2020;
                  
                  for($thn = $tahunmulai; $thn<=date('Y'); $thn++){
                ?>
                  <option <?php if(date('Y')==$thn){echo "Selected";} ?>  value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php 
                  }
                ?>
              </select>
            </div>
            <div class="errorTxt1"></div>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn bg-blue waves-effect">
              <i class="material-icons">save</i>
              <span>SIMPAN</span>
            </button>
            <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
              <i class="material-icons">cancel</i>
              <span>Batal</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $("#bank_penerima").selectpicker("refresh");
  $("#bulan").selectpicker("refresh");
  $("#tahun2").selectpicker("refresh");
  $('.datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    clearButton: true,
    weekStart: 1,
    time: false
  });
</script>

