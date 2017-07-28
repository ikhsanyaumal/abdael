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
	                "visible": false,
	                "searchable": false
	            }
	        ],
	    	"bPaginate": false,
		    "bFilter": true,
		    "bInfo": false,
		    "orderCellsTop": true,
		    select:true,
		    "dom": '<"toolbar">frtip',
        	// "scrollY":"530px",
        	// "scrollCollapse": true,
		    
	    });

		table.order([[1, "asc"]]).draw();

		$("#example thead input").on( 'keyup change', function () {
	        table
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	    } );

	    var button = 
	    	'<a class="btn btn-default" href="<?php echo base_url()?>voucher_in/voucher_in_add" role="button">New Voucher In</a>'+
			'<a class="btn btn-default" id="detail" role="button">Detail Voucher</a>';
		$("div.toolbar").html(button);

	    $('#detail').click( function () {
	        if (table.cell('.selected',0).data()) {
	        	var order_id = table.cell('.selected',0).data();
	        	location.href = "<?php echo base_url()?>voucher_in/voucher_in_add";
	        }else{
	        }
	    });

	} );
</script>

<div class="container" style="">
	<table id="example" class="table table-striped table-bordered" width="100%" style="font-family: Arial, Verdana, sans-serif;font-size:12px;">
		<thead>
			<tr>
				<th >Voucher_id</th>
				<th >Number</th>
				<th >Date</th>
				<th >Department</th>
				<th >Company</th>
				<th >Project</th>
				<th >Partner</th>
				<th >Kwitansi</th>
				<th >Target Date</th>
				<th >Real Date</th>
			</tr>
			<tr id="filterrow">
				<th >Voucher_id</th>
				<th >Number</th>
				<th >Date</th>
				<th >Department</th>
				<th >Company</th>
				<th >Project</th>
				<th >Partner</th>
				<th >Kwitansi</th>
				<th >Target Date</th>
				<th >Real Date</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            foreach ($voucher_in as $voucher_in){
			?>
				<tr>
					<td><?php echo $voucher_in['voucher_id']?></td>
					<td><?php echo $voucher_in['name']?></td>
					<td><?php echo $voucher_in['date']?></td>
					<td><?php echo $voucher_in['department_name']?></td>
					<td><?php echo $voucher_in['project_company_name']?></td>
					<td><?php echo $voucher_in['project_name']?></td>
					<td><?php echo $voucher_in['partner_name']?></td>
					<td><?php echo $voucher_in['partner_name']?></td>
					<td><?php echo $voucher_in['target_date']?></td>
					<td><?php echo $voucher_in['real_date']?></td>
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

