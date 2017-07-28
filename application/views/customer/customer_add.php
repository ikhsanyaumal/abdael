<div class="container">
	<div class="row" style="margin-left:5px;">
		<div class="row" style="background:#efefef;">
			<ul class="nav nav-tabs">
				<li role="presentation"><a class="btn btn-default" href="javascript:history.go(-1)" role="button"><span class="glyphicon glyphicon-arrow-left"></span></a></li>
			</ul>
		</div>
	</div>

	<div class="row" style="background:#ffffff; height:20px;">
	</div>
</div>

<form class="form-inline" action="<?php echo base_url(). 'customer/add'; ?>" method="POST" enctype="multipart/form-data">
	<div class="row" style="margin-left:5px;">
		<div class="col-md-4">
			<h3><strong>Tambah Customer</strong></h3>
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			Nama
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" id="name" name="name" style="width:100%">
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			KTP
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="ktp" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			Alamat KTP
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="alamat_ktp" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			Alamat Surat
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="alamat_surat" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			Email
		</div>
		<div class="col-md-4">
			<input type="email" class="form-control" name="email" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			Telpon
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="phone" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			NPWP
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="npwp" style="width:100%" >
		</div>
	</div>
	<div class="row" style="margin-left:5px; margin-top:5px;">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-2">
			<button class="btn btn-primary" type="submit">Simpan</button>
		</div>
	</div>
</form>