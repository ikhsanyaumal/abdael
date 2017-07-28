<div class="container">
	<div class="row" style="margin-left:5px;">
		<div class="row" style="background:#efefef;">
			<ul class="nav nav-tabs">
				<li role="presentation"><a class="btn btn-default" href="<?php echo base_url()?>customer/customer_add" style="background:#eab1b1;" role="button"><span class="glyphicon glyphicon-plus"></span> Add Customer</a></li>
			</ul>
		</div>
	</div>
	
	<div class="row" style="height:10px">
	</div>

	<script>
		$(document).ready(function() {
		    $('#example').DataTable({
		    	"bPaginate": false,
			    "bLengthChange": false,
			    "bFilter": true,
			    "bInfo": false
		    });
		} );
	</script>

	<table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size:14px">
		<thead>
			<tr>
				<th field="nama">ID</th>
				<th field="nama">Nama</th>
				<th field="ktp">KTP</th>
				<th field="alamat">Alamat</th>
				<th field="alamat_surat">Alamat Surat</th>
				<th field="email">Email</th>
				<th field="telpon">Telpon</th>
				<th field="npwp">NPWP</th>
				<th field="npwp">ACTION</th>
			</tr>
		</thead>
		<?php
			
            foreach ($customer as $row){
			?>
			<tr>
				<td field="nama"><?php echo $row['customer_id'];?></td>
				<td field="nama"><?php echo $row['name'];?></td>
				<td field="ktp"><?php echo $row['ktp'];?></td>
				<td field="alamat"><?php echo $row['address'];?></td>
				<td field="alamat_surat"><?php echo $row['mail_address'];?></td>
				<td field="email"><?php echo $row['email'];?></td>
				<td field="telpon"><?php echo $row['phone'];?></td>
				<td field="npwp"><?php echo $row['npwp'];?></td>
				<td field="npwp" align="center">
					<a href="<?php echo base_url()?>customer/customer_update/<?php echo $row['customer_id']?>">EDIT</a>
					<?php 
					// if($location=="admin"){
					?>
						<br/><br/><a href="customer/delete/<?php echo $row['customer_id']?>">DELETE</a>
					<?php
					// }
					?>
				</td>
			</tr>
			<?php
			}
		?>
	</table>
	</br>
</div>

<script type="text/javascript">
	function editCustomer(a){
		// var row = $('#dg').datagrid('getSelected');
		// $('#dlg').dialog('open').dialog('setTitle','Edit Customer');
		// $('#fm').form('load',row);
		// url = 'customer_update.php?id='+row.id_customer;
		var row = $('#dg').datagrid('getSelected');
		if(row){
			location.href = "index.php?page=edit_customer&id="+row.id_customer+"&idproject="+a;
		}
	}

	function saveCustomer(){
		// alert(url);
		$('#fm').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				// var result = eval('('+result+')');
				// alert(result);
				$('#dlg').dialog('close');		// close the dialog
				$('#dg').datagrid('reload');	// reload the user data
				window.location.href = "index.php?page=add_spr&idproject="+idproject+"&id="+result;
				
			}
		});
	}
</script>

