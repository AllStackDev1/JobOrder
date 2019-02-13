<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['addUserType'])){
      $data = array();
      $data['userType'] = $_POST['userType'];
      $isRequired = array("userType");
      if(isRequired($isRequired)){
            if($user->addUserType($data)){
              redirect("dashboard.php","UserType successfully added","success");
          }else{
            redirect("dashboard.php", "Failed to add UserType","error");
          }
          }else{
            redirect("dashboard.php", "Form must be completed","error");
          }
      }
    } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}
