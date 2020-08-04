<form autocomplete="off" class="formValidate" id="formSuratjalanacc"  method="POST" action="<?php echo base_url(); ?>oman/input_suratjalanacc">
<table class="table table-bordered table-hover table-striped">
	<tr>
		<td><b>No Surat Jalan</b></td>
		<td>:</td>
		<td>
			<?php echo $sj['no_mutasi_gudang']; ?>
			<input type="hidden" name="no_suratjalan" value="<?php echo $sj['no_mutasi_gudang']; ?>" id="no_suratjalan">

		</td>
	</tr>
	<tr>
		<td><b>Tanggal Kirim</b></td>
		<td>:</td>
		<td><?php echo DateToIndo2($sj['tgl_mutasi_gudang']); ?></td>
		<input type="hidden" name="tgl_krim" value="<?php echo $sj['tgl_mutasi_gudang']; ?>" id="tgl_krim">
	</tr>

	<tr>
		<td><b>Cabang</b></td>
		<td>:</td>
		<td><?php echo $sj['nama_cabang']; ?></td>
		<input type="hidden" name="kode_cabang" value="<?php echo $sj['kode_cabang']; ?>" id="kode_cabang">
	</tr>
	<tr>
		<td><b>Keterangan</b></td>
		<td>:</td>
		<td><?php echo $sj['keterangan']; ?></td>
		<input type="hidden" name="keterangan" value="<?php echo $sj['keterangan']; ?>" id="keterangan">
	</tr>
	<tr>
		<td><b>Status</b></td>
		<td>:</td>
		<td>
			<?php

				if($sj['status_sj']==0){
                    $color = "bg-red";
                    $status = "Belum di Terima Cabang";
                 }else{
                    $color  = "bg-green";
                    $status = "Sudah di Terima Cabang";
                 }


			 ?>
		 	 <span class="badge <?php echo $color; ?>"><?php echo $status; ?></span>
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

 <div class="form-group"  >
        <label>Status</label>
         <select class="form-control showtick" id="status" name="status">
            <option value="">-- Pilih Status --</option>
            <option value="SURAT JALAN">Diterima</option>
            <option value="TRANSIT OUT">Transit Out</option>
        </select>
    <div class="errorTxt5"></div>
</div>
<div id="tanggalditerima">
    <label>Tanggal Diterima / Transit Out</label>
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

        $("#formSuratjalanacc").submit(function(){

        		var status 			= $("#status").val();
        		var tglditerima		= $("#tglditerima").val();

        		if(status ==""){

        			 swal("Oops!", "Status Harus Diisi!", "warning");
               		 return false;
        		}else if(tglditerima ==""){

        			 swal("Oops!", "Tanggal Harus Diisi!", "warning");
               		 return false;
        		}else{

        			return true;
        		}




         });

	});
</script>
