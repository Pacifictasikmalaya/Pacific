
<div class="row">
  <div class="col-md-12">
    <div class="col-md-6">
     <div class="card">
      <div class="header bg-green" >
        <h2>
          DATA PERSEDIAAN GUDANG
          <small>Data Persediaan Gudang</small>
        </h2>
      </div>
      <div class="body">
        <?php
        foreach ($rekap as $r){
          if($r->saldoakhir <= 0){
            $color = "bg-red";
          }else{
            $color = "bg-green";
          }
          ?>
          <li class="list-group-item"><b><?php echo $r->nama_barang; ?></b> <span class="badge <?php echo $color; ?>"><?php echo number_format($r->saldoakhir,'0','','.'); ?></span></li>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">
   <div class="card">
    <div class="header bg-blue" >
      <h2>
        DATA PERSEDIAAN GUDANG CABANG
        <small>Data Persediaan Gudang Cabang</small>
      </h2>
    </div>
    <div class="body">
      <?php if($cb == 'pusat'){ ?>
        <div class="form-group" >
          <div class="form-line">
            <select class="form-control" id="cabang" name="cabang">
              <?php foreach($cabang as $c){ ?>
                <option <?php if($cb==$c->kode_cabang){echo "selected"; } ?> value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      <?php }else{ ?>
        <input type="hidden" readonly id="cabang" name="cabang" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
      <?php } ?>
      <div id="loadsaldo">

      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="col-md-12">
      <div class="card">
        <div class="header bg-blue" >
          <h2>
            DATA PERSEDIAAN ALL CABANG
            <small>Data Persediaan All Gudang Cabang</small>
          </h2>
        </div>
        <div class="body">
          <div class="table-responsive">
            <div id="loadrekappersediaan">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="col-md-6">
      <div class="card">
        <div class="header bg-blue" >
          <h2>
            DATA PERSEDIAAN GUDANG CABANG
            <small>Data Persediaan Gudang Cabang</small>
          </h2>
        </div>
        <div class="body">
         
          <div class="form-group" >
            <div class="form-line">
              <select class="form-control" id="produk" name="produk">
                <?php foreach($produk as $c){ ?>
                  <option  value="<?php echo $c->kode_produk."|".$c->isipcsdus;?>"  ><?php echo strtoupper($c->nama_barang); ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
          <div id="loadsaldoproduk">

          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script type="text/javascript">
  $(function(){
    loadrekappersediaan();
    function loadrekappersediaan()
    {

      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>dashboard/loadrekappersediaan',
        cache : false,
        success: function(respond)
        {
          $("#loadrekappersediaan").html(respond);
        }
      });
    }

    function loadsaldo()
    {
      var kodecabang = $("#cabang").val();
      var status     = 'GS';
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url(); ?>dashboard/loadsaldo',
        data  : {kodecabang:kodecabang,status:status},
        cache : false,
        success: function(respond)
        {
          $("#loadsaldo").html(respond);
        }
      });
    }

    loadsaldo();
    $("#cabang").change(function(){
      loadsaldo();
    });

  });
</script>
