<table class="table table-bordered table-hover table-striped">
  <tr style="font-weight:bold">
    <td>Tanggal</td>
    <td>NO Bukti</td>
    <td>Departemen</td>
  </tr>
  <tr>
    <td><?php echo DateToIndo2($data['tgl_pengeluaran']); ?></td>
    <td><?php echo $data['nobukti_pengeluaran']; ?></td>
    <td><?php echo $data['nama_dept']; ?></td>
  </tr>
</table>
<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Ket</th>
      <th>Qty</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no     = 1; 
    foreach($detail->result() as $d){  
      ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $d->nama_barang; ?></td>
        <td><?php echo $d->keterangan; ?></td>
        <td><?php echo $d->qty; ?></td>
      </tr>
      <?php $no++; }  ?>
    </tbody>
  </table>

