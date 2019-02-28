<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_GET['status'])){
      if($user->updateStatus($_GET["status"])){
        redirect("dashboard.php","Task Status updated","success");
      }else{
          redirect("dashboard.php", "Failed to update status, try again","error");
      }
    }else{
        redirect("dashboard.php");
    }
  }else{
    echo "User Must Log IN";
  } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}


