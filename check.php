<?php
session_start();
include_once "ChatApp/php/config.php";

if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
} else {
  $unique_id = $_SESSION['unique_id'];

  $user_check_query = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
  $user_result = mysqli_query($conn, $user_check_query);
  
  $doctor_check_query = "SELECT * FROM userdr WHERE unique_id = {$_SESSION['unique_id']}";
  $doctor_result = mysqli_query($conn, $doctor_check_query);

  if (mysqli_num_rows($user_result) > 0) {
    header("location: index.php");
  } elseif (mysqli_num_rows($doctor_result) > 0) {
    header("location: mainpageDr.php");
  } else {
    header("location: login.php");
  }
}
?>