<?php
   include('config.php');
   session_start();
   
   $user= $_SESSION['user'];
   
   $sql = mysqli_query($db,"select user from user_auth where user='$user'");
   
   $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
   
   $login_session = $row['user'];
   
   if(!isset($_SESSION['user'])){
      header("location:index.php");
   }
?>