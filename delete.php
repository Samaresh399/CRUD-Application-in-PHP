<?php 
	
	require "Database/connect.php";

	$id =(int)$_GET['id'];
	$oneData = $con->findOne(["_id"=>$id]);
	$imageFilePath = (string)$oneData['userimage'];

	if(file_exists($imageFilePath))
	{
		unlink($imageFilePath);
	}
	$con->deleteOne(["_id"=>$id]);

	header("location:index.php");
?>