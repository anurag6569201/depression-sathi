
<?php
session_start();
include_once "ChatApp/php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<?php
$unique_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM userdr WHERE unique_id = '$unique_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "Debug: Redirecting to index.php";
    header("location: mainpageDr.php"); // Redirect to mainpageDr.php
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Depression Sathi</title>
  <link rel="icon" href="images/logo.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/styling.css">
  <link rel="stylesheet" type="text/css" href="css/responsiv.css">

</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="45px" style="border-radius:50%" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#feature">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tool">Tools</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#faqs">FAQs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        </div>
        <a href="ChatApp/php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
    </div>
  </div>
</nav>

<div class="container-fluid container_div">
  
  <div class="animated-title">
    <div class="text-top">
      <div>
        <span>You Deserve</span>
      </div>
    </div>
    <div class="text-bottom">
      <div> To Be Happy :)</div>
    </div>
  </div>

</div>

<div class="content_part">
  
    <h3 id="feature">What type of therapy are you looking for?</h3>

    <div class="card-group function">
      <div class="mainfeature" style="display:flex;align-items:center;justify-content:center;width:100%">
      <div class="card oldcard" onmouseenter="show_anim1()" onmouseleave="remove_anim1()">
        <a href="ChatApp/users.php"><img id="onepng" src="images/1.png" class="card-img-top img-fluid" alt="...">
        <small>Talk to Expert</small>
        <span id="farward_arr1">For teenagers<img src="images/icons/farward_but.png" alt=""></span>
        </a>
      </div>
      <div class="card oldcard" onmouseenter="show_anim2()" onmouseleave="remove_anim2()">
        <a href="ChatApp/gallery.html"><img id="twopng" src="images/2.png" class="card-img-top img-fluid" alt="..."></a>
        <small>Self Heal</small>
        <span id="farward_arr2">For myself <img src="images/icons/farward_but.png" alt=""></span>
      </div>
      <div class="card oldcard">
        <a href="ChatApp/chatviewer.php"><img id="threepng" src="images/bott.png" class="card-img-top img-fluid" alt="..."></a> 
        <small>Personal Chatbot</small>
        <span id="farward_arr3">ChatBot<img src="images/icons/farward_but.png" alt=""></span>
      </div>

      </div>



      <div class="newfeature" style="display:flex;align-items:center;justify-content:center;width:100%">
        <div class="card newcard">
          <?php
          $seed = mt_rand();

          $sql = "SELECT unique_id FROM users ORDER BY RAND($seed) LIMIT 1";
          
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $randomUserId = $row["unique_id"];
          } else {
              echo "No user IDs found in the database.";
          }
          ?>
          <a href="ChatApp/randchat.php?user_id=<?php echo $randomUserId;?>"><img id="onepng" src="images/communityyy.png" class="card-img-top img-fluid" alt="...">
          <small>Community Support</small>
          <span id="farward_arr1">Same type friends<img src="images/icons/farward_but.png" alt=""></span>
          </a>
        </div>
        <div class="card newcard">
          <a href="#"><img id="twopng" src="images/mooddd.png" class="card-img-top img-fluid" alt="..."></a>
          <small>Mood tracker</small>
          <span id="farward_arr2">For myself <img src="images/icons/farward_but.png" alt=""></span>
        </div>
      </div>

    </div>
    <style>
      .newcard:hover,
      .oldcard:hover{
        scale: 0.82;
        box-shadow:0 0 20px 6px grey;
      }
      ..newcard,
      .oldcard{
        transition:0.6s;
      }
    </style>

</div>

<div class="music_content" id="tool">
  <div class="music_banner_div">
    <img class="music_banner img-fluid" src="images/music_banner.png" alt="">
  </div>

  <h3>Mental health tools for real life.</h3>
  <div class="msc_thought">
    <small>Calm makes it easy to find what you're looking for <br> and explore it at your own pace. Whether you want to sleep better,<br> feel more relaxed, or improve your focus and productivity,<br> Calm has something for you.</small>
  </div>
  <div class="buttons_music">
    <a id="btn1" class="btn msc_btn1" onclick="msc_btn1()">Relaxation</a>
    <a id="btn2" class="btn msc_btn2" onclick="msc_btn2()">Inspiration</a>
    <a id="btn3" class="btn msc_btn3" onclick="msc_btn3()">Self-Care</a>
    <a id="btn4" class="btn msc_btn4" onclick="msc_btn4()">Positivity</a>
    <a id="btn5" class="btn msc_btn5" onclick="msc_btn5()">Calm</a>
  </div>

  <div id="songs-listened" class="msc_interface" >

<div class="row">

  <div id="msc_relax" class="col-sm-8 mb-3 mb-sm-0">
    <div class="card">

        <div class="card col-sm-6 mb-3 mb-sm-0">
          <div class="card-body card_text">
            <h5 class="card-title">We don't call it Calm for nothing.</h5>
            <p class="card-text">Open the app and enter a sanctuary of rest and relaxation, from soothing soundscapes to calming music to hundreds of titles for deep and peaceful sleep.</p>
            <small >Rain On Leaves</small>
            <audio  src="audio/relax/rain.mp3" controls=""></audio>
          </div>
        </div>

        <div class="card col-sm-6">
          <div class="card-body card_text">
            <img class="img-fluid" src="audio/relax/rain.webp" alt="">
          </div>
      </div>

    </div>
  </div>

  <div id="msc_inspiration" class="col-sm-8 mb-3 mb-sm-0">
    <div class="card">

        <div class="card col-sm-6 mb-3 mb-sm-0">
            <div class="card-body card_text">
                <h5  class="card-title">Fuel Your Inspiration.</h5>
                <p  class="card-text">Unlock your creativity and motivation with a collection of inspiring content, from motivational speeches to thought-provoking quotes.</p>
                <small >Motivational Speech</small>
                <audio  src="audio/relax/rain.mp3" controls=""></audio>
            </div>
        </div>

        <div class="card col-sm-6">
            <div class="card-body card_text">
              <img  class="img-fluid" src="audio/inspire/inspire.webp" alt="">
            </div>
        </div>

    </div>
  </div>

  <div id="msc_self_care" class="col-sm-8 mb-3 mb-sm-0">
    <div class="card">

        <div class="card col-sm-6 mb-3 mb-sm-0">
            <div class="card-body card_text">
                <h5  class="card-title">Take Care of Yourself.</h5>
                <p  class="card-text">Prioritize self-care with a variety of relaxation techniques, meditation exercises, and wellness tips to rejuvenate your body and mind.</p>
                <small >Meditation Session</small>
                <audio  src="audio/relax/rain.mp3" controls=""></audio>
            </div>
        </div>

        <div class="card col-sm-6" >
            <div class="card-body card_text">
                <img  class="img-fluid" src="audio/selfcare/selfcar.png" alt="">
            </div>
        </div>

    </div>
  </div>

  <div id="msc_positivity"  class="col-sm-8 mb-3 mb-sm-0">
    <div class="card">

        <div class="card col-sm-6 mb-3 mb-sm-0">
            <div class="card-body card_text">
                <h5 class="card-title">Embrace Positivity.</h5>
                <p class="card-text">Fill your life with positivity and optimism through uplifting quotes, daily affirmations, and motivational stories.</p>
                <small >Motivational Quote</small>
                <audio  src="audio/relax/rain.mp3" controls=""></audio>
            </div>
        </div>

        <div class="card col-sm-6">
            <div class="card-body card_text">
                <img class="img-fluid" src="audio/positivity/positivity.png" alt="">
            </div>
        </div>

    </div>
  </div>

  <div id="msc_calm" class="col-sm-8 mb-3 mb-sm-0">
    <div class="card">

        <div class="card col-sm-6 mb-3 mb-sm-0">
            <div class="card-body card_text">
                <h5 class="card-title">Find Inner Peace.</h5>
                <p class="card-text">Relax and unwind with soothing soundscapes, calming music, and guided meditation sessions to achieve inner calm and tranquility.</p>
                <small >Nature Sounds</small>
                <audio  src="audio/relax/rain.mp3" controls=""></audio>
            </div>
        </div>

        <div class="card col-sm-6">
            <div class="card-body card_text">
                <img class="img-fluid" src="audio/calm/calm.png" alt="">
            </div>
        </div>

    </div>
  </div>

</div>

</div>


  <div id="faqs" class="container mt-4">
        <h2>Frequently Asked Questions</h2>

        <div id="accordion">
            <div class="card" style="background-color:transparent;margin-top:1.4em">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Question 1: What is the main purpose of this project?
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        The primary aim of our project is to connect young individuals with licensed psychologists through our app. We provide a safe and accessible platform for them to receive mental health support, resources, and build a supportive community.
                    </div>
                </div>
            </div>

            <div class="card" style="background-color:transparent;margin-top:1.4em">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Question 2: How does this app help reduce the stigma around seeking mental health support?
                        </button>
                    </h5>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        Our app creates a supportive and empathetic environment where young people can openly discuss their mental health challenges. By connecting with peers and professionals, we aim to normalize seeking help and foster understanding and empathy.
                    </div>
                </div>
            </div>

            <div class="card" style="background-color:transparent;margin-top:1.4em">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Question 3: How can users access licensed psychologists through the app?
                        </button>
                    </h5>
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        Users can access licensed psychologists through our app by browsing a directory of professionals, viewing their profiles, and scheduling appointments. The app also offers real-time communication with psychologists via secure chat and video calls.
                    </div>
                </div>
            </div>

            <div class="card" style="background-color:transparent;margin-top:1.4em">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Question 4: Is this app a substitute for professional therapy?
                        </button>
                    </h5>
                </div>

                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        No, our app is not a substitute for professional therapy. It serves as a valuable complement to traditional therapy. While it provides peer support, resources, and communication with licensed professionals, it's not a replacement for individualized professional mental health treatment.
                    </div>
                </div>
            </div>

            <div class="card" style="background-color:transparent;margin-top:1.4em">
                <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Question 5: How do you ensure user privacy and data security on the app?
                        </button>
                    </h5>
                </div>

                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        We prioritize user privacy and data security. Our app employs robust encryption and follows industry best practices to safeguard user data. We are committed to creating a secure and confidential environment for all users.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<section id="contact" class="py-5" style="background: url(images/dot_effect.png),linear-gradient(#f7f0e6,#c2d5e8);">
    <h2 style="text-align:center; margin-bottom:1em;color:grey;font-weight:700;">Contact</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="contact.php"  method="post" >
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/scripting.js"></script>



</body>

</html>