
<div class="row clearfix">
  <div class="col-md-8">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
           INPUT DATA REKAP REJECT GUDANG
          <small>Input Data Rekap Reject Gudang</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <form name="autoSumForm" autocomplete="off" class="formValidate" id="formValidate"  method="POST" action="<?php echo base_url(); ?>repackreject/input_rejectgudang">
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">chrome_reader_mode</i>
                </span>
                <div class="form-line">
                  <input type="text" readonly value="" id="no_mutasi" name="no_mutasi" class="form-control" placeholder="No Mutasi Reject Gudang" data-error=".errorTxt19" />
                </div>
              </div>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">chrome_reader_mode</i>
                </span>
                <div class="form-line">
                  <input type="text" readonly value="" id="no_sj" name="no_sj" class="form-control" placeholder="No Surat Jalan" data-error=".errorTxt19" />
                </div>
              </div>
              <?php if($cb == 'pusat'){ ?>
              <div class="form-group" >
                <div class="form-line">
                  <select class="form-control" id="cabang" name="cabang">
                    <option value="">Pilih Cabang</option>
                    <?php foreach($cabang as $c){ ?>
                      <option value="<?php echo $c->kode_cabang; ?>"><?php echo strtoupper($c->nama_cabang); ?></option>
                     <?php } ?>
                  </select>
                </div>
              </div>
              <?php }else{ ?>
                <input type="hidden" readonly id="cabang" name="cabang" value="<?php echo $cb; ?>" class="form-control" placeholder="Kode Cabang"  />
              <?php } ?>
              <div class="input-group demo-masked-input"  >
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <div class="form-line">
                  <input type="text" readonly value="" id="tgl_sj" name="tanggal" class="form-control datepicker" placeholder="Tanggal Reject Gudang" data-error=".errorTxt19" />
                </div>
              </div>
              <hr>
              <table class="table table-bordered table-striped">
                <thead class = "" >
                  <tr>
                    <th rowspan="3" align="">No</th>
                    <th rowspan="3" style="text-align:center">Nama Barang</th>
                    <th colspan="6" style="text-align:center">Reject Gudang</th>
                  </tr>
                  <tr>
                    <th colspan="6" style="text-align:center">Kuantitas</th>
                  </tr>
                  <tr>
                    <th style="text-align:center">Jumlah</th>
                    <th style="text-align:center">Satuan</th>
                    <th style="text-align:center">Jumlah</th>
                    <th style="text-align:center">Satuan</th>
                    <th style="text-align:center">Jumlah</th>
                    <th style="text-align:center">Satuan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach ($barang as $b) {
                  ?>
                    <tr>
                      <td style="width:10px"><?php echo $no; ?></td>
                      <td style="width:200px">
                        <input type="hidden" name="kode_produk<?php echo $no; ?>" value="<?php echo $b->kode_produk;?>">
                        <input type="hidden" name="isipcsdus<?php echo $no; ?>" value="<?php echo $b->isipcsdus;?>">
                        <input type="hidden" name="isipack<?php echo $no; ?>" value="<?php echo $b->isipack;?>">
                        <input type="hidden" name="isipcs<?php echo $no; ?>" value="<?php echo $b->isipcs;?>">
                        <?php echo $b->nama_barang; ?>
                      </td>
                      <td style="width:100px">
                        <div class="input-group demo-masked-input" style="margin-bottom:0px; !important" >
                          <div class="form-line">
                            <input type="text" style="text-align:right" value="" id="jmldus" name="jmldus<?php echo $no; ?>" class="form-control"  data-error=".errorTxt19" />
                          </div>
                        </div>
                      </td>
                      <td style="width:50px"><?php echo $b->satuan; ?></td>
                      <td style="width:100px">
                        <?php if(!empty($b->isipack)){ ?>
                        <div class="input-group demo-masked-input" style="margin-bottom:0px; !important" >
                          <div class="form-line">
                            <input type="text" style="text-align:right" value="" id="jmlpack" name="jmlpack<?php echo $no; ?>" class="form-control"  data-error=".errorTxt19" />
                          </div>
                        </div>
                        <?php } ?>
                      </td>
                      <td style="width:50px">Pack</td>
                      <td style="width:100px">
                        <div class="input-group demo-masked-input" style="margin-bottom:0px; !important" >
                          <div class="form-line">
                            <input type="text" style="text-align:right" value="" id="jmlpcs" name="jmlpcs<?php echo $no; ?>" class="form-control"  data-error=".errorTxt19" />
                          </div>
                        </div>
                      </td>
                      <td style="width:50px">Pcs</td>
                    </tr>
                  <?php
                      $no++;
                      $jumproduk = $no-1;
                    }
                  ?>
                  <input type="hidden" value ="<?php echo $jumproduk; ?>" name="jumproduk">
                </tbody>
              </table>
              <div class="row clearfix">
                <div class="col-md-offset-8">
                  <input type="submit" name="submit" class="btn btn-lg bg-blue  waves-effect" value="SIMPAN">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="datasj" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card">
			  <div class="header bg-cyan">
			    <h2>
			      Data Surat Jalan
			     	<small>Pilih Data Surat Jalan</small>
			    </h2>
			  </div>
		    <div class="body">
		      <div class="row clearfix">
		        <div class="col-sm-12">
              <table class="table table-bordered table-striped table-hover" style="width:100%" id="mytable" >
                <thead>
                	<tr>
                    <th width="10px">No</th>
                    <th>No SJ</th>
                    <th>Tanggal SJ</th>
                    <th>Cabang</th>
                    <th>Aksi</th>
                	</tr>
                </thead>
              </table>
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

    function loadNoMutasi()
    {
      var no_sj     = $("#no_sj").val();
      var tanggal   = $("#tgl_sj").val();
      //alert(tanggal);
      $.ajax({
        url     : '<?php echo base_url(); ?>repackreject/getNomutasiRJG',
        type    :'POST',
        data    : {no_sj:no_sj,tgl_sj:tanggal},
        cache   : false,
        success : function(respond)
        {
          $("#no_mutasi").val(respond);
          console.log(respond);
        }
      });
    }

    $("#tgl_sj").change(function(){
      loadNoMutasi();
    });
    $(".formValidate").submit(function(){
      var no_sj           = $("#no_sj").val();
      var tanggal         = $("#tgl_sj").val();

      if(tanggal == ""){
        swal("Oops!", "Tanggal Reject Gudang Harus Diisi!", "warning");
        return false;
      }
    });
    $("#no_sj").click(function() {
  		$("#datasj").modal("show");
  	});

    //Datatable Dpb
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
	    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
	    };
	  };

	  var t = $("#mytable").dataTable({
	   	initComplete: function() {
	      var api = this.api();
	      $('#mytable_filter input').off('.DT').on('keyup.DT', function(e) {
	        if (e.keyCode == 13) {
	          api.search(this.value).draw();
			    }
			  });
	    },
	    oLanguage: {
        sProcessing: "loading..."
	    },
	    processing		: true,
	    serverSide		: true,
	    bLengthChange	: false,
	    ajax					: {"url": "<?php echo base_url();?>repackreject/jsonsj", "type": "POST"},
	    columns				: [
						            {
					                "data": "no_mutasi_gudang_cabang",
					                "orderable": false
						            },
						            {"data": "no_mutasi_gudang_cabang"},
						            {"data": "tgl_mutasi_gudang_cabang"},
						            {"data": "kode_cabang"},
						            {"data": "view"}
							        ],
	    order				: [[1, 'desc']],
	    rowCallback	: function(row, data, iDisplayIndex) {
	      var info 		= this.fnPagingInfo();
	      var page 		= info.iPage;
	      var length 	= info.iLength;
	      var index 	= page * length + (iDisplayIndex + 1);
	      $('td:eq(0)', row).html(index);
	    }
	  });
    $('#mytable tbody').on('click', 'a', function () {
     $("#no_sj").val($(this).attr("data-nosj"));
     $("#datasj").modal("hide");
     loadNoMutasi();
   });
    $('.datepicker').bootstrapMaterialDatePicker({
      format      : 'YYYY-MM-DD',
      clearButton : true,
      weekStart   : 1,
      time        : false
    });

  });
</script>
