 <?php
  $content_lg_title = "Front Config";
  $content_sub_sm_title = "Front Config";
 ?>
<div class="box box-primary">
	<div class="box-body">
  <div class="row col-md-12" style="margin-bottom:30px">
	  <h3>
			&nbsp;Config
	  </h3>  
	  <hr/>
 </div>
  
 <div class="clearfix col-md-12 col-xs-12">
 <form name="configs" action="configsave.php" method="POST" enctype="multipart/form-data">
		<?php 
		$flConfig = file_get_contents("../config.php");
		
		$flConfig = str_replace(";", ';', str_replace("?>", '',  str_replace("<?php", '', $flConfig)));
		//file_put_contents("../config.txt",str_replace(";", ';', str_replace("? >", '',  str_replace("< ? php", '', $flConfig))));
		//$flRead = $flConfig;// file_get_contents('../config.php');
		
		 
		//echo $flRead;
		$i=0;
	 
		$array =  explode(';', $flConfig);
		foreach ($array as $item) {
			//echo "<li>$item</li>";
			
			$arrayLine =  explode('=', $item);
			
			switch ($i) {
				case 2:
					echo "<div class='form-group'>";
					echo "<label>Meta Title</label>";
					echo "<input type='text' class='form-control' id='txtMeta' name='txtMeta' placeholder='Masukkan Meta' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					break;
				case 3: 
					echo "<div class='form-group'>";
					echo "<label>Affiliasi</label>";
					echo "<input type='text' class='form-control' id='txtAffiliasi' name='txtAffiliasi' placeholder='Masukkan Affiliasi' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					
					$selected="";
					$tmp_prod= str_replace('&ref','',trim($arrayLine[2]));
					$tmp_subs= str_replace('&ref','',trim($arrayLine[3]));
					 
				 
					
					
					$prodConfig = file_get_contents("prods.txt");
					$arrayProd = explode(';', $prodConfig);
					echo "<div class='form-group'>";
					echo "<label>Product ID</label>";
					echo "<select class='form-control' id='cboProduct' name='cboProduct'>";
					
					
					foreach($arrayProd as $prodItem){
						$lineProduct = explode('|', $prodItem);
						if(trim($lineProduct[0]) != '')
						{
							$selected="";
							if($tmp_prod==$lineProduct[0])
							{
								$selected=" selected ";
							}
							
							echo "<option value='$lineProduct[0]' data-select2-id='$lineProduct[0]' $selected>$lineProduct[1]</option>";
						}
					}
					echo "</select>";
					echo "</div>";
					
					
					$subConfig = file_get_contents("subs.txt");
					$arraySub = explode(';', $subConfig);
					echo "<div class='form-group'>";
					echo "<label>Subs ID</label>";
					echo "<select class='form-control' id='cboSub' name='cboSub'>";
					
					
					
					foreach($arraySub as $subItem){
						$lineSubs = explode('|', $subItem);
						if(trim($lineSubs[0]) != '')
						{ 
							$selected="";
							$tmp_subs=str_replace('\'','',trim($tmp_subs));
							$subItem=str_replace('\'','',trim($subItem));
							if($tmp_subs==trim($lineSubs[0]))
							{
								$selected=" selected ";
							}
							$lineSubs[0]=trim($lineSubs[0]);
							$lineSubs[1]=trim($lineSubs[1]);
							//$subItem=trim($subItem);
							echo "<option value='$lineSubs[0]' data-select2-id='$lineSubs[0]' $selected>$lineSubs[1]</option>";
						}
					}
					echo "</select>";
					echo "</div>";
					
					break;
				case 4: 
					echo "<div class='form-group'>";
					echo "<label>Site URL</label>";
					echo "<input type='text' class='form-control' id='txtSiteURL' name='txtSiteURL' placeholder='Masukkan Site URL' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					break;
				case 5: 
					echo "<div class='form-group'>";
					echo "<label>Display HiStat</label>";
					echo "<input type='text' class='form-control' id='txtHiStat' name='txtHiStat' placeholder='Masukkan HiStat' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					break;				
				case 6: 
					echo "<div class='form-group'>";
					echo "<label>Site Meta Description</label>";
					echo "<input type='text' class='form-control' id='txtMatch' name='txtMatch' placeholder='Masukkan Match' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					break;
				case 7: 
					echo "<div class='form-group'>";
					echo "<label>Reff</label>";
					echo "<input type='text' class='form-control' id='txtReff' name='txtReff' placeholder='&s=XXXXX' value='".str_replace('\'','',trim($arrayLine[1]))."'>";
					echo "</div>";
					break;
			}
			
			
			$i++;
		}
		?>
		
		 <div class="form-group">
			 
				  
				<input type="submit" class="btn btn-info" name="submit" value="Submit">
			
		</div>
		  
	</form> 
	</div>
</div>
</div>


 