<?php include 'core/init.php'; ?>
<?php
try{
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['updateUser'])){
        $data = array();
      $data['name'] = $_POST['name'];
      $data['email'] = $_POST['email']; 
      $data['worked_on_by'] = $_SESSION['name']; 
      $data['department'] = $_POST['department'];
      $data['userType'] = $_POST['userType'];
      $data['id'] = $_POST['userId'];
      $data ['password']  = password_hash($_POST["password"],PASSWORD_BCRYPT, array('cost'=>12 ));
      if(passwordMatch($_POST['confirm_password'], $_POST["password"])){
        if($user->updateUser($data)){
              redirect("users.php","User successfully added","success");
        }else{
            redirect("users.php", "Failed to add editted User","error");
          }
        }else{
          redirect("users.php", "Password and Confirm Password must be the same","error");
        }
    }
  }else{
    echo "User Must Log IN";
  } 
}catch(PDOException $e){
  echo "<strong>Error: </strong>". $e->getMessage();
}


