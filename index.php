<?php

  session_start();
  $connect = mysqli_connect("localhost", "root", "", "abstrakt")
            or die("Couldn't  connect to server");

  //error checking for availability of user or admin session 
  if(isset($_SESSION["admin"])){
    $adminSession = true;
  }
  else{
    $adminSession = false;
  }

  if(isset($_SESSION["user"])){
    $userSession = true;
  }
  else{
    $userSession = false;
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
    <title>Abstrakt - Home</title>
  </head>
  <body>
    <div class="global-container">

      <!--Navigation Bar-->
      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
        /></a>
        
        <!--if user or admin session is available, use class "session-nav" for <nav> tag-->
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
          
          <!-- if admin session available, display management tab, if user session available, display profile tab-->
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

        <!--if user or admin session is available, display logout button, if not, display login/register buttton-->
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
      
      <!-- Block 1-->
      <div class="div1">
        <section class="div1-col1">
          <p class="special-text gradient-text">Broaden your knowledge</p>
          <h1>Multimedia Month Ver 03</h1>
          <p class="captionpara">
            Do you have what it takes ?<br />
            Learn, create, improve with us.
          </p>

          <!--if user click, smooth scroll to Block 2-->
          <a href="#scroll-to-event" class="challenge-button challenge-size"
            >BRING ME THE CHALLENGE!</a
          >
        </section>
        <section class="div1-col2">
          <img
            src="images/icon/ComputerIcon.png"
            alt="Computer Icon"
            width="450px"
            class="disabled-pointer"
          />
        </section>
      </div>

      <!--Block 2-->
      <div id="scroll-to-event" class="div2">
        <h3 class="gradient-text">Upcoming Challenges</h3>
        <h2 class="h2-positioning">Events</h2>
        <div class="div2-wrapper">
          <div class="div2-wrapper1">
            <section class="div2-col1-updated">
              <figure class="div2-figure1-updated">
                <img
                  src="images/icon/Web Icon.png"
                  alt="Web Design Competition Icon"
                  class="disabled-pointer"
                />
              </figure>
              <h4>Web Design</h4>
              <p>
                With the given theme, design engaging website that delivers for your client. With our 10 hours worth of workshop, be a hero<br> from zero and compete with others in a variety category.
              </p>


              <?php
                $availCommand = 
                  "SELECT webparticipant.categoryid,
                  COUNT(webparticipant.categoryid) AS participantCount,
                  webcategory.categorylimit,
                  webcategory.categorylimit-(COUNT(webparticipant.categoryid)) AS availableslot
                  FROM webparticipant
                  INNER JOIN webcategory
                  ON webparticipant.categoryid = webcategory.categoryid
                  GROUP BY categoryid";
                $availExecute = mysqli_query($connect, $availCommand);

                $totalAvail = 0;
                $totalLimit = 0;
                while($row = mysqli_fetch_array($availExecute, MYSQLI_BOTH)){
                  
                  $totalAvail += $row["availableslot"];
                  $totalLimit += $row["categorylimit"];
                }
              ?>

              <div class="details-updated">
                  <div class="inside-details">
                    <img
                    src="images/icon/Location Icon.png"
                    alt="Location Icon"
                    width="11.92px"
                    height="14.9px"
                    style="margin-top: 2px"
                    class="disabled-pointer"
                    />
                    <h5>MAEPS</h5>
                  </div>
                  
                  <div class="inside-details">
                    <img
                    src="images/icon/Calender Icon.png"
                    alt="Calender Icon"
                    width="14.9px"
                    height="14.9px"
                    style="margin-top: 3px"
                    class="disabled-pointer"
                    />
                    <h5>May 2022</h5>
                  </div>
                  
                  <div class="inside-details">
                    <img
                    src="images/icon/People Icon.png"
                    alt="People Icon"
                    width="20.49px"
                    height="8.19px"
                    style="margin-top: 7px"
                    class="disabled-pointer"
                    />
                    <h5><?php echo ($totalLimit-$totalAvail) . " / " . $totalLimit; ?> slots filled</h5>
                  </div>

              </div>
              <section class="view-more-wrap">
                <p class="fee">Registration are FREE of charge</p>
                <a href="events.php#webdesign" class="view-more">
                  <p class="view-more-text">View More</p>
                  <img
                    src="images/icon/Right Arrow.png"
                    alt="Right Arrow Icon"
                    width="16px"
                    height="16px"
                    class="arrow-icon disabled-pointer"
                  />
                </a>
              </section>
            </section>
          </div>

          <div class="div2-wrapper2">
            <section class="div2-col2">
              <figure class="div2-figure2">
                <img
                  src="images/icon/Video Icon.png"
                  alt="Video Competition Icon"
                  class="disabled-pointer"
                />
              </figure>
              <div>
                <h4>Video Editing</h4>
                <p>
                  Educational, tutorials, unboxing video edits<br />and more !
                </p>

                <section>
                  <a href="events.php#videoediting" class="view-more">
                    <p class="view-more-text">Coming Soon</p>
                    <img
                      src="images/icon/Right Arrow.png"
                      alt="Right Arrow Icon"
                      width="16px"
                      height="16px"
                      class="arrow-icon disabled-pointer"
                    />
                  </a>
                </section>
              </div>
            </section>
            <section class="div2-col2">
              <figure class="div2-figure2">
                <img
                  src="images/icon/Skin Icon.png"
                  alt="Skin Design Competition Icon"
                  class="disabled-pointer"
                />
              </figure>
              <div>
                <h4>Skin Design</h4>
                <p>CSGO, PUBG, Mobile Legend skin design<br />and more !</p>
                <section>
                  <a href="events.php#skindesign" class="view-more">
                    <p class="view-more-text">Coming Soon</p>
                    <img
                      src="images/icon/Right Arrow.png"
                      alt="Right Arrow Icon"
                      width="16px"
                      height="16px"
                      class="arrow-icon disabled-pointer"
                    />
                  </a>
                </section>
              </div>
            </section>
            <section class="div2-col2-small"><p>• • •</p></section>
          </div>
        </div>
      </div>

      <!--Block 3-->
      <div class="div3">
        <h3 class="gradient-text">Our Talented People</h3>
        <h2 class="h2-positioning">Teams</h2>
        <div class="div3-wrapper">
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Hazli.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Sir Mohd Hazli Nabil</h4>
              <p>Full Stack Developer</p>
            </section>
            <a href="https://www.linkedin.com/in/mohd-hazli-mohamed-zabil-420861b8/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Daniel.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Mr Daniel Hamdan</h4>
              <p>Human Resource</p>
            </section>
            <a href="https://www.linkedin.com/in/danielhamdan29/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Rajesh.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Sir Rajeshkumar Sugu</h4>
              <p>Graphic Designer</p>
            </section>
            <a href="https://www.linkedin.com/in/ts-rajeshkumar-sugu-791530149/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Zafar.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Mr Zafar Aqif</h4>
              <p>Microsoft Office Expert</p>
            </section>
            <a href="https://www.linkedin.com/in/zafaraqif/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Surizal.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Sir Surizal Nazeri</h4>
              <p>Hackathon Speaker</p>
            </section>
            <a href="https://www.linkedin.com/in/surizal-nazeri-4229a5158/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
          <div class="people">
            <section class="avatar-box">
              <img src="images/avatar/Faizal.png" class="disabled-pointer" />
            </section>
            <section class="change-margin">
              <h4>Mr Faizal Ismail</h4>
              <p>Event Host and Organizer</p>
            </section>
            <a href="https://www.linkedin.com/in/faizalizm/" target="_blank">
              <div class="avatar-follow">
                <img
                  src="images/icon/Follow.png"
                  width="25px"
                  class="disabled-pointer"
                />
                <h5>Follow</h5>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
      <!--Footer-->
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
