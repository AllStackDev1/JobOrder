<?php
if (!defined('PDO::ATTR_DRIVER_NAME')){
    echo 'PDO driver unavailable';
  }
class Database{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct(){
        try{
          $this->dbh = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user, $this->pass);
        } catch(PDOException $e){
          echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
      }
  
    public function query($query){
        try{
          $this->stmt = $this->dbh->prepare($query);
        } catch(Throwable $e){
          echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
    }
  
      public function bind($param, $value, $type = null){
          try {
              if(is_null($type)){
                switch(true){
                  case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                  case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                  case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                  default:
                    $type = PDO::PARAM_STR;
                }
              }
              $this->stmt->bindValue($param, $value, $type);
          } catch (Throwable $e) {
              echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
          }
      }
  
      public function execute(){
        try{
          return $this->stmt->execute();
        }catch(Throwable $e){
          echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
      }
  
      public function resultSet():array{
        try{
          $this->execute();
          return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Throwable $e){
          echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
      }
  
      public function lastInsertId(){
        return $this->dbh->lastInsertId();
      }
  
      public function single(){
        try{
          $this->execute();
          return $this->stmt->fetch(PDO::FETCH_OBJ);
        } catch(Throwable $e){
          echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
      }
      public function rowCount(){
        return $this->stmt->rowCount();
    }
}
