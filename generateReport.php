<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['generateReport'])){
      echo "About working on it";
    }
}
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}
