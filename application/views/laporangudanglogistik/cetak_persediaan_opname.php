<?php

function uang($nilai){

  return number_format($nilai,2,',','.');
}

error_reporting(0);

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
<br>
<b style="font-size:16px; font-family:Calibri">
  PACIFIC<br>
  REKAPITULASI PERSEDIAAN BARANG LOGISTIK<br>
</b>
<br>
<table class="datatable3" style="width:100%" border="1">
  <thead>
    <tr bgcolor="#024a75">
      <th rowspan="2" bgcolor="#024a75" style="color:white; font-size:14;">NO</th>
      <th rowspan="2" bgcolor="#024a75" style="color:white; font-size:14;">KODE BARANG</th>
      <th rowspan="2" bgcolor="#024a75" style="color:white; font-size:14;">NAMA BARANG</th>
      <th rowspan="2" bgcolor="#024a75" style="color:white; font-size:14;">SATUAN</th>
      <th colspan="3" style="color:white; font-size:14;">SALDO AWAL</th>
      <th colspan="3" style="color:white; font-size:14;">MASUK</th>
      <th colspan="3" style="color:white; font-size:14;">KELUAR</th>
      <th colspan="3" style="color:white; font-size:14;">STOK AKHIR KARTU GUDANG</th>
      <th rowspan="2" style="color:white; font-size:14;">OPNAME AKTUAL</th>
      <th rowspan="2" style="color:white; font-size:14;">SELISIH</th>
    </tr>
    <tr bgcolor="#024a75">
      <th style="color:white; font-size:14;">STOK</th>
      <th style="color:white; font-size:14;">HARGA</th>
      <th style="color:white; font-size:14;">JUMLAH</th>
      <th style="color:white; font-size:14;">QTY</th>
      <th style="color:white; font-size:14;">HARGA</th>
      <th style="color:white; font-size:14;">JUMLAH</th>
      <th style="color:white; font-size:14;">QTY</th>
      <th style="color:white; font-size:14;">HARGA</th>
      <th style="color:white; font-size:14;">JUMLAH</th>
      <th style="color:white; font-size:14;">QTY</th>
      <th style="color:white; font-size:14;">HARGA</th>
      <th style="color:white; font-size:14;">JUMLAH</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no               = 1;
    foreach ($data as $key => $d) {

      $stokakhir        = $d->qtysaldoawal + $d->qtypemasukan - $d->qtypengeluaran;
      if( !empty($d->qtypemasukan) OR !empty($d->qtypengeluaran) ) {

        $kode_kategori    = $d->kode_kategori;
        $qtyrata          = $d->qtysaldoawal + $d->qtypemasukan;
        if ($qtyrata != "") {
          $qtyrata        = $d->qtysaldoawal + $d->qtypemasukan;
        }else{
          $qtyrata        = 1;
        }

        $stokakhir      = $d->qtysaldoawal + $d->qtypemasukan - $d->qtypengeluaran;

        if ($d->hargasaldoawal == "" AND $d->hargasaldoawal == "0") {
          $hargakeluar      = $d->hargapemasukan;
        }elseif ($d->hargapemasukan == "" AND $d->hargapemasukan == "0") {
          $hargakeluar      = $d->hargasaldoawal;
        }else {
          $hargakeluar      = (($d->totalsa*1) + ($d->totalpemasukan*1)) / $qtyrata;
        }

        $jmlhpengeluaran  = $hargakeluar * $d->qtypengeluaran;

        $jmlstokakhir     = $stokakhir * $hargakeluar;
        $selsish          = $stokakhir - $d->qtyopname;

        $totqtystokakhir  += $stokakhir;
        $tothargasaldo    += $d->hargasaldoawal;
        $totalsaldoawal   += $d->totalsa;
        $totqtysaldoawal  += $d->qtysaldoawal;
        $totqtymasuk      += $d->qtypemasukan;
        $totalpemasukan   += $d->totalpemasukan;

        $totqtykeluar     += $d->qtypengeluaran;
        $totalpengeluaran += $jmlhpengeluaran;

        $totstokakhir     += $jmlstokakhir;
        $totalopname      += $d->qtyopname;
        $totalselisih     += $selsish;

        ?>
        <tr style="font-size: 12">
          <td <?php if (!empty($d->qtypemasukan) OR !empty($d->qtypengeluaran) ) { echo 'bgcolor="green"'; }?>><?php echo $no++;?></td>
          <?php  ?>
          <td><?php echo $d->kode_barang;?></td>
          <td><?php echo $d->nama_barang;?></td>
          <td><?php echo $d->satuan;?></td>
          <!-- Saldo Awal -->
          <td align="center">
            <?php 
            echo uang($d->qtysaldoawal,2); 
            ?>
          </td>
          <td align="right">
            <?php if ($d->kode_kategori == "K001") 
            {
              echo uang($d->hargasaldoawal,2); 
            } 
            ?>
          </td>

          <td align="right">
            <?php if ($d->kode_kategori == "K001") 
            {
              echo uang($d->totalsa,2); 
            } 
            ?>
          </td>
          <!-- Pemasukan -->
          <td align="center">
            <?php if (!empty($d->qtypemasukan) AND $d->qtypemasukan != "0") 
            {
              echo uang($d->qtypemasukan,2); 
            } 
            ?>
          </td>
          <td align="right">
            <?php if (!empty($d->hargapemasukan) AND $d->hargapemasukan != "0" AND $d->kode_kategori == "K001") 
            {
              echo uang($d->hargapemasukan,2); 
            } 
            ?>
          </td>
          <td align="right">
            <?php if (!empty($d->totalpemasukan) AND $d->totalpemasukan != "0" AND $d->kode_kategori == "K001") 
            {
              echo uang($d->totalpemasukan,2); 
            } 
            ?>
          </td>
          <!-- Pengeluaran -->
          <td align="center">
            <?php if (!empty($d->qtypengeluaran) AND $d->qtypengeluaran != "0") 
            {
              echo uang($d->qtypengeluaran,2); 
            } 
            ?>
          </td>
          <td align="right">
            <?php if (!empty($hargakeluar) AND $hargakeluar != "0" AND !empty($d->qtypengeluaran) AND $d->kode_kategori == "K001") 
            {
              echo uang($hargakeluar,2); 
            } 
            ?>
          </td>
          <td align="right">
            <?php if (!empty($jmlhpengeluaran) AND $jmlhpengeluaran != "0" AND $d->kode_kategori == "K001") 
            {
              echo uang($jmlhpengeluaran,2); 
            } 
            ?>
          </td>
          <!-- Stok Akhir -->
          <td align="center">
            <?php 
            echo uang($stokakhir,2); 
            ?>
          </td>
          <td align="right">
            <?php if ($d->kode_kategori == "K001") 
            {
              echo uang($hargakeluar,2); 
            } 
            ?>
          </td>
          <td align="right">
            <?php if ($d->kode_kategori == "K001") 
            {
              echo uang($jmlstokakhir,2); 
            }
            ?>
          </td>
          <!-- Opname -->
          <td align="center">
            <?php if (!empty($d->qtyopname) AND $d->qtyopname != "0") 
            {
              echo uang($d->qtyopname,2); 
            }
            ?>
          </td>
          <td align="center">
            <?php if (!empty($selsish) AND $selsish != "0") 
            {
              echo uang($selsish,2); 
            }else{
              echo "-";
            }
            ?>
          </td>

        </tr>
        <?php 
      }
    } 
    ?>
  </tbody>
  <tfoot bgcolor="#024a75" style="color:white; font-size:14;">
    <tr>
     <th style="color:white; font-size:14;" colspan="4">TOTAL</th>
     <th align="center">
      <?php if (!empty($totqtysaldoawal) AND $totqtysaldoawal != "0") 
      {
        echo uang($totqtysaldoawal,2); 
      }
      ?>
    </th>
    <th align="center">
    </th>
    <th align="center">
      <?php if (!empty($totalsaldoawal) AND $totalsaldoawal != "0"  AND $kode_kategori == "K001") 
      {
        echo uang($totalsaldoawal,2); 
      }
      ?>
    </th>
    <th align="center">
      <?php if (!empty($totqtymasuk) AND $totqtymasuk != "0") 
      {
        echo uang($totqtymasuk,2); 
      }
      ?>
    </th>
    <th></th>
    <th align="center">
      <?php if (!empty($totalpemasukan) AND $totalpemasukan != "0" AND $kode_kategori == "K001") 
      {
        echo uang($totalpemasukan,2); 
      }
      ?>
    </th>
    <th align="center">
      <?php if (!empty($totqtykeluar) AND $totqtykeluar != "0") 
      {
        echo uang($totqtykeluar,2); 
      }
      ?>
    </th>
    <th></th>
    <th align="center">
      <?php if (!empty($totalpengeluaran) AND $totalpengeluaran != "0" AND $kode_kategori == "K001") 
      {
        echo uang($totalpengeluaran,2); 
      }
      ?>
    </th>
    <th bgcolor="green" align="center">
      <?php if (!empty($totqtystokakhir) AND $totqtystokakhir != "0") 
      {
        echo uang($totqtystokakhir,2); 
      }
      ?>
    </th>
    <th></th>
    <th bgcolor="green" align="center">
      <?php if (!empty($totstokakhir) AND $totstokakhir != "0" AND $kode_kategori == "K001") 
      {
        echo uang($totstokakhir,2); 
      }
      ?>
    </th>
    <th align="center">
      <?php if (!empty($totalopname) AND $totalopname != "0") 
      {
        echo uang($totalopname,2); 
      }
      ?>
    </th>
    <th align="center">
      <?php if (!empty($totalselisih) AND $totalselisih != "0") 
      {
        echo uang($totalselisih,2); 
      }
      ?>
    </th>
  </tr>
</tfoot>
</table>
