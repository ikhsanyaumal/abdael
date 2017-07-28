<script type="text/javascript">
$(document).ready(function() {
  	$("#customer").select2();
  	$("#kavling").select2();
  	$("#agent").select2();
});
</script>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs">
			<li role="presentation"><a class="btn btn-default" href="javascript:history.go(-1)" role="button">
				<span class="glyphicon glyphicon-arrow-left"></span></a>
			</li>
			<li role="presentation">
				<a class="btn btn-default" role="button">
					<span class="glyphicon"><strong>NEW SPPTB</strong></span>
				</a>
			</li>
		</ul>
	</div>

	<div class="row">
		<form class="form-horizontal" method="POST" action="<?php echo base_url()?>order/add">
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label"></label>
		    	<div class="col-sm-10">
		      		
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">Customer</label>
		    	<div class="col-sm-4">
		      		<select id="customer" class="form-control" name="customer">
		    			<option></option>
		    			<?php
		    			foreach ($customer as $res){
		    				?>
		    				<option value="<?php echo $res['customer_id']?>" ><?php echo $res['name']?></option>
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
		    			<option></option>
		    			<?php
		    			foreach ($kavling as $res){
		    				?>
		    				<option value="<?php echo $res['kavling_id']?>" ><?php echo $res['type']?> - <?php echo $res['name']?></option>
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
		    				?>
		    				<option value="<?php echo $res['agent_id']?>" ><?php echo $res['company']?> - <?php echo $res['name']?></option>
		    				<?php
		    			}
		    			?>
		    		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label">Tgl Serah Terima</label>
		    	<div class="col-sm-4">
		      		<input type="date" class="form-control" id="inputEmail3" name="tanggal_serah" style="width:50%">
		    	</div>
		  	</div>
		  	<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
      				<button type="submit" class="btn btn-default">SIMPAN</button>
    			</div>
  			</div>
		</form>
	</div>
</div>

<!-- <form class="form-inline" action="<?php echo base_url(). 'customer/add'; ?>" method="POST" enctype="multipart/form-data">

</form> -->