<table class="table table-bordered table-hover table-striped">
  <tr style="font-weight:bold">
    <td>Tanggal Pembelian</td>
    <td>Tanggal Approve</td>
    <td>NO Bukti</td>
  </tr>
  <tr>
    <?php if ($data['tgl_pembelian'] != 0) { ?>
      <td><?php echo DateToIndo2($data['tgl_pembelian']); ?></td>
    <?php }else{ ?> 
      <td>-</td>
    <?php } ?> 
    <td><?php echo DateToIndo2($data['tgl_pemasukan']); ?></td>
    <td><?php echo $data['nobukti_pemasukan']; ?></td>
  </tr>
</table>
<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Ket</th>
      <th>Qty</th>
      <th>Harga</th>
      <th>Total</th>
      <th>Akun</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no     = 1; 
    $total  = 0; 
    foreach($detail->result() as $d){  
      $total = $total + ($d->qty * $d->harga); 
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->nama_barang; ?></td>
        <td><?php echo $d->keterangan; ?></td>
        <td><?php echo $d->qty; ?></td>
        <td align="right"><?php echo number_format($d->harga,'2',',','.'); ?></td>
        <td align="right"><?php echo number_format($d->qty * $d->harga,'2',',','.'); ?></td>
        <td><?php echo $d->kode_akun; ?> <?php echo $d->nama_akun; ?></td>
      </tr>
      <?php $no++; }  ?>
      <tr>
        <th colspan="5">TOTAL PEMBELIAN</th>
        <td align="right"><b> <?php echo number_format($total,'2',',','.'); ?></b></td>
      </tr>
    </tbody>
  </table>

