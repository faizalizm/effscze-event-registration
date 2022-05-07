<?php
  session_start();
  
  $connect = mysqli_connect("localhost", "root", "", "abstrakt")
            or die("Couldn't  connect to server");
    
  $register = 0; // default : must login first

  if(isset($_SESSION["admin"])){
    $adminSession = true;
    $register = 1; // must logout and login as user
  }
  else{
    $adminSession = false;
  }

  if(isset($_SESSION["user"])){
    $userSession = true;
    $register = 2; // can straight away register
  }
  else{
    $userSession = false;
  }

  if(isset($_GET["category_id"])){
    $userid = $_SESSION["userid"];
    $categoryid = $_GET["category_id"];

    // Command to check if user already registered
    $checkRegistered = "
      SELECT * FROM webparticipant
      WHERE userid = '$userid'
      ORDER BY categoryid";
    $checkExecute = mysqli_query($connect, $checkRegistered);

    // Command to check if slots are filled
    $checkSlotCommand = 
      "SELECT webparticipant.categoryid,
        COUNT(webparticipant.categoryid) AS participantCount,
        webcategory.categorylimit,
        webcategory.categorylimit-(COUNT(webparticipant.categoryid)) AS availableslot
      FROM webparticipant
      INNER JOIN webcategory
      ON webparticipant.categoryid = webcategory.categoryid
      WHERE webparticipant.categoryid = '$categoryid'
      GROUP BY categoryid";

    $checkSlotExecute = mysqli_query($connect, $checkSlotCommand);
    $slot = mysqli_fetch_array($checkSlotExecute, MYSQLI_BOTH);
    
    if($slot["availableslot"] >= 0){    
      $findIfRegistered = false;

      if(mysqli_num_rows($checkExecute) > 0){
        while($eventRegistered = mysqli_fetch_array($checkExecute, MYSQLI_BOTH)){
          if($categoryid == $eventRegistered["categoryid"])
            $findIfRegistered = true;

        }
      }

      if(!$findIfRegistered){
        $addCategoryCommand = "INSERT INTO webparticipant (userid, categoryid) VALUES ('$userid', '$categoryid')";
        $addExecute = mysqli_query($connect, $addCategoryCommand);
        echo "
          <script>
            alert('You have sucessfully registered');
            window.location.href='events.php';
          </script>";
      }
      else{
        echo "
          <script>
            alert('REGISTRATION FAILED, you are already registered to this category');
            window.location.href='events.php';
          </script>";
      }
    }
    else{
      echo "<script>alert('REGISTRATION FAILED, all slots have been filled');</script>";

    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styling/styleSetup.css" />
    <link rel="stylesheet" href="styling/indexStyle.css" />
    <link rel="stylesheet" href="styling/eventStyle.css">
    <script>
      function regUser(categoryid)
      {
        if(confirm('Are you sure to register in this category ?'))
        {
           window.location.href='events.php?category_id='+ encodeURIComponent(categoryid);
        }
      }

      function notif(check)
      {
        if(check == 0)
        {
           if(confirm("You must register as an ABSTRAKT member to register a category")){
              window.location.href='sign.php';
           }
        }
        else if(check == 1){
           alert("You're logged in as an admin. Please login as user to register");
        }
      }
    </script>
    <title>Abstrakt - Home</title>
  </head>
  <body>
    <div class="global-container">

      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
          />
        </a>
        
        <?php
          if($adminSession || $userSession) 
          {
        ?>
        
        <nav class="session-nav">
        <?php }else { ?>
          <nav>
        <?php
          }
        ?>
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
          
          <?php
            if($adminSession){
          ?>
          <a href="admin.php">Management</a>
          <?php } ?>
          <?php
            if($userSession){
          ?>
          <a href="user.php">Profile</a>
          <?php } ?>
        </nav>
        <?php
          if($adminSession || $userSession) 
          {
        ?>
        
        <a href="processPage/logout.php" class="sign">Logout</a>
        <?php
          }
          else {  
        ?>
        <a href="sign.php" class="sign">Login/Register</a>
        <?php
          }
        ?>
      </header>

      <div class="category-banner" id="webdesign">
            <h1>Web Design Competition</h1>
            <span class="underline"></span>
      </div>

      <div class="event-layout">
        <section class="main-event">
          <figure class="main-img-box">
            <img src="images/icon/Web Icon.png" alt="Web Design Icon">
          </figure>
          <h4>Web Design Competition</h4>
          <p>
            Are you the next UI/UX<br>
            designer we're looking for?
          </p>
          <h5>Prize Pool</h5>
          <p>
            Stand a chance to win a total<br>
            RM1600 cash prize!
          </p>
          <p>
            <ul class="prize-pool">
              <li>1st Prize : RM800</li>
              <li>2nd Prize : RM500</li>
              <li>3rd Prize : RM300</li>
            </ul>
          </p>
        </section>

        <section>
          <h3 class="gradient-text">Information.</h3>
          <blockquote class="event-info info-tab">
            <p>Event Details</p>
            <ul>
              <li>Venue : MAEPS Serdang</li>
              <li>Date : Refer to categories of theme</li>
              <li>Time : 07:00 AM to 5:00 PM</li>
              <li>Workshop speaker : Sir Mohd Hazli Bin Mohd Zabil</li>
              <li>Breakfast and lunch will be provided.</li>
            </ul>
          </blockquote>
        </section>

        <section>
          <h3 class="gradient-text">Rules and regulations.</h3>
          <blockquote class="event-info rules-tab">
            <p>Event</p>
            <ul>
              <li>You will be teamed up with a random group of 5 people</li>
              <li>Event consist of ONE day workshop and THREE days competition</li>
              <li>Event tentative will be emailed to all participants within 7 days prior to the workshop.</li>
            </ul>
            <p>At the venue</p>
            <ul>
              <li>All participants are advised to be at the venue stated preferebly 30 minutes early</li>
              <li>Please ensure all COVID-19 standards operating procedure are followed.</li>
            </ul>
            <p>FAQs</p>
            <ul>
              <li>You are allowed to register for multiple categories.</li>
              <li>You may defer from any category, however, it is advisable to do so less at least in
              less than 3 days before the event</li>
            </ul>
          </blockquote>
        </section>

        <section>
          <h3 class="gradient-text">Choose your theme category.</h3>
          <?php
            $findCategory = "SELECT * FROM webcategory";
            $findExecute = mysqli_query($connect, $findCategory);

            // Command is used to see number of participants in a category,
            // its available slot, and its category limit 
            $availCommand = 
              "SELECT webcategory.categoryid,
                COUNT(webparticipant.categoryid) AS participantCount,
                webcategory.categorylimit,
                webcategory.categorylimit-(COUNT(webparticipant.categoryid)) AS availableslot
              FROM webcategory
              LEFT JOIN webparticipant
              ON webparticipant.categoryid = webcategory.categoryid
              GROUP BY categoryid";
            $availExecute = mysqli_query($connect, $availCommand);

            if($findExecute){
              while($row = mysqli_fetch_array($findExecute, MYSQLI_BOTH)){
                $convertStartDate = strtotime($row["categorystart"]);
                $formatStartDate = date('d.m.Y', $convertStartDate);

                $convertEndDate = strtotime($row["categoryend"]);
                $formatEndDate = date('d.m.Y', $convertEndDate);
                echo "
                  <blockquote class='event-info category-tab'>
                  <div class='category-details'>
                  <p>" . $row["categoryname"] . "</p>
                    <ul>
                    <li class='category-details'>". $row["categorydetails"] ."</li>
                    </ul>
                    <h5>DATE : " . $formatStartDate . " - " . $formatEndDate . "</h5>
                  </div>
                  ";
                switch($register){
                  case 0:
                  case 1:
                    echo "
                      <a
                      href='javascript:notif($register)'
                      class='reg-event'>
                        <h5>Register Now</h5>
                      </a>
                    ";
                    break;
                  case 2:
                    echo "
                      <a
                      href='javascript:regUser($row[categoryid])'
                      class='reg-event'>
                        <h5>Register Now</h5>
                      </a>
                    ";
                    break;
                }
                
                if($rowAvail = mysqli_fetch_array($availExecute, MYSQLI_BOTH)){
                  if($rowAvail["participantCount"] > $rowAvail["categorylimit"]*2/3){
                    echo "
                    <h5 class='slot-red'>". $rowAvail["participantCount"] 
                    . "/"
                    . $rowAvail["categorylimit"]
                    . " Slots Filled</h5>
                    ";
                  }
                  else if($rowAvail["participantCount"] > $rowAvail["categorylimit"]/3){
                    echo "
                    <h5 class='slot-yellow'>". $rowAvail["participantCount"] 
                    . "/"
                    . $rowAvail["categorylimit"]
                    . " Slots Filled</h5>
                    ";
                  }
                  else{
                    echo "
                    <h5 class='slot-green'>". $rowAvail["participantCount"] 
                    . "/"
                    . $rowAvail["categorylimit"]
                    . " Slots Filled</h5>
                    ";
                  }
                }
                echo "
                </blockquote>";
              
              }
            }
            echo "</div>";
          ?>
        </section>

        <hr class="banner-divider">
        <div class="coming-soon-banner" id="videoediting">
          <h1>Video Editing Competition</h1>
          <h5>Available on June 2022</h5>
          <span class="underline"></span>
        </div>
        <div class="coming-soon-banner" id="skindesign">
          <h1>Skin Design Competition</h1>
          <h5>Available on July 2022</h5>
          <span class="underline"></span>
        </div>
      </div>  

      <footer>
        <div>
          <marquee direction="left" scrollamount="30">
            <span class="gradient-text">
              Join Us Now. Join Us Now. Join Us Now. Join Us Now. Join Us Now.
              Join Us Now. Join Us Now. Join Us Now.
            </span>
          </marquee>
        </div>

      <div class="footer-box">
        <section>
          <a href="index.php">
            <img
            src="images/logo/AbstraktTagLine.png"
            alt="Abstrakt Logo"
            width="300px"
            />
          </a>
        </section>
        <section class="divider"></section>
        <section class="quick-links">
          <h4>Quick Links</h4>
          <div>
            <nav class="footer-nav">
              <a href="index.php">Home</a>
              <a href="events.php">Events</a>
            </nav>
          </div>
        </section>
        <section class="divider"></section>
        <section>
          <h4>Not a member yet?</h4>
          <a href="sign.php" class="challenge-button register-size"
            >Be a part of ABSTRAKT!</a
          >
        </section>
      </div>
    </footer>
    
  </body>
</html>
