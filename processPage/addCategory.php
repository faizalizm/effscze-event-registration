<?php

    $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't connect to server");


    $categoryname = $_POST["categoryname"];
    $categorylimit = $_POST["categorylimit"];
    $categorydetails = $_POST["categorydetails"];
    $categorystart = $_POST["categorystart"];
    $categoryend = $_POST["categoryend"];


    $insertCommand = "INSERT INTO webcategory (categoryname, categorylimit, categorydetails, categorystart, categoryend) VALUES ('$categoryname', '$categorylimit', '$categorydetails', '$categorystart', '$categoryend')";
    $insertExecute = mysqli_query($connect, $insertCommand);


    if($insertExecute){
        echo "<script>alert('Successfully added the category $categoryname');</script>";
        header("Location:successfulAdd.php");
    }
    else{
        $insertExecute = mysqli_query($connect, $insertCommand);

        if($insertExecute){
            header("Location:../sign.php");
        }
        else{
            echo "Error!";
        }   
    }

?>