<?php require_once('config.php');
?>
<html>
<head>
<title>Redirecting to Secure Page For Request <?php echo $row['name'];?><?php echo $desc_title;?> <?php echo $meta_title;?></title>
<meta http-equiv="refresh" content="0;url=<?php echo $affliasi;?>">
</head>
<body>
<?php include('histats.php');?>
</body>
</html>