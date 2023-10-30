<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "chatapp";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];


    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
    else{ 
    $sql = "INSERT INTO `contact` (`name`, `email`, `msg`) VALUES ('$name', '$email', '$msg')";
    $result = mysqli_query($conn, $sql);
    }

    header('location:mainpageDr.php');
   
?>