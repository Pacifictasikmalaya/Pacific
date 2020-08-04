
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Detail Setoran Pusat
    </h2>
  </div>
  <div class="body">
    <div class="row clearfix">
      <div class="col-sm-12">
        <table class="table table-hover table-bordered">
          <thead>
            <th>No</th>
            <th>Tanggal Setoran</th>
            <th>Tgl Input</th>
            <th>Tgl Aksi</th>
          </thead>
          <tbody>
	    
            <?php
              $no = 1; 
              foreach($setoranpusat->result() as $g){
             ?>
              <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $g->tgl_setoranpusat; ?></td>
              <td><?php echo $g->tgl_input; ?></td>
              <td><?php echo $g->tgl_aksi; ?></td>
              </tr>
             <?php $no++; } ?>
             
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">

