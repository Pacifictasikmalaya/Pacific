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
  REKAP PEMBELIAN PER AKUN <br>
  PERIODE <?php echo DateToIndo2($dari)." s/d ".DateToIndo2($sampai); ?><br>
</b>
<br>
<br>
<table class="datatable3" style="width:70%" border="1">
  <thead bgcolor="#024a75" style="color:white; font-size:12;">
    <tr bgcolor="#024a75" style="color:white; font-size:12; text-align:center">
      <td>KODE AKUN</td>
      <td>NAMA AKUN</td>
      <td>TOTAL DEBET</td>
      <td>TOTAL KREDIT</td>
    </tr>
  </thead>
  <tbody>
    <?php
    $totalkredit   = 0;
    $totaldebet    = 0;
    $no            = 1;
    foreach ($pmb as $key => $d) {
      if($d->status=='PNJ')
      {
        $debet      = "";
        $kredit     = $d->total;
      }else{
        $debet      = $d->total;
        $kredit     = "";
      }
      ?>
      <tr  style="background-color:<?php echo $bgcolor; ?>">
        <td><?php echo "'".$d->kode_akun; ?></td>
        <td><?php echo $d->nama_akun; ?></td>
        <td align="right"><?php echo uang($debet); ?></td>
        <td align="right"><?php echo uang($kredit); ?></td>
      </tr>
      <?php
      $no++;
    }
    ?>
    <!-- <tr bgcolor="#024a75" style = "color:white">
      <td colspan="2"><b>TOTAL</b></td>
      <td align="right"><b><?php echo uang($totaldebet); ?></b></td>
      <td align="right"><b><?php echo uang($totalkredit); ?></b></td>
    </tr> -->
  </tbody>

</table>
