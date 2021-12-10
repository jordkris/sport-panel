<html>
	<head>
		 
		  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		  <!-- iCheck -->
		  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
		<title>Sport Admin Panel</title>
	<?php 

		//include "koneksiDB.php";
		?>
	</head>
	
	
	
	<body class="hold-transition login-page">
	<div class="login-box">
	   
	  <div class="login-box-body">
		<p class="login-box-msg" style="font-size:18pt"> Login</p>

		<form method="POST" action="LoginVal.php" id="frmLogin" onsubmit="return Validation()">
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" required placeholder="Masukkan User" id="txtUser" name="txtUser"/>
		 
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="password" required placeholder="Masukkan password Anda" id="txtPass" name="txtPass" class="form-control"/>
			 
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="row">
			
			<div class="col-xs-4">
				<input type="submit" class="btn btn-primary btn-block btn-flat" value="Login" /> 
			</div>
			<!-- /.col -->
		  </div>
		</form>

		 <div class="row"><center>copyright &copy; 2019 - Sports</center></div>

	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' /* optional */
		});
	  });
	</script>
	<script type="text/javascript">
	function redirectTo(sUrl) {
	window.location = sUrl
	}

function validation() {
		var username = document.getElementById("txtUser").value;
		var password = document.getElementById("txtPass").value;		
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Masukkan username dan password');
			return false;
		}
	}
</script>
	</body>
	
	
	
	 
	 
</html>