<?php

  session_start();
  $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't  connect to server");

  if(isset($_GET['edit_id']))
    $editID = $_GET['edit_id'];
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styling/styleSetup.css" />
    <link rel="stylesheet" href="styling/adminStyle.css" />
    <title>Admin Management</title>
    <script>
      function delete_event(webid, userid)
      {
        if(confirm('Are you sure to remove participant from the category ?'))
        {
           window.location.href='processPage/deleteEvent.php?delete_id='+ encodeURIComponent(webid) + '&userid=' + encodeURIComponent(userid);
        }
      }

      function update()
      {
        
        if (
          document.getElementById("pwd1").value !=
          document.getElementById("pwd2").value
        ) {
          alert("Password and Confirmed Password are not the same");
          return false;
        } 
        else{
          if(confirm('Are you sure to update data ?'))
            return true;
          else
            return false;
        }
      }

      function confirmation()
      {  
        if(confirm('Are you sure to update data ?'))
            return true;
          else
            return false;
      }

  </script>
  </head>
  <body>
    <div class="global-container">
      <?php
      if(isset($_SESSION["admin"]))
      {
        $admin = $_SESSION["admin"];

        $findCommand = "SELECT * FROM user WHERE userid='$editID'";
        $findExecute = mysqli_query($connect, $findCommand);
        $row = mysqli_fetch_array($findExecute, MYSQLI_BOTH);

        $findEventCommand = 
          "SELECT `webparticipant`.`webparticipantid`, `user`.`userid`, `webcategory`.`categoryname`
          FROM `webparticipant`
          INNER JOIN `user`
          ON `webparticipant`.`userid` = `user`.`userid`
          INNER JOIN `webcategory`
          ON `webparticipant`.`categoryid` = `webcategory`.`categoryid`
          WHERE `user`.`userid` = '$editID'";
        $findEventExecute = (mysqli_query($connect, $findEventCommand));
        
      ?>

      <header>
        <a href="index.php">
          <img
            src="images/logo/AbstraktLogo.png"
            alt="Abstrakt Logo"
            width="200px"
            class="site-icon disabled-pointer"
            style="z-index: 1"
        /></a>
        <nav class="session-nav">
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
          <a href="admin.php">Management</a>
        </nav>
        <a href="processPage/logout.php" class="sign">Logout</a>
      </header>

      <div class="div1">
        <a href="admin.php#scroll" class="back-btn">
          <img src="images/icon/Back.png" class="back-icon">
        </a>
        <h2 class="abstrakt-marking-fix">ABSTRAKT</h2>
        <div class="people">
          <section class="avatar-box">
            <img src="images/avatar/Hazli.png" class="disabled-pointer" />
          </section>
          <section class="change-margin">
            <h4>Welcome <?php echo $admin; ?></h4>
            <p>Admin Management System</p>
          </section>
          <section>
            <a href="adminEdit.php#scroll" class="edit-box">
              <div class="avatar-follow">
                <img
                src="images/icon/Edit.png"
                width="20px"
                class="disabled-pointer"
                />
                <h5 class="edit-btn">Edit</h5>
              </div>
            </a>
          </section>
        </div>

        <div class="tab-link" id="scroll">
          <div class="tab" onclick="viewWeb()">
            <h4>
              Editing Participant - <span class="highlight-text"><?php echo $row["username"]?></span>
            </h4>
          </div>
        </div> 
        
        <div class="user-edit">

        
        <div class="joined-event">
            <h6 class="event-main-text gradient-text">Joined Events</h6>
            <?php
              if(mysqli_num_rows($findEventExecute) > 0){
                echo "<h6 class='event-category-text'>Web Design Category : </h6><hr>";
                while($eventRow = mysqli_fetch_array($findEventExecute, MYSQLI_BOTH)){
                  echo "
                    <h5 class='event-text'>$eventRow[categoryname]</h5>
                    <div class='vertical-div'></div>
                    <div class='del-box'>
                    <a class='del-btn tab-link' href='javascript:delete_event($eventRow[webparticipantid], $eventRow[userid])'>Remove</a>
                    </div>
                    <hr>
                    ";
                }
              }
              else
                echo "<h5 class='no-event event-text'>No registered events yet.</h5>";
            ?>
          </div>
        <form action="processPage/update.php" method="POST">
        <div class="edit-table">
            <h6 class="event-main-text gradient-text">User Information</h6>
            <input type="hidden" name="userid" value="<?php echo $row['userid']?>" />
            <h6>Username</h6>
            <h6>:</h6>
            <input type="text" name="username" value="<?php echo $row['username']?>" readonly />
            <hr>
            <h6>Email</h6>
            <h6>:</h6>
            <input type="email"
              name="email"
              value="<?php echo $row['email']?>"
              title="Please insert a valid email."
              minlength="3"
              maxlength="320"
              size="320"
              required/>
            <hr>
            <h6>Password</h6>
            <h6>:</h6>
            <input type="password"
              name="pwd"
              id="pwd1"
              value="<?php echo $row['pass']?>"
              title="Password should be between 8 to 30 characters."
              minlength="8"
              maxlength="30"
              size="30"
              required/>
            <hr>
            <?php
              if(!isset($admin)){
                echo"
                  <h6>Confirm Password</h6>
                  <h6>:</h6>
                  <input type='password'
                  id='pwd2'
                  placeholder='Reconfirm Password'
                  title='Confirm your password. Password should be between 8 to 30 characters.'
                  minlength='8'
                  maxlength='30'
                  size='30'
                  required/>
                  <hr>";
              }
            ?>
            <h6>Phone</h6>
            <h6>:</h6>
            <input type="tel"
              name="phone"
              value="<?php echo $row['phone']?>"
              minlength="7"
              maxlength="11"
              size="11"
              pattern="[0-9]*"
              required/>
            <hr>
            <h6>Age</h6>
            <h6>:</h6>
            <select name="age">
              <?php
                echo "
                  <option selected value='" . $row["age"] . "' selected>" . $row["age"] . "</option>
                  <option disabled>----</option>
                ";
              ?>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
            </select>
            <hr>
            
            <?php
              if(!isset($admin)){
                echo "
                  <input type='submit' value='Update Data' onclick='return update()'>
                ";
              }
              else{
                echo "
                  <input type='submit' value='Update Data' onclick='return confirmation()'>
                ";
              }
            ?>
          </div>
        </form>

        </div>
        <div class="border-below"></div>
          
          <?php
      } 
      else{
        ?>

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
        <nav>
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
        </nav>
        <a href="sign.php" class="sign">Login/Register</a>
      </header>
      <div class="no-session">
        <img src="images/icon/Password.png">
        <h6>This area is admin-only. No session exist or session is expired. <a href='sign.php' class="gradient-text">Please log in again</a></h6>
      </div>
          
      <?php
      }
      ?>
    </div>

  </body>
</html>
