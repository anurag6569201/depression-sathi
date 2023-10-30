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
  <title>Welcome !!</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="stylesheet" href="ChatApp/style.css">
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Welcome !!</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field input doctor" id="doctor">
            <label>Full Address</label>
            <input type="text" name="fullAddress" id = "drFulAdd" placeholder="First name">
          </div>
          <div class="field input doctor" id="doctor">
            <label>Document No</label>
            <input type="text" name="documentNumber" id = "drDocNum" placeholder="Document Number">
          </div>
          <div class="field image doctor" id="doctor">
          <label>Certificate Image</label>
          <input type="file" name="documentImage" id = "drDocImg" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        <div class="iAmADr">
          <input type="checkbox" name="I am a doctor" id="doctorCheck">
          <label for="doctorCheck">I am a doctor</label>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="ChatApp/javascript/pass-show-hide.js"></script>
  <script src="ChatApp/javascript/signup.js"></script>

</body>
</html>
