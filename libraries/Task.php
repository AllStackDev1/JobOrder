
<?php
class Task {
  private $db ;

  public function __construct(Database $db){
    $this->db = $db;
  }

  public function addTask($data){
    $this->db-> query("INSERT INTO tasks(owner, copies, worked_on_by,description) VALUES(:owner, :copies, :worked_on_by, :description)");
    $this->db->bind(":owner", $data['owner']);   
    $this->db->bind(":worked_on_by", $data['worked_on_by']); 
    $this->db->bind(":copies", $data['copies']); 
    $this->db->bind(":description", $data['description']); 
    return ($this->db->execute());
  }

  public function getTasks(){
    $this->db->query("SELECT * FROM tasks");
    return $this->db->resultSet();
  }
}