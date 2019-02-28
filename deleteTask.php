<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['deleteTask'])){
      $id = $_POST['id'];
      if($user->deleteTask($id)){
            redirect("dashboard.php","Task deleted successfully ","success");
      }else{
            redirect("dashboard.php", "Failed to delete task","error");
          }
      }
    } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}
