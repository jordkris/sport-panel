<?php

include 'koneksiDB.php'; 
 
$username = $_POST['txtUser'];
$password = $_POST['txtPass'];
$_SESSION['name']='';
$encPass = sha1($password) ;
 $_SESSION['loggedin'] = false;
try
{
	 
	 
	if($username=="admin" && $password=="admin"){
		 
		 
		session_start();			
		$_SESSION['username'] = $username;
		$_SESSION['name']= $rowLog['UserFullName'];
		$_SESSION['loggedin'] = true;
		echo "<script>alert('Welcome $username');</script>";
		 echo "<script>window.location.href='index.php';</script>";
	}else{
		echo "<script>alert('Invalid username or password');</script>";
		  echo "<script>window.location.href='login.php';</script>";
	}
}
 catch (Exception $e)
 {
	 echo "<script>alert('Please login first');</script>";
	  echo "<script>window.location.href='login.php';</script>";
 }
?>