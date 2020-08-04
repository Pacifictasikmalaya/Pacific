<table class="table table-bordered table-hover table-striped">
  <tr style="font-weight:bold">
    <td>Tanggal Approve</td>
    <td>NO Bukti</td>
  </tr>
  <tr>
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
      <th>Qty Unit</th>
      <th>Qty Berat</th>
      <th>Qty Lebih</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no     = 1; 
    $total  = 0; 
    foreach($detail->result() as $d){  
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->nama_barang; ?></td>
        <td><?php echo $d->keterangan; ?></td>
        <td><?php echo number_format($d->qty_unit); ?></td>
        <td><?php echo number_format($d->qty_berat,2); ?></td>
        <td><?php echo number_format($d->qty_lebih,2); ?></td>
      </tr>
      <?php $no++; }  ?>
    </tbody>
  </table>

