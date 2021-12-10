<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
    echo "<script>alert('Please log in first to see this page.')</script>";
	echo "<script>window.location.href='login.php';</script>";
}

?>
  <li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
	  <span class="hidden-xs">System Administrator</span>
	</a>
	<ul class="dropdown-menu">
	  <!-- User image -->
	  <li class="user-header">
		<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

		<p>
		  System Administrator  
		</p>
	  </li>
	  <!-- Menu Body -->
	  
	  <!-- Menu Footer-->
	  <li class="user-footer">
		 
		<div class="pull-right">
		  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
		</div>
	  </li>
	</ul>
  </li>
  