<script type="text/javascript">
$(document).ready(function() {
  	$("#customer").select2();
  	$("#kavling").select2();
  	$("#agent").select2();
});
</script>
<?php
foreach ($order as $order);
?>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs">
			<li role="presentation"><a class="btn btn-default" href="javascript:history.go(-1)" role="button">
				<span class="glyphicon glyphicon-arrow-left"></span></a>
			</li>
			<li role="presentation">
				<a class="btn btn-default" role="button">
					<span class="glyphicon"><strong>UPDATE SPPTB</strong></span>
				</a>
			</li>
		</ul>
	</div>

	<div class="row" style="margin-left:5px;">
		<form class="form-horizontal" method="POST" action="<?php echo base_url()?>order/update/<?php echo $order['spr_id']?>">
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label"></label>
		    	<div class="col-sm-10">
		      		
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">Customer</label>
		    	<div class="col-sm-4">
		      		<select id="customer" class="form-control" name="customer">
		    			<option value="NULL"></option>
		    			<?php
		    			foreach ($customer as $res){
		    				$selected = '';
		    				if ($res['customer_id'] == $order['customer_id']) {
		    					$selected = 'selected';
		    				}
		    				?>
		    				<option value="<?php echo $res['customer_id']?>" <?php echo $selected;?> ><?php echo $res['name']?></option>
		    				<?php
		    			}
		    			?>
		    		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Kavling</label>
		    	<div class="col-sm-4">
		      		<select id="kavling" class="form-control" name="kavling">
		    			<option value="<?php echo $order['kavling_id']?>"><?php echo $order['type_name']?> - <?php echo $order['kavling_name']?></option>
		    			<?php
		    			foreach ($kavling as $res){
		    				if ($res['status_kavling'] == "0") {
		            			$state =  "<div class='alert alert-success'>FREE</div>";
		            		}elseif ($res['status_kavling'] == "1") {
		            			$state = "<div class='alert alert-warning'>HOLD</div>";
		            		}elseif ($res['status_kavling'] == "2") {
		            			$state = "<div class='alert alert-danger'>SOLD</div>";
		            		}
		    				$selected = '';
		    				if ($res['kavling_id'] == $order['kavling_id']) {
		    					$selected = 'selected';
		    				}
		    				?>
		    				<option value="<?php echo $res['kavling_id']?>" <?php echo $selected;?> ><?php echo $res['type']?> - <?php echo $res['name']?></option>
		    				<?php
		    			}
		    			?>
		    		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Agent</label>
		    	<div class="col-sm-4">
		      		<select id="agent" class="form-control" name="agent">
		    			<option></option>
		    			<?php
		    			foreach ($agent as $res){
		    				$selected = '';
		    				if ($res['agent_id'] == $order['agent_id']) {
		    					$selected = 'selected';
		    				}
		    				?>
		    				<option value="<?php echo $res['agent_id']?>" <?php echo $selected;?> ><?php echo $res['company']?> - <?php echo $res['name']?></option>
		    				<?php
		    			}
		    			?>
		    		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">Tgl Serah Terima</label>
		    	<div class="col-sm-4">
		      		<input type="date" class="form-control" id="inputEmail3" name="tanggal_serah" style="width:50%" value="<?php echo $order['tanggal_serah_terima']?>">
		    	</div>
		  	</div>
		  	<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
      				<button type="submit" class="btn btn-default">UPDATE</button>
    			</div>
  			</div>
		</form>
	</div>
</div>

<!-- <form class="form-inline" action="<?php echo base_url(). 'customer/add'; ?>" method="POST" enctype="multipart/form-data">

</form> -->