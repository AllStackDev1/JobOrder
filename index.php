<?php
require("core/init.php");
$template = new Template("templates/login.php");
$user = new User();
if($user->isLoggedIn()){
  redirect("dashboard.php", "Successfully Logged in", "success");
}
if(isset($_POST['do_login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if($user->login($email, $password))
  {
    redirect("dashboard.php", "Successfully Logged in", "success");
  }
  else{
    redirect("index.php", "Could not logged in? Check your credentials", "error");
  }
}
echo $template;
