<script>
	$(document).ready(function() {
	  $("#project").select2();
	});
</script>
<!-- <div class="container"> -->
	
	<div class="row">
		<form class="form-horizontal" method="post" action="<?php echo base_url(). 'project/set_project'; ?>">
		    <div class="form-group">  

		        <label for="inputEmail3" class="col-sm-2 control-label">
		          	Project
		        </label>
		        <div class="col-sm-4">
		          	<select class="form-control" onchange="" id="project" name="project">
						<option value="NULL"></option>
						<?php
						foreach ($project as $pro) {
							$selected = '';
							if($this->session->userdata('project_id') == $pro['project_id']) {
								$selected = 'selected';
							}
							?>
							<option value="<?php echo $pro['project_id']?>" <?php echo $selected?> ><?php echo $pro['name']?></option>
							<?php
						}
						?>
					</select>
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-4">
		        	<button type="submit" name="masuk" class="btn btn-info">Select</button>
		        </div>
		    </div>

		    <!-- /.box-footer -->
		</form>
	</div>
<!-- </div>container -->

<script>
function project(ev){
	var value=ev.target.value;
	location.href="?page=dashboard&idproject="+value;
}
</script>