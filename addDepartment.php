<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['addDepartment'])){
      $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
      $isRequired = array("name");
      if(isRequired($isRequired)){
            if($user->addDepartment($name)){
              redirect("dashboard.php","Department successfully added","success");
          }else{
            redirect("dashboard.php", "Failed to add department","error");
          }
          }else{
            redirect("dashboard.php", "Form must be completed","error");
          }
      }
    } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}
