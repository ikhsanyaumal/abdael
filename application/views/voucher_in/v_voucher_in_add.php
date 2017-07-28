<script>
	$(document).ready(function() {
	  $("#department_id").select2();
	  $("#partner_id").select2();
	  $("#coa_id").select2();
	});
</script>

<?php
$order = array('name' => '', 
				'address' => '', 
				'type_name' => '', 
				'kavling_name' => '', 
		);
?>
<div class="container">
	<div class="row">
		<ul class="nav nav-tabs">
			<li role="presentation"><a class="btn btn-default" href="javascript:history.go(-1)" role="button">
				<span class="glyphicon glyphicon-arrow-left"></span></a>
			</li>
			<li role="presentation">
				<a class="btn btn-default" role="button">
					<span class="glyphicon"><strong>VOUCHER IN</strong></span>
				</a>
			</li>
		</ul>
	</div>

	<form class="form-horizontal">
		<div class="row">
			<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-2 control-label"></label>
		    	<div class="col-sm-10">
		      		
		    	</div>
		  	</div>
			<div class="col-md-6" style="font-family: Arial, Verdana, sans-serif;font-size:12px;">
			  	<!-- <div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Voucher Number</label>
			    	<div class="col-sm-8">
			      		<input type="text" class="form-control" value="<?php echo $order['name']?>" ></input>
			    	</div>
			  	</div> -->
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Voucher Date</label>
			    	<div class="col-sm-8">
			      		<input type="date" class="form-control" required></input>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Department</label>
			    	<div class="col-sm-8">
			      		<select class="form-control" id="department_id" required>
			      			<?php
			      			foreach ($department as $department) {
			      				?>
			      				<option value="<?php echo $department['department_id']?>" ><?php echo $department['name']?></option>
			      				<?php
			      			}
			      			?>
			      		</select>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Partner</label>
			    	<div class="col-sm-8">
			      		<select class="form-control" id="partner_id" required>
			      			<?php
			      			foreach ($partner as $partner) {
			      				?>
			      				<option value="<?php echo $partner['partner_id']?>" ><?php echo $partner['name']?></option>
			      				<?php
			      			}
			      			?>
			      		</select>
			    	</div>
			  	</div>
			</div>
			<div class="col-md-6" style="font-family: Arial, Verdana, sans-serif;font-size:12px;">
				<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">Target - Real Date</label>
			    	<div class="col-sm-4">
			      		<input type="date" class="form-control" required ></input>
			    	</div>
			    	<div class="col-sm-4">
			      		<input type="date" class="form-control" required ></input>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label">C O A</label>
			    	<div class="col-sm-8">
			      		<select class="form-control" id="coa_id" required>
			      			<?php
			      			foreach ($coa as $coa) {
			      				?>
			      				<option value="<?php echo $coa['coa_id']?>" ><?php echo $coa['code']?> - <?php echo $coa['name']?></option>
			      				<?php
			      			}
			      			?>
			      		</select>
			    	</div>
			  	</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label"></label>
			    	<div class="col-sm-8">
			    		
			    	</div>
			  	</div>
				<div class="form-group">
			    	<label for="inputPassword3" class="col-sm-4 control-label"></label>
			    	<div class="col-sm-8">
			    		<button type="submit" class="btn btn-default" role="button" id="btn_count" style="width:100%">ADD VOUCHER IN</button>
			    	</div>
			  	</div>
			</div>
		</div>
	</form>
</div>