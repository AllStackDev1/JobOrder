<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['addTask'])){
      $data = array();
      $data['owner'] = $_POST['owner'];
      $data['worked_on_by'] = $_SESSION['name'];
      $data['description'] = $_POST['description']; 
      $data['copies'] = $_POST['copies'];
      $isRequired = array("description","copies","owner");
      if(isRequired($isRequired)){
          $doc = new Task(new Database());
          if($doc->addTask($data)){
            redirect("dashboard.php","Documents submitted successfully","success");
        }else{
          redirect("dashboard.php", "Failed to Submit document, try again","error");
        }
        }else{
          redirect("dashboard.php", "Form must be completed","error");
        }
      }
  }else{
    echo "User Must Log IN";
  } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}


