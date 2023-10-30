<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: check.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome Back!!</title>
  <link rel="stylesheet" href="ChatApp/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Welcome Back!!</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="iAmADr">
          <input type="checkbox" name="I am a doctor" id="doctorCheckLog">
          <label for="doctorCheckLog">I am a doctor</label>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="doctorlogin.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="ChatApp/javascript/pass-show-hide.js"></script>
  <script src="ChatApp/javascript/loginn.js"></script>

</body>
</html>
