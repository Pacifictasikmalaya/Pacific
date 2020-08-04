<?php
	//error_reporting(0);
	function uang($nilai){
		return number_format($nilai,'2',',','.');
	}

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">

<br>
<b style="font-size:16px; font-family:Calibri">
	
	
	<?php 
		if($cb['nama_cabang'] != ""){
			echo "PACIFIC CABANG ". strtoupper($cb['nama_cabang']);
		}else{
			echo "PACIFIC ALL CABANG";
		}
		 
	?>
	<br>
	DATA PENGAMBILAN PELANGGAN<br>
	PERIODE <?php echo DateToIndo2($dari)." s/d ".DateToIndo2($sampai); ?><br>
	
	<?php 
		if($salesman['nama_karyawan'] != ""){
			echo "NAMA SALES : ". strtoupper($salesman['nama_karyawan']);
		}else{
			echo "ALL SALES";
		}
		 
	?>
	<br>
	<?php 
		if($pelanggan['nama_pelanggan'] != ""){
			echo "NAMA PELANGGAN : ". strtoupper($pelanggan['nama_pelanggan']);
		}
	?>

</b>
<br>
<br>

<table class="datatable3">

	<thead>
		<tr bgcolor="#024a75" style="color:white; font-size:12;">
			<th rowspan="2">TANGGAL</th>
			<th rowspan="2">KODE PELANGGAN</th>
			<th rowspan="2">NAMA PELANGGAN</th>
			<th rowspan="2">ALAMAT PELANGGAN</th>
			<th rowspan="2">SALESMAN</th>
			<th colspan="10">PRODUK</th>
		</tr>
		<tr bgcolor="#024a75" style="color:white; font-size:12;">
			<th>BB</th>
			<th>AB</th>
			<th>AR</th>
			<th>AS</th>
			<th>DP</th>
			<th>DK</th>
			<th>DS</th>
			<th>DB</th>
			<th>CG</th>
			<th>CGG</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dpp as $d){ ?>
			<tr style="font-size:12;">
				<td><?php echo DateToIndo2($d->tgltransaksi); ?></td>
				<td><?php echo $d->kode_pelanggan; ?></td>
				<td><?php echo $d->nama_pelanggan; ?></td>
				<td><?php echo $d->alamat_pelanggan; ?></td>
				<td><?php echo $d->nama_karyawan; ?></td>
				<td align="right"><?php  if($d->BB!=0){ echo uang($d->BB);} ?></td>
				<td align="right"><?php  if($d->AB!=0){ echo uang($d->AB);} ?></td>
				<td align="right"><?php  if($d->AR!=0){ echo uang($d->AR);} ?></td>
				<td align="right"><?php  if($d->ASE!=0){ echo uang($d->ASE);} ?></td>
				<td align="right"><?php  if($d->DP!=0){ echo uang($d->DP);} ?></td>
				<td align="right"><?php  if($d->DK!=0){ echo uang($d->DK);} ?></td>
				<td align="right"><?php  if($d->DS!=0){ echo uang($d->DS);} ?></td>
				<td align="right"><?php  if($d->DB!=0){ echo uang($d->DB);} ?></td>
				<td align="right"><?php  if($d->CG!=0){ echo uang($d->CG);} ?></td>
				<td align="right"><?php  if($d->CGG!=0){ echo uang($d->CGG);} ?></td>
			</tr>
		<?php } ?>
	</tbody>
	
</table>