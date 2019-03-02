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
    $data['owner'] = filter_input(INPUT_POST,"owner",FILTER_SANITIZE_STRING);
    $data['id'] = $_POST['id'];
    $data['worked_on_by'] = $_SESSION['name'];
    $data['description'] = filter_input(INPUT_POST,"description",FILTER_SANITIZE_STRING); 
    $data['copies'] = filter_input(INPUT_POST,"copies",FILTER_SANITIZE_STRING);
    $data["files"]  =  implode(SEPARATOR,$files);
    $data["assignTo"]  = filter_input(INPUT_POST,"department",FILTER_SANITIZE_STRING);
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


