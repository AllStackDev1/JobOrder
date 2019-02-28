<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['updateTask'])){
      $filesData = explode(SEPARATOR, $_POST['filesUploadededBefore']);
      foreach($filesData as $filename){
        $path = 'uploads/'.$filename;
          if(unlink($path)){
            echo ("$path Deleted Successfully");
          }else{
            die("$path sorry, could not be deleted. Do it again");
          }
      }
      $data = array();
      if(isset($_FILES['file_array'])){
        $name_array = $_FILES['file_array']['name'];
        $tmp_name_array = $_FILES['file_array']['tmp_name'];
        $type_array = $_FILES['file_array']['type'];
        $size_array = $_FILES['file_array']['size'];
        $error_array = $_FILES['file_array']['error'];
        $files = array();
        for($i = 0; $i < count($tmp_name_array); $i++){
          if(move_uploaded_file($tmp_name_array[$i], "uploads/".$name_array[$i])){
            $files[] = $name_array[$i];
          } else {
            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
            return;
          }
        }
      }
    }
    $data['owner'] = $_POST['owner'];
    $data['id'] = $_POST['id'];
    $data['worked_on_by'] = $_SESSION['name'];
    $data['description'] = $_POST['description']; 
    $data['copies'] = $_POST['copies'];
    $data["files"]  =  implode(SEPARATOR,$files);
    $data["assignTo"]  =  $_POST['department'];
    $data['cost'] = $_POST['cost'];
    $isRequired = array("description","copies","owner");
    if(isRequired($isRequired)){
      if($user->updateTask($data)){
        redirect("dashboard.php","Documents successfully updated","success");
      }else{
          redirect("dashboard.php", "Failed to update document, try again","error");
      }
    }else{
        redirect("dashboard.php", "Form must be completed","error");
    }
  }else{
    echo "User Must Log IN";
  } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}


