 <?php
  $content_lg_title = "Upload Files";
  $content_sub_sm_title = "Upload Files";
 ?>
<div class="box box-primary">
	<div class="box-body">
  <div class="row col-md-12" style="margin-bottom:30px">
	  <h3>
			&nbsp;Upload
	  </h3>  
	  <hr/>
 </div>
  
 <div class="clearfix col-md-12 col-xs-12">
		<form name="upload" action="actionupload.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Sports to upload</label>
			 <select id="cboSports" name="cboSports" class="form-control select2" style="width:100%"> 
				    
				<option value='Index'>HOME</option> 
				<option value='nfl'>NFL</option> 
				<option value='boxing'>BOXING</option> 
				<option value='nbaposter'>NBA</option> 
				<option value='nhl'>NHL</option> 
				<option value='soccer'>Soccer</option> 
				<option value='ufc'>UFC</option> 
				<option value='ncaa'>NCAA</option> 
				<option value='mlb'>MLB</option> 
						 
					 
			</select>
		</div>
		<div class="form-group">
			 
				<label for="image">File input</label>
				<input type="file" name="image">
				<p class="help-block">Select File To Upload</p>
				<input type="submit" class="btn btn-info" name="upload" value="upload">
			
		</div>
		</form>
	</div>
</div>
</div>


 