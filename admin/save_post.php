<?php
include"config.php";
if(isset($_FILES['fileToUpload'])){
	$error = array();
	$file_name = $_FILES['fileToUpload']['name'];
	$file_size = $_FILES['fileToUpload']['size'];
	$file_tmp = $_FILES['fileToUpload']['tmp_name'];
	$file_type = $_FILES['fileToUpload']['type'];
	$file_ext = end(explode('.',$file_name));
	$extension = array('jpg','jpeg','png');
	
	if(in_array($file_ext,$extension)=== false){
		$error[] = "This file not allowed, Please Enter jpg,jpeg,png."; 
	}
	if($file_size > 2097152){
		$error = "File size must be 2mb or lower.";
	}
	$new_name = time()."_".basename($file_name);
	$target = "upload/".$new_name;
	if(empty($error)==true){
		move_uploaded_file($file_tmp,$target);
	}else{
		print_r($error);
		die();
	}
}
session_start();
$post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
$postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$Date = date("d M,Y");
$author = $_SESSION['user_id'];
$file_name;
$sql = "INSERT INTO post(title,description,category,post_date,author,post_img)
        VALUES('{$post_title}','{$postdesc}',{$category},'{$Date}',{$author},'{$new_name}');";
$sql.="UPDATE category SET post = post+1 WHERE category_id = {$category}";
if(mysqli_multi_query($conn,$sql)){
	header("Location:http://localhost/news-site/admin/post.php");
}else{
	echo "<divclass = 'alert alert-danger'>Query fail</div>";
}
?>