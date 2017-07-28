<script>
	$(document).ready(function() {
		$('#example thead tr#filterrow th').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" style="width:100%;" placeholder="'+title+'"/>' );
	    } );

	    var table = $('#example').DataTable({
	    	"columnDefs": [
	            {
	                "targets": 0,
	                "visible": true,
	                "searchable": true
	            }
	        ],
	    	"bPaginate": true,
		    "bFilter": true,
		    "bInfo": false,
		    "orderCellsTop": true,
		    select:true,
		    "dom": '<"toolbar">frtip',
        	// "scrollY":"530px",
        	// "scrollCollapse": true,
		    
	    });

		table.order([[8, "asc"]]).draw();

		$("#example thead input").on( 'keyup change', function () {
	        table
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	    } );

	    var button = 
			'<a class="btn btn-default" id="payment" role="button">Payment Method</a>';
		$("div.toolbar").html(button);

	    $('#payment').click( function () {
	        if (table.cell('.selected',0).data()) {
	        	var order_id = table.cell('.selected',0).data();
	        	location.href = "<?php echo base_url()?>order/order_payment/"+order_id;
	        }else{
	        }
	    });

	} );
</script>

<div class="container" style="">
	<table id="example" class="table table-striped table-bordered" width="100%" style="font-family: 	Arial, Verdana, sans-serif;font-size:12px;">
		<thead>
			<tr>
				<th >Order_id</th>
				<th >Nama</th>
				<th >KTP</th>
				<th >Alamat</th>
				<th >Email</th>
				<th >Telpon</th>
				<th >NPWP</th>
				<th >Type</th>
				<th >Kavling</th>
				<th >Serah Terima</th>
			</tr>
			<tr id="filterrow">
				<th >Order_id</th>
				<th >Nama</th>
				<th >KTP</th>
				<th >Alamat</th>
				<th >Email</th>
				<th >Telpon</th>
				<th >NPWP</th>
				<th >Type</th>
				<th >Kavling</th>
				<th >Serah Terima</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            foreach ($order as $b){
			?>
				<tr>
					<td><?php echo $b['spr_id']?></td>
					<td><?php echo $b['name']?></td>
					<td><?php echo $b['ktp']?></td>
					<td><?php echo $b['address']?></td>
					<td><?php echo $b['email']?></td>
					<td><?php echo $b['phone']?></td>
					<td><?php echo $b['npwp']?></td>
					<td><?php echo $b['type_name']?></td>
					<td><?php echo $b['kavling_name']?></td>
					<td><?php echo $b['tanggal_serah_terima']?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</br>
</div>

<!-- start - pop up untuk pengalihan dan pembatalan -->

<!-- end -->
<script type="text/javascript">
	var url;
	function newSPR(a){
		location.href = "index.php?page=add_spr&idproject="+a;
	}
	function printSPR(id){			
		var row = $('#dg').datagrid('getSelected');
		if (row){
			window.open("pdf/print.php?spr="+row.spr_id+"&idproject="+id);
		}
	}
	function calcSPR(id){
		var row = $('#dg').datagrid('getSelected');
		if (row.dialihkan==""){
			location.href = "index.php?page=calc&spr="+row.spr_id+"&idproject="+id;
		}
	}
	
	function editSPR(id){
		var row = $('#dg').datagrid('getSelected');
		if(row){
			location.href = "index.php?page=edit_spr&spr="+row.spr_id+"&idproject="+id;
		}
	}
	
	function pembatalan(id){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			location.href = "index.php?page=batal&spr="+row.spr_id+"&idproject="+id;
		}
	}
	
	function pengalihan(id){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			if(row.dialihkan!=""){
				window.open("pengalihan/print_pengalihan.php?spr="+row.spr_id+"&idproject="+id);
			}else{
				$('#mv').dialog('open').dialog('setTitle','Pengalihan Hak');
				$('#vm').form('load',row);
				
				var s_data="";
				$.ajax({
					async: false,
					url: 'update_.php?cek=5',
					type: 'POST',
					dataType: 'json',
					data: {send: row.id},
					success: function(results) {
						s_data=results;
					}
				});
				$('#vm').form('load',s_data);
			}
		}
	}
	
	function save_pengalihan(){
		$('#vm').form('submit',{
			url: 'proses_pengalihan.php',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(data){
				var json = data;
				obj = JSON.parse(json);
				location.href='http://182.253.199.122/admin/index.php?page=calc&spr='+obj.spr_id+'&idproject='+_project;

				// var result = eval('('+result+')');
				// $('#mv').dialog('close');
				// //$('#mv').dialog('close');		// close the dialog
				// $('#dg').datagrid('reload');	// reload the user data
				
			}
		});
	}
	
	function saveSPR(){
		// alert(url);
		$('#fm').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(data){
				// var result = eval('('+result+')');
				
				$('#dlg').dialog('close');		// close the dialog
				$('#dg').datagrid('reload');	// reload the user data
				
			}
		});
	}
	
	function destroyUser(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
				if (r){
					$.post('destroy_user.php',{id:row.id},function(result){
						if (result.success){
							$('#dg').datagrid('reload');	// reload the user data
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.errorMsg
							});
						}
					},'json');
				}
			});
		}
	}
</script>

