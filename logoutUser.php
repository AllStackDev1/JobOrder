<?php include 'core/init.php'; ?>
<?php
  $user = new User;
  if($user->logout()){
    redirect("index.php", "You Successfully logout", "success");
  }else{
  redirect("index.php");
}
