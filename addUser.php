<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['addUser'])){
      $data = array();
      $data['name'] = $_POST['name'];
      $data['email'] = $_POST['email']; 
      $data['department'] = $_POST['department'];
      $data['userType'] = $_POST['userType'];
      $data ['password']  = password_hash($_POST["password"],PASSWORD_BCRYPT, array('cost'=>12 ));
      $isRequired = array("fullname", "email", "password", "confirm_password", "department" );
      if(passwordMatch($_POST['confirm_password'], $_POST["password"])){
        if(isRequired($isRequired)){
            if($user->addUser($data)){
              redirect("dashboard.php","User successfully added","success");
          }else{
            redirect("dashboard.php", "Failed to add User","error");
          }
          }else{
            redirect("dashboard.php", "Form must be completed","error");
          }
        }else{
          redirect("dashboard.php", "Password and Confirm Password must be the same","error");
        }
      }
    } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}