<?php

    require "connect.php";
    
    $id =(int)$_POST['id'];
    $name = $_POST['txt_fname']." ".$_POST['txt_lname'];
    $email = $_POST['txt_email'];
    $dob = $_POST['txt_date'];
    if (isset($_POST['rdo_gender']))
    {
        $gender = $_POST['rdo_gender'];
    }
    $imageName = random_int(11111.555, 99999.555)*20
    			+random_int(3333.555, 33333.555)."-".$_FILES['upload_image']['name'];

    $filePath = "../UserUploadedImages/".$imageName;
    move_uploaded_file($_FILES['upload_image']['tmp_name'], $filePath);
    $SavedFilePath = substr($filePath, 3,);

    $oneData = $con->findOne(["_id"=>$id]);
    $userImage = "../".$oneData["userimage"];
    if(file_exists($userImage))
    {
    	unlink($userImage);
    }

    $con->updateOne(['_id'=>$id],['$set'=>['name'=>$name, 'email'=>$email, 'dob'=>$dob, 'gender'=>$gender, 'userimage'=>$SavedFilePath]]);
?>