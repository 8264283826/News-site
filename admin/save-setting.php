<?php
include "config.php";
if(empty($_FILES['new_logo']['name'])){
	$logo =$_POST['old_logo'];
}else{
	
	
	
	$errors = array();
	$logo = $_FILES['new_logo']['name'];
	$logo_size = $_FILES['new_logo']['size'];
	$logo_tmp = $_FILES['new_logo']['tmp_name'];
	$logo_type = $_FILES['new_logo']['type'];
	$logo_ext = end(explode('.',$logo));
	$extesion = array("jpg","jpeg","png");
	if((in_array($logo_ext,$extesion) === false)){
		$errors[] = "This file not allowed, please choose a jpg,png or jpeg.";
	}
	if($logo_size>2097152){
		$errors[] = "File size must be 2mb or lower.";
	}
	if(empty($errors)==true){
		move_uploaded_file($logo_tmp,"upload/".$logo);
	}else{
		print_r($errors);
		die();
	}
}
 $sql = "UPDATE satting SET website_name = '{$_POST["website"]}',website_logo = '{$logo}', footer = '{$_POST["footerdesc"]}'
     ";
 $result =mysqli_query($conn,$sql)or die("Query fail: Update satting");
if($result){
	header("Location:http://localhost/news-site/admin/post.php");
}else{
	echo "Fail";
}



?>