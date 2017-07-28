<?php
$this->simple_login->cek_login();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Finance</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
    <!-- Bootstrap 3.3.5 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- datatable -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/select.dataTables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/datatable/css/fixedHeader.dataTables.min.css"/>

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/> -->
    <!-- select2-->
    <link href="<?php echo base_url()?>assets/dist/select2/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/themes/color.css">

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/dist/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url()?>assets/dist/jQuery/jquery-ui.min.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js"></script>
    <!-- datatable -->
    <script src="<?php echo base_url()?>assets/dist/datatable/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/dataTables.fixedHeader.min.js"></script>

    <!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> -->

    <script src="<?php echo base_url()?>assets/dist/datatable/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/jszip.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/datatable/js/buttons.print.min.js"></script>

    <!--
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    -->

    <!-- select2 -->
    <script src="<?php echo base_url()?>assets/dist/select2/js/select2.min.js"></script>
    
    <script src="<?php echo base_url()?>assets/dist/inputMask/jquery.inputmask.bundle.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
    * {
      margin-bottom: 2px !important;
    }
    
		.container {
			width: auto;
			/*background-color:#ffffff;*/
			/*border-bottom-color:#003366;*/
		}
		.draggable-list {
			background-color: #00C0EF;
			list-style: none;
			margin: 0;
			min-height: 70px;
			padding: 10px;
			width:100%;
			margin-top:-20px;
		}
		.draggable-item {
			background-color: #FFF;
			border: 1px dotted #000;
			cursor: move;
			display: block;
			font-weight: bold;
			color:#CC0033;
			margin: 5px;	
		}
		.toolbar {
		    float: left;
		}
		.form-fixer {
		   padding: 1px;
		   /*margin: 0 !important;*/
		}
    .row {
      margin-left: 0;
      margin-right: 0;
    }

    * {
      border-radius: 0 !important;
    }

    * {
      margin-bottom: 1px !important;
    }

     #loading {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      position: fixed;
      display: block;
      opacity: 0.7;
      background-color: #fff;
      z-index: 99;
      text-align: center;
    }

    #loading-image {
      position: absolute;
      top: 30%;
      left: 45%;
      z-index: 100;
      width: 10%;
    }
    
	</style>

	<!-- tampilan tabel
	<script type="text/javascript" src="dist/js/jquery.easyui.min.js"></script>
	-->
	
	<script type="text/javascript">
		Number.prototype.formatMoney = function(c, d, t){
			var n = this, 
				c = isNaN(c = Math.abs(c)) ? 2 : c, 
				d = d == undefined ? "." : d, 
				t = t == undefined ? "," : t, 
				s = n < 0 ? "-" : "", 
				i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
				j = (j = i.length) > 3 ? j % 3 : 0;
			   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};
		
		function unformat(x){
			var a = x;
			var c = "";
			var a = a.split('.').join(c);
			a = parseInt(a);
			
			return a;
		}
		
		function format(x){
			var a = x+"";
			var c = "";
			var a = a.split('.').join(c);
			a = parseInt(a);
			a = a.formatMoney(0, '', '.');
			return a;
		}

    $(document).ready(function() {
      $("._mask").inputmask("numeric", {
          radixPoint: ",",
          groupSeparator: ".",
          digits: 0,
          autoGroup: true,
          rightAlign: true,
          oncleared: function () { self.Value(''); }
      })
    });

    function bdzoom(){
      $("#loading").hide();
      // document.body.style.zoom=90/100;
    }
	
	</script>

  </head>
  <body class="hold-transition skin-green layout-top-nav" onLoad="bdzoom();" style="zoom:90%">

    <div id="loading">
      <img id="loading-image" src="<?php echo base_url()?>images/loading.gif"/>
    </div>

    <div class="wrapper nopadding">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a href="index.php?page=dashboard" class="navbar-brand"><b>ABDAEL</b>NUSA</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li>
                  <a href="<?php echo base_url()?>project">
                    Select Project
                  </a> 
                </li>
                <li>
                  <a href="<?php echo base_url()?>customer">
                    Customer
                  </a> 
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="<?php echo base_url()?>order">
                        SPPTB
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>order">
                        other
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="?page=rg">Tamu</a></li>
                    <li><a href="?page=rp">Penjualan</a></li>
                  </ul>
                </li>
              </ul>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->
                <?php
                // $photo = $_SESSION['photo'];
                // $username = $_SESSION['username'];
                ?>
                <li class="dropdown user user-menu">
                  <a href="index.php?page=user&idproject=1" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- <img src="" class="user-image" alt="User Image"> -->
                    <span class="hidden-xs"><?php echo $this->session->userdata('legal_username');?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="" class="img-circle" alt="User Image">
                      <p>
                        <small>@abdaelnusa</small>
                      </p>
                    </li>
                    <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="<?php echo base_url(). 'login/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                  </ul>
                </li>
                
              </ul>
            </div>
          <!-- /.navbar-custom-menu -->
          </div>
        <!-- /.container-fluid -->
        </nav>
      </header>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		    <section class="content-header"></section>
		      <?php
          echo $content;
		      ?>
      </div>
    </div><!-- ./wrapper -->
  </body>
</html>