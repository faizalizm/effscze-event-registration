<?php

  session_start();
  unset($_SESSION["user"]);
  unset($_SESSION["userid"]);
  unset($_SESSION["admin"]);
  unset($_SESSION["adminid"]);
  unset($_SESSION["adminpriv"]);
  // session_destroy();
  header("Location:../index.php");
  
?>