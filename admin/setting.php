<?php include "header.php"; 

if($_SESSION['user_role']=='0'){
	header("Location:http://localhost/news-site/admin/post.php");
}

?>
 <div id = "admin-content">
   <div class = "container">
        <div class = "row">
		  <div class = "col-md-12">
		        <h1 class = "admin-heading"> WEBSITE SETTING</h1>
			</div>
			<div class = "col-md-offset-3 col-md-6">
			 <!-- From -->
			 <?php 
			 include "config.php";
			 $sql = "SELECT * FROM satting";
			 $result = mysqli_query($conn,$sql)or die("Query fail:setting");
			 if(mysqli_num_rows($result)>0){
				 while($row = mysqli_fetch_assoc($result)){
					 
				
			 
			 ?>
			 <form action= "save-setting.php" method ="POST" enctype = "multipart/form-data">
			    <div class = "form-group">
				   <label for = "website_name">Website Name</label>
				   <input type ="text" name = "website" value = "<?php  echo $row['website_name']; ?>" class = "form-control" autocomplete = "off" required>
				</div>
				<div class = "form-group">
				   <label for = "">Website Logo</label>
				   <input type = "file" name = "new_logo">
				   <img src ="upload/<?php echo $row['website_logo']; ?>" height = "100px">
				   <input type = "hidden" 	name = "old_logo" value ="<?php echo $row['website_logo']; ?>">
				</div>
				<div class = "form-group">
				  <label for = "exampleInputPassword1">Footer Description</label>
				 <textarea name="footerdesc" class="form-control"  required rows="2">
                    <?php echo $row['footer']; ?>
                </textarea>
				  </div>
				  <input type ="submit" name = "submit" class ="btn btn-primary" value = "Update"/>
				  </form>
				  <?php
				  
				 }
			 }
				  
				  ?>
				</div>
				   

            </div>
		</div>
    </div>
</div>	
<?php include "footer.php"; ?>
			

