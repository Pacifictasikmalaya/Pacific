<?php 
	$total = 0;
	foreach($detail as $d){ 
	

	$jmldus     = floor($d->jumlah / $d->isipcsdus);
    $sisadus    = $d->jumlah % $d->isipcsdus;

    if($d->isipack == 0){
        $jmlpack    = 0;
        $sisapack   = $sisadus;   
    }else{

        $jmlpack    = floor($sisadus / $d->isipcs);  
        $sisapack   = $sisadus % $d->isipcs;  
    }

    $jmlpcs = $sisapack;
?>
	<tr>
		<td><?php echo $d->kode_produk; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td align="center"><?php echo $jmldus; ?></td>
		<td align="center"><?php echo $jmlpack; ?></td>
		<td align="center"><?php echo $jmlpcs; ?></td>
		<td align="right"><a href="#" data-id="<?php echo $d->kode_produk; ?>" data-cabang="<?php echo $d->kode_cabang; ?>" class="btn bg-red btn-xs hapus"><i class="material-icons">delete</i></a></td>
	</tr>
<?php } ?>
	
	<script type="text/javascript">
		
		$(function(){
			function loadDetailRepackcabtmp(){
	          var cabang = $("#cabang").val();
	          $("#loaddetailrepaccabktmp").load("<?php echo base_url();?>repackreject/view_detailrepackcabtmp/"+cabang);
	        }
	        function cekdetailrepacktemp(){
	            var cabang = $("#cabang").val();
	            $.ajax({

	                type    : 'POST',
	                url     : '<?php echo base_url(); ?>repackreject/cekdetailrepackcabtemp',
	                data    : {cabang:cabang},
	                cache   :false,
	                success : function(respond){

	                    $("#cekdetailrepackcabtemp").val(respond);
	                }

	            });
	        }

			$(".hapus").click(function(e){
				var id 		= $(this).attr("data-id");
				var cabang 	= $(this).attr("data-cabang");
				e.preventDefault();
				$.ajax({

					type		: 'POST',
					url 		: '<?php echo base_url(); ?>repackreject/hapus_detailbrg',
					data 		: {kode_produk:id,cabang:cabang},
					cache		: false,
					success 	: function(respond){

						loadDetailRepackcabtmp();
						cekdetailrepacktemp();
						
					}
				});

			});

		


			


		});
	</script>

	