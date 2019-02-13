
<?php
class User {
  private $db ;

  private function setUserData($row){
    $_SESSION['loggedIn'] = true;
    $_SESSION['id']= $row->userID;
    $_SESSION['name']= $row->name;
    $_SESSION['userType'] = $row->userType;
  }
  public function __construct(){
    $this->db = new Database();
  }


  public function login($email, $password){
    $this->db->query("SELECT * FROM  users  WHERE email = :email");
    $this->db->bind(":email", $email);
    $row = $this->db->single();
    if (password_verify($password, $row->password) && $this->db->rowCount() > 0 ) {
      $this->setUserData($row);
      return true;
    }else{
      return false;
    }
  }

 public function logout(){
    unset($_SESSION['loggedIn']);
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['userType']);
    return true;
  }

  public function isLoggedIn(){
    return (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']));
  }

  public function addUser($data){
    $this->db-> query("INSERT INTO users(name, email, password, userType) VALUES(:name, :email, :password, :userType)");
    $this->db->bind(":name", $data['name']);  
    $this->db->bind(":email", $data['email']);  
    $this->db->bind(":password", $data['password']); 
    $this->db->bind(":userType", $data['userType']); 
    return ($this->db->execute());
  }

  public function getUsers(){
    $this->db->query("SELECT * FROM users");
    return $this->db->resultSet();
  }

  public function addUserType($data){
    $this->db-> query("INSERT INTO userType(name) VALUES(:userType)");
    $this->db->bind(":userType", $data['userType']); 
    return ($this->db->execute());
  }

  public function getUserTypes(){
    $this->db->query("SELECT * FROM userType");
    return $this->db->resultSet();
  }
}