<?php
	foreach ($order as $order);
	if(count($order)<1){
		$order = array('name' => '', 
						'address' => '', 
						'type_name' => '', 
						'kavling_name' => '', 
						'cluster_id' => '', 
						'spr_id' => '', 
						);
	}
?>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs">
			<li role="presentation"><a class="btn btn-default" href="<?php echo base_url().'order'?>" role="button">
				<span class="glyphicon glyphicon-arrow-left"></span></a>
			</li>
			<li role="presentation">
				<a class="btn btn-default" role="button">
					<span class="glyphicon"><strong>DETAIL PAYMENT</strong></span>
				</a>
			</li>
		</ul>
	</div>

	<div class="row">
		<form class="form-horizontal">
			<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label"></label>
		    	<div class="col-sm-10">
		      		
		    	</div>
		  	</div>
			<div class="col-md-5" style="font-family: Arial, Verdana, sans-serif;font-size:12px;">
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" value="<?php echo $order['name']?>" disabled></input>
			      		<input type="hidden" class="form-control" value="<?php echo $order['cluster_id']?>" id="cluster_id" disabled></input>
			      		<input type="hidden" class="form-control" value="<?php echo $order['spr_id']?>" id="spr_id" disabled></input>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Alamat</label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" value="<?php echo $order['address']?>" disabled></input>
			    	</div>
			  	</div>
			</div>
			<div class="col-md-5" style="font-family: Arial, Verdana, sans-serif;font-size:12px;">
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Type</label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" value="<?php echo $order['type_name']?>" disabled></input>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Kavling</label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" value="<?php echo $order['kavling_name']?>" disabled></input>
			    	</div>
			  	</div>
			</div>
		</form>
	</div>

	<div class="row" style="background:#ffffff; height:5px;">
	</div>

	<div class="row" style="background:#efefef; height:10px;">
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label"></label>
		  	</div>
		  	<!-- <div class="form-group">
		    	<a class="btn btn-default" role="button" onclick="save_detail()" style="width:100%">SAVE DETAIL</a>
		  	</div> -->
		  	<form id="count_result">
		  		<?php
		  		if ($history_transaksi) {
		  		?>
		  		<h3>Detail Uang Muka</h3>
				<table class="table table-bordered table-striped" width="100%">
					<thead>
						<tr>
							<th style="text-align:center;">
								Periode
							</th>
							<th style="text-align:center;">
								Uang Muka
							</th>
							<th style="text-align:center;">
								Date
							</th>
							<th style="text-align:center;">
								Payment
							</th>
							<th style="text-align:center;">
								Payment Date
							</th>
							<th style="text-align:center;">
								Status
							</th>
							<th style="text-align:center;">
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
				            <td align="center">
				            	Tanda Jadi
				            </td>
				            <td align="center">
				            	<input type='text' class='form-control _mask' value="<?php echo $payment['tanda_jadi'] ?>" disabled >
				            </td>
				            <td align="center">
				            	<input type='date' class='form-control' value="<?php echo $payment['tanggal_tanda_jadi'] ?>" disabled >
				            </td>
				        </tr> -->
						<?php
						foreach ($payment as $payment);
						$total = 0;
						$total_payment = 0;
		          		foreach ($history_transaksi as $history_transaksi){
		          			$spr_id = $history_transaksi['spr_id'];
		          			$status = '';
		          			if ($history_transaksi['status'] == '1') {
		          				$status = 'disabled';
		          			}
						?>
						<tr>
				            <td align="center">
				            	<?php echo $history_transaksi['period']; ?>
				            </td>
				            <td align="center">
				            	<input type='text' id="" onchange="" class='form-control _mask' value="<?php echo $history_transaksi['payment']; ?>" disabled >
				            	<input type='hidden' id="kwitansi_id_<?php echo $history_transaksi['history_id']; ?>" value="<?php echo $history_transaksi['kwitansi_id']; ?>" disabled >
				            </td>
				            <td align="center">
				            	<input type='date' id="" onchange="" class='form-control' value="<?php echo $history_transaksi['payment_date']; ?>"  disabled >
				            </td>
				            <td align="center">
				            	<?php
				            	$kwitansi_payment = $history_transaksi['kwitansi_payment'];
				            	$kwitansi_date = $history_transaksi['date'];
				            	$kwitansi_id = $history_transaksi['kwitansi_id'];

				            	if ($history_transaksi['kwitansi_payment'] == '') {
				            		$kwitansi_payment = $history_transaksi['payment'];
				            		$kwitansi_date = $history_transaksi['payment_date'];
				            	}
				            	?>
				            	<input type='text' id="kwitansi_payment_dp_<?php echo $history_transaksi['history_id']?>" class='form-control _mask' value="<?php echo $kwitansi_payment; ?>" >
				            </td>
				            <td align="center">
				            	<input type='date' id="kwitansi_date_dp_<?php echo $history_transaksi['history_id']?>" class='form-control' value="<?php echo $kwitansi_date; ?>" >
				            </td>
				            <td align="center">
				            	<?php echo $history_transaksi['note']; ?>
				            </td>
				            <td align="center">
				            	<?php
				            	if ($history_transaksi['note'] != ''){
				            		// save child
				            	?>
			            			<button type="button" style="<?php if($history_transaksi['kwitansi_payment'] == '') echo 'background-color: #4CAF50'; ?>" class="btn btn-default" aria-label="Left Align" id="<?php echo $history_transaksi['history_id']; ?>" id="<?php echo $history_transaksi['history_id']; ?>" onclick="save_child('<?php echo $history_transaksi['history_id']; ?>')">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									</button>
									<input type='hidden' id="child_id_<?php echo $history_transaksi['history_id']; ?>" value="<?php echo $history_transaksi['child_id']; ?>" disabled >
			            		<?php	
				            	}else{
				            		// save parent
			            		?>
			            			<button type="button" style="<?php if($history_transaksi['kwitansi_payment'] == '') echo 'background-color: #4CAF50'; ?>" class="btn btn-default" aria-label="Left Align" id="<?php echo $history_transaksi['history_id']; ?>" id="<?php echo $history_transaksi['history_id']; ?>" onclick="save_kwitansi(<?php echo $history_transaksi['history_id']; ?>)">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									</button>
			            		<?php
				            	}
				            	?>
								<a href="<?php echo base_url()?>order/print_kwitansi_dp/<?php echo $history_transaksi['history_id']; ?>" type="button" class="btn btn-default" aria-label="Left Align" target="blank">
									<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
								</a>
								<?php
								if ($history_transaksi['kwitansi_payment'] != '' && $history_transaksi['note'] == '') {
								?>
								<div style="float:left" id="__<?php echo $kwitansi_id; ?>">
									<a data-toggle="modal" data-target="#tambah-data" id="<?php echo $kwitansi_id; ?>" class="btn btn-primary" >Tambahan</a>
								</div>
								<?php
								}
								?>
								<div style="float:left" id="div_<?php echo $history_transaksi['history_id']; ?>">

								</div>
				            </td>
				        </tr>
						<?php
						$total += $history_transaksi['payment'];
						$total_payment += $history_transaksi['kwitansi_payment'];
						}
						$sisa = $payment['uang_muka'] - $total;
			          	
		          		?>
		          		<tr>
				            <td align="center">
				            	<strong>Total</strong>
				            </td>
				            <td align="center">
				            	<input type='text' class='form-control _mask' value="<?php echo $total ?>" disabled >
				            </td>
				            <td align="center">

				            </td>
				            <td align="center">
				            	<input type='text' class='form-control _mask' value="<?php echo $total_payment ?>" disabled >
				            </td>
				            <td align="center">
				            	
				            </td>
				            <td align="center">

				            </td>
				            <td align="center">
				            	
				            </td>
						</tr>
					</tbody>
				</table>

				<script>
				function save_child(a){
					var kwitansi_payment = $("#kwitansi_payment_dp_"+a).val();
					var kwitansi_date = $("#kwitansi_date_dp_"+a).val();
					var kwitansi_id = $("#child_id_"+a).val();
					var cluster_id = $("#cluster_id").val();
					// alert(kwitansi_payment);
					// alert(kwitansi_id);
					$.ajax({
				        type: "POST",
				        url: "<?php echo base_url()?>order/update_child/"+kwitansi_id,
				        data: {
							kwitansi_payment: kwitansi_payment,
							kwitansi_date: kwitansi_date,
							cluster_id: cluster_id,
						},
						beforeSend: function() {
			              	// $("#loading").show();
			           	},
				        success: function(html) {
				        	// $("#loading").hide();
				        	// alert(html);
				        	// location.reload();
				        },
				        error: function(error) {
				        	alert(error);
				        	// location.reload();
				        },
				    });
				}

				function save_child_inhouse(a){
					var kwitansi_payment = $("#kwitansi_payment_cicilan_"+a).val();
					var kwitansi_date = $("#kwitansi_date_cicilan_"+a).val();
					var kwitansi_id = $("#child_id_"+a).val();
					var cluster_id = $("#cluster_id").val();
					// alert(kwitansi_payment);
					// alert(kwitansi_id);
					$.ajax({
				        type: "POST",
				        url: "<?php echo base_url()?>order/update_child/"+kwitansi_id,
				        data: {
							kwitansi_payment: kwitansi_payment,
							kwitansi_date: kwitansi_date,
							cluster_id: cluster_id,
						},
						beforeSend: function() {
			              	// $("#loading").show();
			           	},
				        success: function(html) {
				        	// $("#loading").hide();
				        	// alert(html);
				        	// location.reload();
				        },
				        error: function(error) {
				        	alert(error);
				        	// location.reload();
				        },
				    });
				}

				function save_kwitansi(a){
					var kwitansi_payment = $("#kwitansi_payment_dp_"+a).val();
					var kwitansi_date = $("#kwitansi_date_dp_"+a).val();
					var cluster_id = $("#cluster_id").val();
					var kwitansi_id = $("#kwitansi_id_"+a).val();
					// alert(a);
					$.ajax({
				        type: "POST",
				        url: "<?php echo base_url()?>order/save_kwitansi_dp",
				        data: {
							history_id: a,
							kwitansi_payment: kwitansi_payment,
							kwitansi_date: kwitansi_date,
							cluster_id: cluster_id,
						},
						beforeSend: function() {
			              	// $("#loading").show();
			           	},
				        success: function(html) {
				        	var kwitansi_id = html;
				        	$("#"+a).css("background-color", "#ffffff");
				        	$("#__"+kwitansi_id).remove();
				        	$("#div_"+a).html('<div id="__'+kwitansi_id+'"><a data-toggle="modal" data-target="#tambah-data" id="'+kwitansi_id+'" class="btn btn-primary" >Tambahan</a></div>');
				        	// $("#loading").hide();
				        	// alert(html);
				        	// location.reload();
				        },
				        error: function(error) {
				        	alert(error);
				        	// location.reload();
				        },
				    });
				}

				function print_kwitansi(a){
					// alert(a);
					var spr_id = <?php echo $spr_id;?>;
					$.ajax({
				        type: "POST",
				        url: "<?php echo base_url()?>order/print_kwitansi_dp",
				        data: {
				        	spr_id: spr_id,
							history_id: a,
						},
						beforeSend: function() {
			              	$("#loading").show();
			           	},
				        success: function(html) {
				        	// alert(html);
				        	location.reload();
				        }
				    });
				}
				</script>
				<?php
				}

		  		if ($history_inhouse) {
		  		?>
		  		<h3>Detail Cicilan</h3>
				<table class="table table-bordered table-striped" width="100%">
					<thead>
						<tr>
							<th style="text-align:center;">
								Periode
							</th>
							<th style="text-align:center;">
								Cicilan
							</th>
							<th style="text-align:center;">
								Date
							</th>
							<th style="text-align:center;">
								Payment
							</th>
							<th style="text-align:center;">
								Payment Date
							</th>
							<th style="text-align:center;">
								Status
							</th>
							<th style="text-align:center;">
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = 0;
						$total_payment = 0;
		          		foreach ($history_inhouse as $history_inhouse){
		          			$status = '';
		          			if ($history_inhouse['status'] == '1') {
		          				$status = 'disabled';
		          			}
						?>
						<tr>
				            <td align="center">
				            	<?php echo $history_inhouse['period']; ?>
				            </td>
				            <td align="center">
				            	<input type='text' id="" class='form-control _mask' value="<?php echo $history_inhouse['payment']; ?>" disabled >
				            </td>
				            <td align="center">
				            	<input type='date' id="" class='form-control' value="<?php echo $history_inhouse['payment_date']; ?>"  disabled >
				            	<input type='hidden' id="inhouse_kwitansi_id_<?php echo $history_inhouse['history_id']; ?>" value="<?php echo $history_inhouse['kwitansi_id']; ?>" disabled >
				            </td>
				            <td align="center">
				            	<?php
				            	$kwitansi_payment = $history_inhouse['kwitansi_payment'];
				            	$kwitansi_date = $history_inhouse['date'];
				            	$kwitansi_id = $history_inhouse['kwitansi_id'];

				            	if ($history_inhouse['kwitansi_payment'] == '') {
				            		$kwitansi_payment = $history_inhouse['payment'];
				            		$kwitansi_date = $history_inhouse['payment_date'];
				            	}
				            	?>
				            	<input type='text' id="kwitansi_payment_cicilan_<?php echo $history_inhouse['history_id']?>" class='form-control _mask' value="<?php echo $kwitansi_payment; ?>" >
				            </td>
				            <td align="center">
				            	<input type='date' id="kwitansi_date_cicilan_<?php echo $history_inhouse['history_id']?>" class='form-control' value="<?php echo $kwitansi_date; ?>" >
				            </td>
				            <td align="center">
				            	<?php echo $history_inhouse['note']; ?>
				            </td>
				            <td align="center">
				            	<?php
				            	if ($history_inhouse['note'] != ''){
				            		// save child
				            	?>
			            			<button type="button" style="<?php if($history_inhouse['kwitansi_payment'] == '') echo 'background-color: #4CAF50'; ?>" class="btn btn-default" aria-label="Left Align" id="<?php echo $history_inhouse['history_id']; ?>" id="<?php echo $history_inhouse['history_id']; ?>" onclick="save_child_inhouse('<?php echo $history_inhouse['history_id']; ?>')">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									</button>
									<input type='hidden' id="child_id_<?php echo $history_inhouse['history_id']; ?>" value="<?php echo $history_inhouse['child_id']; ?>" disabled >
			            		<?php	
				            	}else{
				            		// save parent
			            		?>
			            			<button type="button" style="<?php if($history_inhouse['kwitansi_payment'] == '') echo 'background-color: #4CAF50'; ?>" class="btn btn-default" aria-label="Left Align" id="<?php echo $history_inhouse['history_id']; ?>" id="<?php echo $history_inhouse['history_id']; ?>" onclick="save_kwitansi_cicilan(<?php echo $history_inhouse['history_id']; ?>)">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									</button>
			            		<?php
				            	}
				            	?>
								<a href="<?php echo base_url()?>order/print_kwitansi_inhouse/<?php echo $history_inhouse['history_id']; ?>" type="button" class="btn btn-default" aria-label="Left Align" target="blank">
									<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
								</a>
								<?php
								if ($history_inhouse['kwitansi_payment'] != '' && $history_inhouse['note'] == '') {
								?>
								<div style="float:left" id="__<?php echo $kwitansi_id; ?>">
									<a data-toggle="modal" data-target="#tambah-data2" id="<?php echo $kwitansi_id; ?>" class="btn btn-primary" >Tambahan</a>
								</div>
								<?php
								}
								?>
								<div style="float:left" id="div_<?php echo $history_inhouse['history_id']; ?>">

								</div>
				            </td>
				        </tr>
						<?php
						$total += $history_inhouse['payment'];
						$total_payment += $history_inhouse['kwitansi_payment'];
						}
		          		?>
		          		<tr>
				            <td align="center">
				            	<strong>Total</strong>
				            </td>
				            <td align="center">
				            	<input type='text' class='form-control _mask' value="<?php echo $total ?>" disabled >
				            </td>
				            <td align="center">

				            </td>
				            <td align="center">
				            	<input type='text' class='form-control _mask' value="<?php echo $total_payment ?>" disabled >
				            </td>
				            <td align="center">
				            	
				            </td>
				            <td align="center">

				            </td>
				        </tr>
					</tbody>
				</table>
				<script>
				function save_kwitansi_cicilan(a){
					var kwitansi_payment = $("#kwitansi_payment_cicilan_"+a).val();
					var kwitansi_date = $("#kwitansi_date_cicilan_"+a).val();
					var cluster_id = $("#cluster_id").val();
					var kwitansi_id = $("#inhouse_kwitansi_id_"+a).val();
					// alert(kwitansi_date);
					$.ajax({
				        type: "POST",
				        url: "<?php echo base_url()?>order/save_kwitansi_cicilan",
				        data: {
							history_id: a,
							kwitansi_payment: kwitansi_payment,
							kwitansi_date: kwitansi_date,
							cluster_id: cluster_id
						},
						beforeSend: function() {
			              	// $("#loading").show();
			           	},
				        success: function(html) {
				        	var kwitansi_id = html;
				        	$("#"+a).css("background-color", "#ffffff");
				        	$("#__"+kwitansi_id).remove();
				        	$("#div_"+a).html('<div id="__'+kwitansi_id+'"><a data-toggle="modal" data-target="#tambah-data2" id="'+kwitansi_id+'" class="btn btn-primary" >Tambahan</a></div>');
				        	// $("#loading").hide();
				        	// alert(html);
				        	// location.reload();
				        },
				        error: function(error) {
				        	alert(error);
				        	// location.reload();
				        },
				    });
				}
				</script>
				<?php 
				}
				?>
			</form>
		</div>

		<script>
		var detail_um = [];
		var detail_inhouse = [];

		function collect_id(a){
			var payment = $("#detail_payment_"+a).val();
			var date = $("#detail_date_"+a).val();
			detail_um.push([a,payment,date]);
		}

		function collect_id_inhouse(a){
			var payment = $("#detail_payment_"+a).val();
			var date = $("#detail_date_"+a).val();
			detail_inhouse.push([a,payment,date]);
		}

		function save_detail(){
			$.ajax({
		        type: "POST",
		        url: "<?php echo base_url()?>order/order_payment_detail_save",
		        data: {
					detail_um:detail_um,
					detail_inhouse:detail_inhouse,
				},
		        success: function(html) {
		        	alert('Data berhasil disimpan...');
		        	location.reload();
		        }
		    });
		}
		</script>
	</div>

</div>

<script>
	$(document).ready(function() {
	  // $('[name="child_ket"]').select2();
	});
</script>

<!-- Modal Tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'order/save_kwitansi_dp_child'?>" method="post" enctype="multipart/form-data" role="form">
	            <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label"></label>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="kwitansi_id" id="kwitansi_id">
                            <input type="hidden" class="form-control" name="cluster" id="cluster">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Payment</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control _mask" name="child_payment" id="child_payment" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Date</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control" name="child_date" id="child_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Ket</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="child_ket" style="width:100%" required>
                            	<option value="Child">Child</option>
								<option value="PPN">PPN</option>
								<option value="FURNITURE">FURNITURE</option>
							</select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#tambah-data').on('show.bs.modal', function(e) {      
    var $modal = $(this),
        esseyId = e.relatedTarget.id;
    $modal.find('#kwitansi_id').val(esseyId);

    var cluster_id = $("#cluster_id").val();
    $modal.find('#cluster').val(cluster_id);
})
</script>

<!-- Modal Tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Tambah Data Inhouse</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'order/save_kwitansi_cicilan_child'?>" method="post" enctype="multipart/form-data" role="form">
	            <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label"></label>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="inhouse_kwitansi_id" id="inhouse_kwitansi_id">
                            <input type="hidden" class="form-control" name="inhouse_cluster" id="inhouse_cluster">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Payment</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control _mask" name="inhouse_child_payment" id="inhouse_child_payment" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Date</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control" name="inhouse_child_date" id="inhouse_child_date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Ket</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="child_ket" style="width:100%" required>
								<option value="Child">Child</option>
								<option value="PPN">PPN</option>
								<option value="FURNITURE">FURNITURE</option>
							</select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#tambah-data2').on('show.bs.modal', function(e) {      
    var $modal = $(this),
        esseyId = e.relatedTarget.id;
    $modal.find('#inhouse_kwitansi_id').val(esseyId);

    var cluster_id = $("#cluster_id").val();
    $modal.find('#inhouse_cluster').val(cluster_id);
})
</script>