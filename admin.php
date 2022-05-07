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
    <title>Admin Management System</title>
    <script>
      function delete_id(id)
      {
        if(confirm('Are you sure to remove participant with ID : ' + id + ' ?'))
        {
           window.location.href='processPage/delete.php?delete_id='+ encodeURIComponent(id);
        }
      }

      function edit_this(id)
      {
        window.location.href='userEdit.php?edit_id=' + encodeURIComponent(id) +'#scroll';
      }
      
      function viewCategory(categoryid)
      {
        if(confirm('Are you sure to register in this category ?'))
        {
           window.location.href='adminViewCategory.php?category_id='+ encodeURIComponent(categoryid);
        }
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
        
        $countUserCommand = "SELECT COUNT(user.userid) AS totalled FROM user";
        $executeUserCount = mysqli_query($connect, $countUserCommand);
        
        $countAdminCommand = "SELECT COUNT(administrator.admin_id) AS totalled FROM administrator";
        $executeAdminCount = mysqli_query($connect, $countAdminCommand);

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
        <nav class="session-nav">
          <a href="index.php">Home</a>
          <a href="events.php">Events</a>
          <a href="admin.php">Management</a>
        </nav>
        <a href="processPage/logout.php" class="sign">Logout</a>
      </header>
      
      <div class="div1" id="scroll">
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

        <div class="tab-link" id="scroll-to-view">
          <div class="tab">
            <h4>
              Admin Task - <span class="highlight-text">Privilege Level <?php echo $adminpriv; ?></span>
            </h4>
          </div>
        </div> 


        <div class="task">

          <div class="left-grid">
            
          <?php
            if($adminpriv == 1){
          ?>

          <a href="adminViewAdmin.php#scroll-to-view" class="view-admin">
          <div class="member">
              <figure>
                <img src="images/icon/Admin.png"
                  alt="User Icon"
                  width="120px"
                />
              </figure>
            <?php
              if($totalAdmin = mysqli_fetch_array($executeAdminCount, MYSQLI_BOTH)){
                echo "<p class='support-text'>". $totalAdmin["totalled"] . " Registered Admin</p>";
            }
            ?>
            <div class="view-more">
              <p>View ABSTRAKT Admin</p>
              <img src="images/icon/Right Arrow.png" width="16px" >
            </div>
          </div>
          </a>

          <?php
            }
          ?>
          
          <a href="adminViewUser.php#scroll-to-view" class="view-user">
          <div class="member">
              <figure>
                <img src="images/icon/User.png"
                  alt="User Icon"
                  width="160px"
                />
              </figure>
            <?php
              if($totalUser = mysqli_fetch_array($executeUserCount, MYSQLI_BOTH)){
                echo "<p class='support-text'>". $totalUser["totalled"] . " Registered User</p>";
              }
            ?>
            <div class="view-more">
              <p>View ABSTRAKT Member</p>
              <img src="images/icon/Right Arrow.png" width="16px" >
            </div>
          </div>
          </a>

          </div>

        <h6 class="event-heading gradient-text">Event : Web Design</h6>

        <?php

          $listCategory = "SELECT * FROM webcategory";
          $listExecute = mysqli_query($connect, $listCategory);

          while($categoryRow = mysqli_fetch_array($listExecute, MYSQLI_BOTH))
          {
            $startDate = strtotime($categoryRow["categorystart"]);
            $todayDate = strtotime(date('d.m.Y'));
            
            $dayLeft = abs( ($startDate - $todayDate ) / (60 * 60 * 24));

            echo "
              <a href='adminViewCategory.php?category_id=" . $categoryRow["categoryid"] . "#scroll-to-view' class='category-box'>
              <div>
                <blockquote class='category'>
                  <figure>
                    <img src='images/icon/Web Icon.png'
                      alt='Web Design Icon'
                      width='48px'
                    />
                  </figure>
                  <div>
                    <div class='category-text'>
                      <p>" . $categoryRow["categoryname"] . "</p>
                      <p>" . $dayLeft . " Days Left</p>
                    </div>
                    <div class='view-more'>
                      <p>View Registered Member</p>
                      <img src='images/icon/Right Arrow.png' width='16px' >
                    </div>
                  </div>

                </blockquote>
              </div>
              </a>
            ";
          }
        ?>

        <a href="adminAddCategory.php">
         <div>
           <blockquote class="add-category">
             <img src="images/icon/Add.png" alt="Add Icon" width="40px"/>
             <p>Add More Category</p>
           </blockquote>
         </div>
        </a>

      </div>

      <div class="border-task"></div>

      <script>
        function toggleSearch() {
          var x = document.getElementById("web");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
      </script>

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
        /></a>
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
