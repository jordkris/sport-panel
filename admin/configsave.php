<?php  

if (isset($_POST['submit'])) {
	
	$Meta=$_POST['txtMeta'];
	$Affiliasi = $_POST['txtAffiliasi'];
	 
	$SiteURL = $_POST['txtSiteURL']; 
	$HiStat = $_POST['txtHiStat']; 
	$Match = $_POST['txtMatch']; 
	$product = $_POST['cboProduct'];
	$subs=$_POST['cboSub'];
	$Reff = $_POST['txtReff'];
	
	$Affiliasi.="=".trim($product)."&ref=".$subs."$Reff";
	
	$StringToSave="<?php \r\n";
	$StringToSave.="error_reporting(E_ALL ^ E_NOTICE);\r\n";
	$StringToSave.="require_once('input/function.php');\r\n";
	$StringToSave.="\$meta_title  = '".$Meta."';\r\n";
	$StringToSave.="\$affliasi    = '".$Affiliasi."';\r\n";
	$StringToSave.="\$site_url    = '".$SiteURL."';\r\n";
	$StringToSave.="\$displayHistat = '".$HiStat."';\r\n";
	$StringToSave.="\$match='".$Match."';\r\n";
	$StringToSave.="\$reff = '".$Reff."';\r\n";
	// Sample Afiliasi '//look.opskln.com/offer?prod=604&ref=5044540';
	 
	$StringToSave.="define('TOPPATH', \$_SERVER['DOCUMENT_ROOT'] );\r\n";
	$StringToSave.="?> ";
	file_put_contents("../config.php",$StringToSave);
	echo "<script>alert('Data has been saved');</script>";
	echo "<script>window.location.href='front.php';</script>";
}

?>