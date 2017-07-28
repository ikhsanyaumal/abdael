<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<!-- Bootstrap 3.3.5 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">

		<style>
			.loginbox{
				margin:180px auto;
				width: 450px;
				position: :relative;
				border-radius: 10px;
				background: #ffffff;
			}
			body{
				background-color: rgb(209,209,209);
			}
		</style>
	</head>
	<body>
		<div class="box box-info loginbox">
      <div class="box-header with-border">
        <h3 class="box-title">Login Page</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" method="post" action="<?php echo base_url('login'); ?>">
        <div class="box-body">
            <?php
            if ($this->session->flashdata('sukses')) {
              ?>
              <label for="inputEmail3" class="col-sm-12"><span style="color:red"><?php echo $this->session->flashdata('sukses');?></span></label>
              <?php
            }
            ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="reset" class="btn btn-default">Cancel</button>
          <button type="submit" name="masuk" class="btn btn-info pull-right">Sign in</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
	</body>
</html>