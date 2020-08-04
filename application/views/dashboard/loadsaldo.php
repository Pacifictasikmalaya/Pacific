<?php
function uang($nilai){
  return number_format($nilai,'2',',','.');
}
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Nama Barang</th>
      <th>Buffer Stok</th>
      <th>Stok Cabang</th>
    </tr>
  </thead>

<?php
foreach ($saldo as $r){
  if($r->saldoakhir <= 0){
    $color = "bg-red";
  }else{
    $color = "bg-green";
  }
 ?>
  <tr>
    <td><?php echo $r->nama_barang; ?></td>
    <td align="right"><span class="badge bg-blue"><?php echo number_format($r->buffer/$r->isipcsdus,'2',',','.'); ?></span></td>
    <td align="right"><span class="badge <?php echo $color; ?>"><?php echo number_format($r->saldoakhir/$r->isipcsdus,'2',',','.'); ?></span></td>
  </tr>
<?php } ?>
</table>
