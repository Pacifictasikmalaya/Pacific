<?php
	error_reporting(0);
	function uang($nilai){
		return number_format($nilai,'2',',','.');
	}

  function angka($nilai){
		return number_format($nilai,'2',',','.');
	}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
<br>
<b style="font-size:14px; font-family:Calibri">
  KARTU HUTANG <br>
  PERIODE <?php echo DateToIndo2($dari)." s/d ".DateToIndo2($sampai); ?><br>
  <?php
		if($supplier != ""){
			echo "SUPPLIER : ". strtoupper($supp['nama_supplier']);
		}else{
			echo "ALL SUPPLIER";
		}
	?>
</b>
<br>
<br>
<table class="datatable3" style="width:100%" border="1">
	<thead bgcolor="#024a75" style="color:white; font-size:12;">
		<tr bgcolor="#024a75" style="color:white; font-size:12; text-align:center">
      <td>NO</td>
      <td>TGL</td>
      <td>NO BUKTI</td>
      <td>SUPPLIER</td>
			<td>AKUN</td>
			<td>SALDO AWAL</td>
			<td>PEMBELIAN</td>
			<td>PENYESUAIAN</td>
			<td>PEMBAYARAN</td>
			<td>SALDO AKHIR</td>
    </tr>
  </thead>
  <tbody>
		<?php
			$totalsaldoawal 		= 0;
			$totalpembelian 		= 0;
			$totalpembayaran 		= 0;
			$totalpenyesuaian 	= 0;
			$totalsaldoakhir 		= 0;
			$no 								= 1;
			foreach ($pmb as $key => $d) {
        // echo $d->totalhutang+$d->penyesuaianbulanlalu."<br>";
        // echo $d->jmlbayarbulanlalu."<br>";
        if(($d->totalhutang + + $d->penyesuaianbulanlalu) != $d->jmlbayarbulanlalu OR !empty($d->jmlbayarbulanini)){
				//echo $d->jmlbayarbulanlalu;
				if(empty($d->jmlbayarbulanlalu)){
					if($dari > $d->tgl_pembelian){
					//	echo "A";
						$saldoawal = $d->totalhutang - $d->jmlbayarbulanlalu;
					}else{
					//	echo "B";
						$saldoawal = 0;
					}
				}else{
				//	echo "C";
					$saldoawal = $d->totalhutang - $d->jmlbayarbulanlalu;
				}

				if(empty($d->penyesuaianbulanlalu)){
					if($dari > $d->tgl_pembelian){
					//	echo "A";
						$saldoawal = $saldoawal + $d->penyesuaianbulanlalu;
					}else{
					//	echo "B";
						$saldoawal = 0;
					}
				}else{
				//	echo "C";
					$saldoawal = $saldoawal + $d->penyesuaianbulanlalu;
				}


				$saldoakhir 		 = $saldoawal + $d->pmbbulanini - $d->jmlbayarbulanini + $d->penyesuaianbulanini;
				$totalsaldoawal  = $totalsaldoawal + $saldoawal;
				$totalpembelian  = $totalpembelian + $d->pmbbulanini;
				$totalpembayaran = $totalpembayaran + $d->jmlbayarbulanini;
				$totalpenyesuaian = $totalpenyesuaian + $d->penyesuaianbulanini;
				$totalsaldoakhir = $totalsaldoakhir + $saldoakhir;
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $d->tgl_pembelian; ?></td>
				<td><?php echo $d->nobukti_pembelian; ?></td>
				<td><?php echo $d->nama_supplier; ?></td>
				<td><?php echo $d->nama_akun; ?></td>
				<td align="right"><?php if(!empty($saldoawal)){echo uang($saldoawal);} ?></td>
				<td align="right"><?php if(!empty($d->pmbbulanini)){echo uang($d->pmbbulanini);} ?></td>
				<td align="right"><?php if(!empty($d->penyesuaianbulanini)){echo uang($d->penyesuaianbulanini);} ?></td>
				<td align="right"><?php if(!empty($d->jmlbayarbulanini)){echo uang($d->jmlbayarbulanini);} ?></td>
				
				<td align="right"><?php echo uang($saldoakhir); ?></td>
			</tr>
		<?php
      }
			$no++;
			}
		?>
		<tr bgcolor="#024a75" style="color:white">
			<td colspan="5"><b>TOTAL</b></td>
			<td align="right"><?php if(!empty($totalsaldoawal)){echo uang($totalsaldoawal);} ?></td>
			<td align="right"><?php if(!empty($totalpembelian)){echo uang($totalpembelian);} ?></td>
			<td align="right"><?php if(!empty($totalpenyesuaian)){echo uang($totalpenyesuaian);} ?></td>
			<td align="right"><?php if(!empty($totalpembayaran)){echo uang($totalpembayaran);} ?></td>
			<td align="right"><?php echo uang($totalsaldoakhir); ?></td>
		</tr>
	</tbody>

</table>

<br>
