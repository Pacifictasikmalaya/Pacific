<?php
	function uang($nilai){
		return number_format($nilai,'2',',','.');
	}
?>
<table class="table table-bordered table-hover table-striped">
	<tr>
		<td colspan="3"><b>No Mutasi Retur</b></td>
		<td><?php echo $mutasi['no_mutasi_gudang_cabang']; ?></td>
	</tr>
	<tr>
		<td colspan="3"><b>Tanggal Retur</b></td>
		<td><?php echo DateToIndo2($mutasi['tgl_mutasi_gudang_cabang']); ?></td>
	</tr>
	<tr>
		<td><b>No DPB</b></td>
		<td><b>Nama Salesman</b></td>
		<td><b>Tujuan</b></td>
		<td><b>No Kendaraan</b></td>
	</tr>
	<tr>
		<td><?php echo $mutasi['no_dpb']; ?></td>
		<td><?php echo $mutasi['nama_karyawan']; ?></td>
		<td><?php echo $mutasi['tujuan']; ?></td>
		<td><?php echo $mutasi['no_kendaraan']; ?></td>
	</tr>
</table>
<hr>
<table class="table table-bordered table-hover table-striped">
	<thead class = "" >
		<tr>
			<th rowspan="3" align="">No</th>
			<th rowspan="3" style="text-align:center">Nama Barang</th>
			<th colspan="3" style="text-align:center">Retur</th>
			<th rowspan="2" colspan="2" style="text-align:center">Total</th>
		</tr>
		<tr>
			<th colspan="3" style="text-align:center">Kuantitas</th>
		</tr>
		<tr>
			<th>DUS</th>
			<th>PACK</th>
			<th>PCS</th>
			<th style="text-align:center">Jumlah</th>
			<th style="text-align:center">Satuan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach ($detailmutasi as $d ){
				$jumlah = $d->jumlah / $d->isipcsdus;
				$jmldus = floor($d->jumlah / $d->isipcsdus);
				if($d->jumlah !=0 ){
					$sisadus   = $d->jumlah % $d->isipcsdus;
				}else{
					$sisadus = 0;
				}
				if($d->isipack == 0){
					$jmlpack    = 0;
					$sisapack   = $sisadus;
					$s          = "A";
				}else{
					$jmlpack    = floor($sisadus / $d->isipcs);
					$sisapack   = $sisadus % $d->isipcs;
					$s          = "B";
				}
				$jmlpcs = $sisapack;
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $d->nama_barang; ?></td>
				<td><?php if(!empty($jmldus)){ echo $jmldus; } ?></td>
				<td><?php if(!empty($jmlpack)){ echo $jmlpack; } ?></td>
				<td><?php if(!empty($jmlpcs)){ echo $jmlpcs; } ?></td>
				<td align="right"><?php echo uang($jumlah); ?></td>
				<td><?php echo $d->satuan; ?></td>

			</tr>
		<?php
				$no++;
			}
		 ?>
	</tbody>
</table>
