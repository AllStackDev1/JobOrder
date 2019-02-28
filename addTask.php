<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['addTask'])){
      $data = array();if(isset($_FILES['file_array'])){
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
    $data['worked_on_by'] = $_SESSION['name'] || "DADSF";
    $data['description'] = $_POST['description']; 
    $data['copies'] = $_POST['copies'];
    $data["files"]  =  implode(SEPARATOR,$files);
    $data["assignTo"]  =  $_POST['department'];
    $data['task_identifier'] = time();
    $isRequired = array("description","copies","owner");
    if(isRequired($isRequired)){
      if($user->addTask($data)){
        redirect("dashboard.php","Documents submitted successfully","success");
      }else{
          redirect("dashboard.php", "Failed to Submit document, try again","error");
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


