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
    <script>
      function confirmation()
      {  
        if(confirm('Please confirm all the details.'))
            return true;
          else
            return false;
      }
    </script>
    <title>Edit Details</title>
  </head>
  <body>
    <div class="global-container">
      <?php
      if(isset ($_SESSION["admin"])) 
      {
        $admin = $_SESSION["admin"];
        $adminid = $_SESSION["adminid"];

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
              Adding Theme Category - <span class="highlight-text">Web Design</span>
            </h4>
          </div>
        </div>
        
        <form action="processPage/addCategory.php" method="POST">
        <div class="edit-table">
            <h6 class="event-main-text gradient-text">Category Information</h6>
            <h6>Category Name</h6>
            <h6>:</h6>
            <input type="text" class="no-gray-out" name="categoryname" placeholder="Enter theme category" required/>
            <hr>
            <h6>Category Limit</h6>
            <h6>:</h6>
            <input type="number" name="categorylimit" placeholder="Enter Limit" maxlength="3" pattern="[0-9]*" required/>
            <hr>
            <h6>Category Details</h6>
            <h6>:</h6>
            <textarea name="categorydetails"cols="10" rows="7" placeholder="Give a ~70 chars detail" required></textarea>
            <hr>
            <h6>Event Start Date</h6>
            <h6>:</h6>
            <input type="date" name="categorystart" required />
            <hr>
            <h6>Event End Date</h6>
            <h6>:</h6>
            <input type="date" name="categoryend" required />
            <hr>
            <input type="submit" value="Add Category" onclick='return confirmation()'>
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
