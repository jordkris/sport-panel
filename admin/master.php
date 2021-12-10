<!DOCTYPE html>
<html>
<head>
  
  <title>Administrator | <?php echo $title_header ?></title>
  <?php include "elementheader.php" ?>
  
  <!-- link rel="stylesheet" href="plugins/summernote/summernote-bs4.css" -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "insideheading.php" ?>
  <?php include "insidemainsidebar.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <?php include($page_content);?>
     
  </div>
  
 <?php include "footer.php" ?>
 
</div>

<?php include "elementfooter.php" ?>
</body>
</html>
