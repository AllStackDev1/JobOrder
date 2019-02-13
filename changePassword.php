<?php

require("core/init.php");
$user = new User();
if($user->isLoggedIn()){
	
	if(isset($_POST['do_change'])){
	    if($user->passChangePre($_POST['p0'],$_POST['hidden'])){
	    	if(passwordMatch($_POST['p1'], $_POST['p2'])){
	    		if($user->updatePassword($_POST['p1'], $_SESSION['admin_id'])){
	    			redirect("dashboard.php", "password successfully updated ","success");
	    		}else{
	    			redirect("dashboard.php", "password could not be  updated ","error");
	    		}
	    	}
	    	else{
	    		echo "errors";
	    	}
	    }else{
	    	redirect("dashboard.php", "Old password is wrong ","error");
	    }
	}
}else{
	redirect("login.php", "You must login before","error");
}