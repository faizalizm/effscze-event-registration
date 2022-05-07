<?php

  session_start();
  $connect = mysqli_connect("localhost", "root", "", "abstrakt") or die("Couldn't  connect to server");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styling/styleSetup.css" />
    <link rel="stylesheet" href="styling/adminStyle.css" />
    <title>Edit Admin Details</title>
    <script>
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
      if(isset ($_SESSION["admin"])) 
      {
        $admin = $_SESSION["admin"];
        $adminid = $_SESSION["adminid"];
        $adminpriv = $_SESSION["adminpriv"];

        if(isset($_GET["edit_id"]))
          $adminid = $_GET["edit_id"];
        
        $findCommand = "SELECT * FROM administrator WHERE admin_id='$adminid'";
        $findExecute = mysqli_query($connect, $findCommand);
        $row = mysqli_fetch_array($findExecute, MYSQLI_BOTH);

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
              Editing Administrator - <span class="highlight-text"><?php echo $row["admin_name"]?></span>
            </h4>
          </div>
        </div>
        
        <form action="processPage/update.php" method="POST">
        <div class="edit-table">
            <h6 class="event-main-text gradient-text">Admin Information</h6>
            <input type="hidden" name="adminid" value="<?php echo $row['admin_id']?>" />
            <h6>Username</h6>
            <h6>:</h6>
            <input type="text" name="adminname" value="<?php echo $row['admin_name']?>" readonly />
            <hr>
            <h6>Email</h6>
            <h6>:</h6>
            <input type="email" name="adminemail" value="<?php echo $row['admin_email']?>" required/>
            <hr>
            <h6>Password</h6>
            <h6>:</h6>
            <input type="password" name="adminpwd" id="pwd1" value="<?php echo $row['admin_pass']?>" required/>
            <hr>

            <?php
              if($adminpriv != 1){
                echo "
                  <h6>Confirm Password</h6>
                  <h6>:</h6>
                  <input type='password' id='pwd2' placeholder='Reconfirm Password' required/>
                  <hr>
                  <input type='submit' value='Update Data' onclick='return update()'>
                ";
              }
              else{
                echo "
                <input type='submit' value='Update Data' onclick='return confirmation()''>";
              }
            ?>

          </div>
        </form>
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
