<?php

$conn = mysqli_connect("localhost","root","","news-site")or 
die("connection fail".mysqli_connect_error());
if(empty($_FILES['new_image']['name'])){
	$new_name = $_POST['old_image'];


}else{
	
	$error = array();
    $file_name = $_FILES['new_image']['name'];
	$file_size = $_FILES['new_image']['size'];
	$file_tmp = $_FILES['new_image']['tmp_name'];
	$file_type = $_FILES['new_image']['type'];
	$file_ext = end(explode('.',$file_name));
	$extensions = array('jpg','jpeg','png');
	if(in_array($file_ext,$extensions) === false){
		$error[]="This extesion file not allowed,Please choose a jpg,jpeg,png.";
	}
	if($file_size > 2097152){
		$error = "File size must be 2mb or lower.";
	}
		$new_name = time()."_".basename($file_name);
	$target = "upload/".$new_name;
	if(empty($error)== true){
		move_uploaded_file($file_tmp,$target);
	}else{
		print_r($error);
		die();
	}

	
}   

  $sql  = "UPDATE post SET title = '{$_POST["post_title"]}',description = '{$_POST['postdesc']}',category = {$_POST["category"]},post_img = '{$new_name}'
           WHERE post_id = {$_POST["post_id"]};";
		   if($_POST['old_category'] != $_POST['category']){
			    $sql.= "UPDATE  category SET post= post+1 WHERE category_id = {$_POST['category']};";
				$sql.= "UPDATE category SET post = post-1 WHERE category_id = {$_POST['old_category']};";
		   }
		 
 
 $result = mysqli_multi_query($conn ,$sql);
if($result){
	header("Location:http://localhost/news-site/admin/post.php");
}else{
	echo"query fail";
}
 
    
   
  
?>