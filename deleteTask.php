<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['deleteTask'])){
      $id = $_POST['id'];
      $files = explode(SEPARATOR, $_POST['filesToBeDeleted']);
      foreach($files as $filename){
        $path = 'uploads/'.$filename;
          if(unlink($path)){
            echo ("$path Deleted Successfully");
          }else{
            die("$path sorry, could not be deleted. Do it again");
          }
      }
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
