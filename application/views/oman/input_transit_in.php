<form autocomplete="off" class="formValidate" id="formtransitin"  method="POST" action="<?php echo base_url(); ?>oman/input_transit_in">
<table class="table table-bordered table-hover table-striped">
	<tr>
		<td><b>No Surat Jalan</b></td>
		<td>:</td>
		<td>
			<?php echo $sj['no_mutasi_gudang']; ?>
			<input type="hidden" name="no_suratjalan" value="<?php echo $sj['no_mutasi_gudang']; ?>" id="no_suratjalan">
			<input type="hidden" name="no_to" value="<?php echo $no_to; ?>" id="no_to">
		</td>
	</tr>
	<tr>
		<td><b>Tanggal SJ</b></td>
		<td>:</td>
		<td>
			<?php echo DateToIndo2($sj['tgl_mutasi_gudang']); ?>
			<input type="hidden" name="tgl_krim" value="<?php echo $sj['tgl_mutasi_gudang']; ?>" id="tgl_krim">
		</td>
	</tr>
	
	<tr>
		<td><b>Cabang</b></td>
		<td>:</td>
		<td>
			<?php echo $sj['nama_cabang']; ?>
			<input type="hidden" name="kode_cabang" value="<?php echo $sj['kode_cabang']; ?>" id="kode_cabang">
		</td>
	</tr>
	<tr>
		<td><b>Keterangan</b></td>
		<td>:</td>
		<td>
			<?php echo $sj['keterangan']; ?>
			<input type="hidden" name="keterangan" value="<?php echo $sj['keterangan']; ?>" id="keterangan">
		</td>
	</tr>
	<tr>
		<td><b>Status</b></td>
		<td>:</td>
		<td>
			<?php 
				
				if($sj['status_sj']==0){
                    $color_sj     = "bg-red";
                    $status_sj    = "Belum di Terima Cabang";
                    $tgl_diterima = "";
                 }else if($sj['status_sj']==2){
                    $color_sj       = "bg-blue";
                    $status_sj      = "Transit Out";
                    $tgl_sj            = $this->db->get_where('mutasi_gudang_cabang',array('no_suratjalan'=>$sj['no_mutasi_gudang']))->row_array();
                    $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                    $tgl_terima  = explode("-",$tgl_diterima);
                    $harisjc = $tgl_terima[2];
                    $bulansjc= $tgl_terima[1];
                    $tahunsjc= $tgl_terima[0];
                    $tgl_terima_sj = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                 }else if($sj['status_sj']==1){
                    $color_sj  = "bg-green";
                    $status_sj = "Sudah di Terima Cabang";
                    $tgl_sj            = $this->db->get_where('mutasi_gudang_cabang',array('no_mutasi_gudang_cabang'=>$sj['no_mutasi_gudang']))->row_array();
                    $tgl_diterima   = $tgl_sj['tgl_mutasi_gudang_cabang'];
                    $tgl_terima  = explode("-",$tgl_diterima);
                    $harisjc = $tgl_terima[2];
                    $bulansjc= $tgl_terima[1];
                    $tahunsjc= $tgl_terima[0];
                    $tgl_terima_sj = $harisjc."/".$bulansjc."/".substr($tahunsjc,2,2);
                 }


			 ?>
		 	 <span class="badge <?php echo $color_sj; ?>"><?php echo $status_sj; ?></span>
		 </td>
	</tr>

</table>

<table class="table table-bordered table-hover table-striped">
	<thead>
		
		<tr>
			<th>Kode Produk</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			
		</tr>
	</thead>
	 <tbody id="">
	 		<?php foreach ($detail as $s){ ?>
	 			<tr>
	 				<td><?php echo $s->kode_produk; ?></td>
	 				<td><?php echo $s->nama_barang; ?></td>
	 				<td><?php echo $s->jumlah;?></td>
	 			</tr>
	 		<?php } ?>
     </tbody>
</table>

<div id="tanggalditerima">
    <label>Tanggal Diterima / Transit IN</label>
    <div class="input-group demo-masked-input"  >
        <span class="input-group-addon">
            <i class="material-icons">date_range</i>
        </span>
        <div class="form-line">
            <input type="text"    id="tglditerima" name="tglditerima" class="datepicker form-control date" placeholder="Tanggal Diterima / Transit Out" data-error=".errorTxt1" />
           
        </div>
        <div class="errorTxt1"></div>
    </div>
</div>
 <div class="form-group" style="margin-left:10px" >
     <button type="submit"  name="submit" class="btn bg-blue waves-effect">
        <i class="material-icons">save</i>
        <span>SIMPAN</span>
    </button>
    <button type="button" data-dismiss="modal" class="btn bg-red waves-effect">
        <i class="material-icons">cancel</i>
        <span>Batal</span>
    </button>
</div>
</form>
<script type="text/javascript">
	$(function(){

		$('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
        });

         $("#formtransitin").submit(function(){

        		
        		var tglditerima		= $("#tglditerima").val();

        		if(tglditerima ==""){

        			 swal("Oops!", "Tanggal Harus Diisi!", "warning");
               		 return false;
        		}else{

        			return true;
        		}
                
                    	


         });

	});
</script>