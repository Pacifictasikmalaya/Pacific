
<div class="card">
  <div class="header bg-cyan">
    <h2>
      Data Kontra BON
      <small>Edit Data Kontra BON</small>
    </h2>
  </div>
  <div class="body">
    <form autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>pembelian/update_kontrabon">
      <div class="row clearfix">
        <div class="col-sm-6">
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">chrome_reader_mode</i>
            </span>
            <div class="form-line">
              <input type="text" readonly value="<?php echo $kb['no_kontrabon']; ?>" id="nokontrabon" name="nokontrabon" class="form-control" placeholder="No Kontra BON" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">contacts</i>
            </span>
            <div class="form-line">
              <input type="hidden" value="<?php echo $kb['kode_supplier']; ?>" id="kodesupplier" name="kodesupplier" class="form-control" placeholder="Kode Supplier" data-error=".errorTxt19" />
              <input readonly type="text" value="<?php echo $kb['nama_supplier']; ?>" id="supplier" name="supplier" class="form-control" placeholder="Supplier" data-error=".errorTxt19" />
            </div>
          </div>
          <div class="input-group demo-masked-input"  >
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" value="<?php echo $kb['tgl_kontrabon']; ?>" id="tgl_kontrabon" name="tgl_kontrabon" class="form-control datepicker date" placeholder="Tanggal Kontra Bon" data-error=".errorTxt19" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="info-box bg-cyan hover-zoom-effect" style="min-height:170px">
              <div class="icon" style="height:170px; padding:40px 0; width:200px">
                <i class="material-icons">shopping_cart</i>
              </div>
              <div class="content">
                <div id="grandtotal" style="padding:30px 0px 50px 0px; font-size:60px; margin-left:90px"></div>
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="body">
          <div class="col-md-12">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Bukti</th>
                  <th>Keterangan</th>
                  <th>Jumlah Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1; $total = 0; foreach($detail as $d){ $total = $total +$d->jmlbayar;

                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $d->nobukti_pembelian; ?></td>
                    <td><?php echo $d->keterangan; ?></td>
                    <td align="right"><?php echo number_format($d->jmlbayar,'2',',','.'); ?></td>
                    <td>
                      <a href="#" data-nokontrabon = "<?php echo $d->no_kontrabon; ?>" data-nobukti = "<?php echo $d->nobukti_pembelian; ?>"  class="btn btn-xs bg-teal edit">Edit</a>
                    </td>
                  </tr>
                <?php $no++; }  ?>
              </tbody>
              <tr>
                <td colspan="3">TOTAL</td>
                <td align="right" >
                  <b id="total"> <?php echo number_format($total,'2',',','.'); ?></b>
                  <input type="hidden" id="grandtot" name="grandtot" value="<?php echo number_format($total,'2',',','.'); ?>">
                </td>
              </tr>
              <tr>
                <td >Terbilang</td>
                <td colspan="3" align="right"><b><?php echo strtoupper(terbilang($total)); ?></b></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-offset-10">
          <button type="submit" name="submit" class="btn btn-success btn-sm">Update</button>
          <a href="<?php echo base_url(); ?>pembelian/kontrabonkeuangan" class="btn btn-danger btn-sm">Kembali</a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="detailkontrabon" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="header bg-cyan">
          <h2>
            Edit Jumlah Bayar
            <small>Edit Jumlah Bayar</small>
          </h2>
        </div>
        <div class="body">
          <div class="row clearfix">
            <div class="col-sm-12">
              <div class="table-responsive">
                <div id="loadkontrabon"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>


<script type="text/javascript">
  $(function(){

    function loadgrandtotal()
    {
      var grandtot = $("#grandtot").val();
      $("#grandtotal").text(grandtot);
    }


    loadgrandtotal();
    


    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });

    $('.edit').click(function(e){
      var nokontrabon  = $(this).attr('data-nokontrabon');
      var nobukti      = $(this).attr('data-nobukti');
      $.ajax({
        type    : 'POST',
        url     : '<?php echo base_url(); ?>pembelian/edit_detailkb',
        data    : {nokontrabon:nokontrabon,nobukti:nobukti},
        cache   : false,
        success : function(respond){
          $("#loadkontrabon").html(respond);
          $("#detailkontrabon").modal("show");
        }
      });

    });
  });
</script>
