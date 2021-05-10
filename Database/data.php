<?php

    // Getting Values from FormData
    $imageName = random_int(11111.555, 99999.555)*20+random_int(3333.555, 33333.555)."-".$_FILES['upload_image']['name'];
    $filePath ="../UserUploadedImages/".$imageName;
    $name =  $_POST['txt_fname']." ".$_POST['txt_lname'];
    $email = $_POST['txt_email'];
    $dob = $_POST['txt_date'];
    if (isset($_POST['rdo_gender']))
    {
        $gender = $_POST['rdo_gender'];
    }
    //MongoDB Database Connectioning, Inserting one Record & Checking the Result
    require "connect.php";

    move_uploaded_file($_FILES['upload_image']['tmp_name'], $filePath);
    $SavedFilePath = substr($filePath, 3,);
    $id = rand(0,1000000);
    $InsertOneResult = $con->insertOne(['_id'=>$id,'name'=>$name, 'email'=>$email, 'dob'=>$dob, 'gender'=>$gender, 'userimage'=>$SavedFilePath]);
    if($InsertOneResult->getInsertedCount() > 0)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }

?>