<?php
include "header.php";
if($_SESSION['user_role']=='0'){
	header("Location:http://localhost/news-site/admin/post.php");
}

$conn = mysqli_connect("localhost","root","","news-site")or die("connection fail");
$id = $_GET['id'];
$sql = "DELETE  FROM category WHERE category_id = {$id}";
if(mysqli_query($conn,$sql)){
	header("Location:http://localhost/news-site/admin/category.php");
}else{
	echo "<p style = 'color:red;margin:10px 0;text-align:center;'>proccess fail</p>"; 
}
mysqli_close($conn);

?>