<table class="table table-bordered table-hover table-striped">
<tr style="font-weight:bold">
  <td>TERIMA DARI</td>
  <td>TANGGAL</td>
  <td>NO KONTRA BON</td>

</tr>
<tr>
  <td><?php echo $kb['nama_supplier']; ?></td>
  <td><?php echo DateToIndo2($kb['tgl_kontrabon']); ?></td>
  <td><?php echo $kb['no_kontrabon']; ?></td>
</tr>
</table>
<table class="table table-bordered table-hover table-striped">
<thead>
  <tr>
    <th>No</th>
    <th>No Bukti</th>
    <th>Keterangan</th>
    <th>Jumlah</th>
  </tr>
</thead>
<tbody>
  <?php $no = 1; $total = 0; foreach($detail as $d){ $total = $total +$d->jmlbayar; ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><a href="#" class="detailpmb" data-nobukti ="<?php echo $d->nobukti_pembelian; ?>"><?php echo $d->nobukti_pembelian; ?></a></td>
      <td><?php echo $d->keterangan; ?></td>
      <td align="right"><?php echo number_format($d->jmlbayar,'2',',','.'); ?></td>
    </tr>
  <?php $no++; }  ?>
</tbody>
<tr>
  <td colspan="3">TOTAL</td>
  <td align="right"><b> <?php echo number_format($total,'2',',','.'); ?></b></td>
</tr>
</table>

<hr>

<div id="loaddetailpmb">

</div>

<script type="text/javascript">
  $(".detailpmb").click(function(e){
    e.preventDefault();
    var nobukti = $(this).attr("data-nobukti");
    $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url(); ?>pembelian/detailpembeliankb',
      data  : {nobukti:nobukti},
      cache : false,
      success : function(respond)
      {
        $("#loaddetailpmb").html(respond);
      }
    });
  });
</script>
