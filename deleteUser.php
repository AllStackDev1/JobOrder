<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['deleteUser'])){
      $id = $_POST['id'];
      if($user->deleteUser($id)){
            redirect("users.php","User deleted successfully ","success");
      }else{
            redirect("users.php", "Failed to delete user","error");
          }
      }
    } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}
