<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
      <div class="header bg-cyan">
        <h2>
          DATA SUPPLIER
          <small>Data Supplier</small>
        </h2>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">

          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-12">
            <a href="<?php echo base_url(); ?>pembelian/inputsupplier" class="btn btn-danger">Tambah Data</a>
            <hr>
            <div class="table table-responsive">
              <table class="table table-bordered table-striped table-hover" style="width:110%" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Contact Person</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No Rekening</th>
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
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
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
        $('#mytable_filter input')
          .off('.DT')
          .on('keyup.DT', function(e){
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
      },
      oLanguage: {
        sProcessing: "loading..."
      },
      processing    : true,
      serverSide    : true,
      bLengthChange : false,
      ajax          : {"url"  : "<?php echo base_url();?>pembelian/jsonSupplier/", "type": "POST"},
      columns       : [
                        {
                          "data"      : "kode_supplier",
                          "orderable" : false
                        },
                        {"data": "kode_supplier"},
                        {"data": "nama_supplier"},
                        {"data": "contact_supplier"},
                        {"data": "nohp_supplier"},
                        {"data": "alamat_supplier"},
                        {"data": "email"},
                        {"data": "norekening"},
                        {"data": "view"}
                      ],
      order       : [[1, 'asc']],
      rowCallback : function(row, data, iDisplayIndex) {
        var info    = this.fnPagingInfo();
        var page    = info.iPage;
        var length  = info.iLength;
        var index   = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });

    $('#mytable tbody').on('click', '.hapus', function () {
    var getLink = $(this).attr('data-href');
    swal({
      title               : 'Alert',
      text                : 'Hapus Data ?',
      html                : true,
      confirmButtonColor  : '#d43737',
      showCancelButton    : true,
    },function(){
      window.location.href = getLink
    });
   });
  });
</script>
