<script>
	$(document).ready(function() {
	  $("#project_company_id").select2();
	  $("#project_id").select2();

	});
</script>
<!-- <div class="container"> -->
	
	<div class="row">
		<form class="form-horizontal" method="post" action="<?php echo base_url(). 'company/set_project_company'; ?>">
		    <div class="form-group">  

		        <label for="inputEmail3" class="col-sm-2 control-label">
		          	Company
		        </label>
		        <div class="col-sm-4">
		          	<select class="form-control" onchange="load_project()" id="project_company_id" name="project_company_id">
						<option value="NULL"></option>
						<?php
						foreach ($company as $company) {
							$selected = '';
							if($this->session->userdata('project_company_id') == $company['project_company_id']) {
								$selected = 'selected';
							}
							?>
							<option value="<?php echo $company['project_company_id']?>" <?php echo $selected?> ><?php echo $company['name']?></option>
							<?php
						}
						?>
					</select>
		        </div>
		    </div>

		    <div class="form-group">  

		        <label for="inputEmail3" class="col-sm-2 control-label">
		          	Project
		        </label>
		        <div class="col-sm-4">
		          	<select class="form-control" onchange="" id="project_id" name="project_id">
						<option value='0' <?php if($this->session->userdata('project_id') == 0 ) echo "selected"; ?> >INVENTARIS KANTOR</option>
						<?php
						foreach ($project as $project) {
							$selected = '';
							if($this->session->userdata('project_id') == $project['project_id']) {
								$selected = 'selected';
							}
							?>
							<option value="<?php echo $project['project_id']?>" <?php echo $selected?> ><?php echo $project['name']?></option>
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
function load_project(){
	$.ajax({
        type: "POST",
        url: "<?php echo base_url()?>company/load_project",
        data: {
			project_company_id:$("#project_company_id").val(),
		},
        success: function(html) {
        	$("#project_id").html(html);
        	// alert(html);
        }
    });
}
</script>