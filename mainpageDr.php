<?php
session_start();
include_once "ChatApp/php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<?php
$unique_idd = $_SESSION['unique_id'];
$sqll = "SELECT * FROM users WHERE unique_id = '$unique_idd'";
$resultt = $conn->query($sqll);
if ($resultt->num_rows != 0) {
    echo "Debug: Redirecting to index.php";
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor | view</title>
  <link rel="icon" href="images/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/styling.css">
  <link rel="stylesheet" href="ChatApp/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <style>
    body {
      display: block;
      padding: 0 0;
    }

    body a {
      text-decoration: none;
    }

    .wrapper {
      display: flex;
      max-width: 100%;
    }

    .users {
      flex: 1;
      background-color: #fff;
      padding: 20px;
    }

    .chat-area {
      flex: 2;
      background-color: #f4f4f4;
      padding: 20px;
      display: block; 
    }
    @media (max-width:600px){
      .wrapper {
      display: flex;
      flex-direction: column;
      max-width: 100%;
    }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
  <a class="navbar-brand" href="mainpagedr.php"><img src="images/logo.png" width="45px" style="border-radius:50%" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="mainpagedr.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <header>
        <div class="content">
        <?php 
          $sql = mysqli_query($conn, "SELECT * FROM userdr WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
        ?>
          <a href="ChatApp/php/logoutDr.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
        </div>
      </header>
    </div>
  </div>
</nav>

<div class="wrapper" style="scale:0.75;margin-top:0em;">
  <section class="users">
    <header>
    <?php 
        $sql = mysqli_query($conn, "SELECT * FROM userdr WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
        }
      ?>
      <div class="content">
        <img src="ChatApp/php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname'] . ' ' . $row['lname']; ?>(You)</span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </div>
    </header>
    <div class="search">
      <span class="text">Select a user to start chat</span>
      <input type="text" placeholder="Enter a name to search...">
      <button><i class="fas fa-search"></i></button>
    </div>
    <div class="users-list">
      <?php include_once "ChatApp/php/publicusers.php"; ?>
    </div>
    <script>
      const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ChatApp/php/publicsearch.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}


    </script>
  </section>

  <section class="chat-area">
    <header>
    <?php 
            $sql = mysqli_query($conn, "SELECT * FROM userdr WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
      <img src="ChatApp/php/images/<?php echo $row['img']; ?>" alt="">
      <div class="details">
        <span><?php echo $row['fname'] . ' ' . $row['lname']; ?>(You)</span>
        <p><?php echo $row['status']; ?></p>
      </div>
    </header>
    <div class="chat-box">
      <div id="chat-messages"></div>
    </div>
    <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
  </section>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const chatArea = document.querySelector('.chat-area');
  const userLinks = document.querySelectorAll('.user-link');
  const chatMessagesContainer = document.getElementById('chat-messages');
  const chatBox = document.querySelector('.chat-box');
  let incoming_id = '';

  userLinks.forEach(userLink => {
    userLink.addEventListener('click', function () {
      incoming_id = this.getAttribute('data-user-id');
      document.querySelector('.incoming_id').value = incoming_id;
      chatArea.style.display = 'block'; // Show the chat area
      
      const form = document.querySelector(".typing-area");
      const inputField = form.querySelector(".input-field");
      const sendBtn = form.querySelector("button");

      form.onsubmit = (e) => {
        e.preventDefault();
      }

      inputField.focus();

      inputField.onkeyup = () => {
        if (inputField.value != "") {
          sendBtn.classList.add("active");
        } else {
          sendBtn.classList.remove("active");
        }
      }

      sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ChatApp/php/insert-chat.php", true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              inputField.value = "";
              scrollToBottom();
            }
          }
        }
        let formData = new FormData(form);
        xhr.send(formData);
      }

      chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
      }

      chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
      }

      setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ChatApp/php/gett-chat.php", true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.response;
              chatBox.innerHTML = data;
              if (!chatBox.classList.contains("active")) {
                scrollToBottom();
              }
            }
          }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
      }, 500);

      fetch('gett_chat_messages.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `incoming_id=${incoming_id}`,
      })
    });
  });
});

</script>


<section id="contact" class="py-5" style="background: url(images/dot_effect.png),linear-gradient(#c2d5e8,#f7f0e6);">
    <h2 style="text-align:center; margin-bottom:1em;color:grey;font-weight:700;">Contact</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="contactdr.php"  method="post" >
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="msg" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <button style="margin-top: 1em; background: linear-gradient(180deg, hsla(35, 52%, 94%, 1) 0%, hsla(210, 45%, 84%, 1) 100%);" type="submit" class="btn text-black">Submit</button>
                
                </form>
                <script>
                    document.getElementById("contact").addEventListener("submit", function () {
                        alert("Form submitted successfully!");
                    });
                </script>             
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2023 Depression sathi. <br>Creator->Anurag singh <br> All rights reserved.</p>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>