
<?php
class User {
  private $db ;
  private const SUBMITTED_BY_RECEPTIONIST = 0;

  private function setUserData($row){
    $_SESSION['loggedIn'] = true;
    $_SESSION['id']= $row->userID;
    $_SESSION['name']= $row->name;
    $_SESSION['department'] = $row->department;
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
    unset($_SESSION['department']);
    unset($_SESSION['userType']);
    return true;
  }

  public function isLoggedIn(){
    return (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']));
  }

  public function addUser($data){
    $this->db-> query("INSERT INTO users(name, email, password, department, userType) VALUES(:name, :email, :password, :department, :userType)");
    $this->db->bind(":name", $data['name']);  
    $this->db->bind(":email", $data['email']);  
    $this->db->bind(":password", $data['password']); 
    $this->db->bind(":department", $data['department']); 
    $this->db->bind(":userType", $data['userType']); 
    return ($this->db->execute());
  }

  public function getUsers(){
    $this->db->query("SELECT * FROM users");
    return $this->db->resultSet();
  }

  public function addDepartment($name){
    $this->db-> query("INSERT INTO department(name) VALUES(:name)");
    $this->db->bind(":name", $name); 
    return $this->db->execute();
  }

  public function getDepartments(){
    $this->db->query("SELECT * FROM department");
    return $this->db->resultSet();
  }

  public function addTask($data){
    $this->db->query("INSERT INTO tasks(owner, copies, worked_on_by,description, files, status, assignTo, task_identifier) VALUES(:owner, :copies, :worked_on_by, :description, :files, :status, :assignTo, :task_identifier)");
    $this->db->bind(":owner", $data['owner']);   
    $this->db->bind(":copies", $data['copies']); 
    $this->db->bind(":worked_on_by", $data['worked_on_by']); 
    $this->db->bind(":description", $data['description']); 
    $this->db->bind(":files", $data['files']);
    $this->db->bind(":status", User::SUBMITTED_BY_RECEPTIONIST);
    $this->db->bind(":assignTo", $data['assignTo']);
    $this->db->bind(":task_identifier", $data['task_identifier']);
    return $this->db->execute();
  }

  public function getTasks(){
    $this->db->query("SELECT * FROM tasks");
    return $this->db->resultSet();
  }

  public function getUser($id){
    try{
      $this->db->query('SELECT * FROM users WHERE id = :id');
      $this->db->bind(':id', $id);
      return  $this->db->single();
    }catch(Throwable $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }

  public function updateTask($data)
  {
    $this->db-> query("UPDATE tasks SET 
        owner=:owner, 
        copies =:copies,
        worked_on_by =:worked_on_by, 
        description=:description, 
        files = :files,
        status = :status,
        assignTo = :assignTo,
        task_identifier= :task_identifier
       WHERE id = :id");
    $this->db->bind(":owner", $data['owner']);   
    $this->db->bind(":copies", $data['copies']); 
    $this->db->bind(":worked_on_by", $data['worked_on_by']); 
    $this->db->bind(":description", $data['description']); 
    $this->db->bind(":files", $data['files']);
    $this->db->bind(":status", User::SUBMITTED_BY_RECEPTIONIST);
    $this->db->bind(":assignTo", $data['assignTo']);
    $this->db->bind(":task_identifier", $data['task_identifier']);
    $this->db->bind(":id",$data['id']);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  public function deleteTask($id){
    $this->db->query("DELETE FROM tasks WHERE id=:id");
    $this->db->bind(":id",$id);
    return $this->db->execute();
  }

}