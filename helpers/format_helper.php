<?php
function redirect($page=FALSE, $message=NULL, $message_type= NULL){
  //checking for page
  if(is_string($page)){
    $location=$page;
  }else{
    $location = $_SERVER['SCRIPT_NAME'];
  }
  //checking for message_
  if($message !=NULL){
    //set  SESSionmessage
   $_SESSION['message'] = $message;
  }
  //checking for $message_type
  if($message_type !=NULL){
    //set  SESSionmessage
   $_SESSION['message_type'] = $message_type ;
  }
  //redirect
  header('Location:'.$location);
  exit;
}

function displayMessage(){
  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    if(!empty($_SESSION['message_type'])){
      $message_type = $_SESSION['message_type'];
      if($message_type=="error"){
        echo
        "
              <div class='glyphicon glyphicon-remove alert alert-danger' style='background:tomato; color:white'>".$message. "</div>
        ";
      }else{
          echo
          "
                <div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>".$message. "</div>
          ";
      }
    }
    //unset variables
   unset($_SESSION['message']);
   unset($_SESSION['message_type']);
  }else{
    echo 
    "";
  }
}

function dateFormat($date){
  return date("F j, Y g:ia", strtotime($date));
}

//ur encoding
function urlEnCoded($url){
  $str = preg_replace("/\s*/","",$url);
  $str = strtolower($str);
  $str = urlencode($str);
  return $str;
}

function isRequired($array_fields)
  {
    foreach ($array_fields as $field) {
      if($_POST[".$field."]=''){
        return false;
      }
  }
  return true;
  }

 function passwordMatch($p1, $p2)
  {
    if($p1==$p2){
      return true;
    }else{
      return false;
    }
}

function getUserType(){
  return $_SESSION["userType"];
}