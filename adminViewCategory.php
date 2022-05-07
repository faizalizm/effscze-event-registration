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
    <title>View Registered User</title>
    <script>
      // function delete_id(id)
      // {
      //   if(confirm('Are you sure to remove participant with ID : ' + id + ' ?'))
      //   {
      //      window.location.href='processPage/delete.php?delete_id='+ encodeURIComponent(id);
      //   }
      // }

      function delete_event(webid, userid)
      {
        if(confirm('Are you sure to remove participant from the category ?'))
        {
           window.location.href='processPage/deleteEvent.php?delete_id='+ encodeURIComponent(webid) + '&userid=' + encodeURIComponent(userid);
        }
      }

      function edit_this(id)
      {
        window.location.href='userEdit.php?edit_id=' + encodeURIComponent(id) +'#scroll';
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

      if(isset($_GET["category_id"])){

        $categoryid = $_GET["category_id"];
        $findCategory = 
          "SELECT webparticipant.webparticipantid, user.userid, user.username, user.email, user.phone, user.age
            FROM webparticipant
            INNER JOIN user
            ON webparticipant.userid = user.userid
            INNER JOIN webcategory
            ON webparticipant.categoryid = webcategory.categoryid
            WHERE webparticipant.categoryid = '$categoryid'
          ";
        $categoryExecute = mysqli_query($connect, $findCategory);
        
        $findName = "SELECT * FROM webcategory WHERE categoryid = '$categoryid'";
        $executeName = mysqli_query($connect, $findName);

        $categoryname = mysqli_fetch_array($executeName, MYSQLI_BOTH);
      }

      if(isset($_POST["keyword"])){

        $key = $_POST["keyword"];
        $filterBy = $_POST["filterBy"];
        
        $findCommand = 
          "SELECT webparticipant.webparticipantid, user.userid, user.username, user.email, user.phone, user.age
          FROM webparticipant
          INNER JOIN user
          ON webparticipant.userid = user.userid
          INNER JOIN webcategory
          ON webparticipant.categoryid = webcategory.categoryid
          WHERE webparticipant.categoryid = '$categoryid'
          AND $filterBy LIKE '%$key%'";
        $findExecute = mysqli_query($connect, $findCommand) or die("Couldn't connect to database");
        
      }

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
        <div class="tab-link" id="scroll-to-view">
          <div class="tab">
            <h4>
              Showing Web Design Participant - <span class="highlight-text">Category <?php echo $categoryname["categoryname"]; ?></span>
            </h4>
          </div>
        </div> 
        <div class="table" >
          <form action="adminViewCategory.php?category_id=<?php echo $categoryid; ?>#scroll-to-view" class="table-search" method="POST">
            <input type="image" src="images/icon/Search.png" alt="Search Icon" width="50px" height="50px">
            <select name="filterBy" title="Choose from some options to filter" >
              <option value="user.userid">Filter by ID</option>
              <option value="username" selected>Filter by Name</option>
              <option value="email">Filter by Email</option>
              <option value="phone">Filter by Phone</option>
            </select>
            <input type="text" name="keyword" placeholder="Enter Keyword" class="find-field"/>
            <input type="submit" class="del-btn tab-link search-btn" value="Run Search"/>
          </form>
          <?php
            if(isset($key)){
              echo "
                <div id='search-result' style='display: block;'>
                <hr class='hr-margin'>
                <h6 class='search-result event-heading'>Search Results</h6>
                <table border='0'>
                  <tr>
                    <th class='id-col'>Participant ID</th>
                    <th class='user-col'>Username</th>
                    <th class='email-col'>Email</th>
                    <th class='phone-col'>Phone</th>
                    <th class='edit-col'>Edit</th>
                    <th class='del-col'>Delete</th>
                  </tr>
              ";
              $counter = 0;
              while($searched = $findExecute->fetch_assoc()) {
                if($counter % 2 == 0){
                  echo "
                    <tr class='light'>
                      <td class='id-col'>" . $searched["userid"] . "</td>
                      <td>" . $searched["username"] .  "</td>
                      <td>" . $searched["email"] . "</td>
                      <td>" . $searched["phone"] . "</td>
                      <td class='del-box'>
                        <a class='del-btn tab-link' href='javascript:edit_this($searched[userid])'>Edit</a>
                      </td>
                      <td class='del-box'>
                        <a class='del-btn tab-link' href='javascript:delete_event($searched[webparticipantid], $searched[userid])'>Delete</a>
                      </td>
                    </tr>
                  ";
                }
                else{
                  echo "
                    <tr class='dark'>
                      <td class='id-col'>" . $searched["userid"] . "</td>
                      <td>" . $searched["username"] .  "</td>
                      <td>" . $searched["email"] . "</td>
                      <td>" . $searched["phone"] . "</td>
                      <td class='del-box'>
                        <a class='del-btn tab-link' href='javascript:edit_this($searched[userid])'>Edit</a>
                      </td>
                      <td class='del-box'>
                        <a class='del-btn tab-link' href='javascript:delete_event($searched[webparticipantid], $searched[userid])'>Delete</a>
                      </td>
                    </tr>";
                  }
                  $counter++;
              }
              echo "
                  <tr>
                    <td colspan='6' class='total-row'>Showing <span class='gradient-text'>
                  ". $counter .
                  " Participants</span>";
                    if($counter == 0)
                      echo " - No results found based on keyword";
                    echo "
                    </td>
                  </tr>
                </table>
              ";
            }
            ?>

        
        <hr class="hr-margin">
        <h6 class='event-heading search-result search-margin'>List of Registered User</h6>
        <table border="0">
          <tr>
            <th class="id-col">Participant ID</th>
            <th class="user-col">Username</th>
            <th class="email-col">Email</th>
            <th class="phone-col">Phone</th>
            <th class="edit-col">Edit</th>
            <th class="del-col">Delete</th>
          </tr>
          
          <?php
            $counter = 0;
            while($row = $categoryExecute->fetch_assoc()) {
              if($counter % 2 == 0){
                echo "
                  <tr class='light'>
                    <td class='id-col'>" . $row["userid"] . "</td>
                    <td>" . $row["username"] .  "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td>
                    <td class='del-box'>
                      <a class='del-btn tab-link' href='javascript:edit_this($row[userid])'>Edit</a>
                    </td>
                    <td class='del-box'>
                        <a class='del-btn tab-link' href='javascript:delete_event($row[webparticipantid], $row[userid])'>Delete</a>
                    </td>
                  </tr>
                ";
                }
              else{
                echo "
                  <tr class='dark'>
                    <td class='id-col'>" . $row["userid"] . "</td>
                    <td>" . $row["username"] .  "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td>
                    <td class='del-box'>
                      <a class='del-btn tab-link' href='javascript:edit_this($row[userid])'>Edit</a>
                    </td>
                    <td class='del-box'>
                      <a class='del-btn tab-link' href='javascript:delete_event($row[webparticipantid], $row[userid])'>Delete</a>
                    </td>
                  </tr>
                ";
              }
              $counter++;
            }
          ?>
          <tr>
            <td colspan="6" class="total-row">Showing <span class="gradient-text"><?php echo $counter ?> Participants</span>
            <?php
              if($counter == 0){
                echo " - No registered participants yet";
              }
            ?>
            </td>
          </tr>
        </table>
      </div>

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
