<?php
require("core/init.php");
try{
	$user = new User();
	if($user->isLoggedIn()){
        $template = new Template("templates/users.php");
        $template->isLoggedIn = $user->isLoggedIn();
        $template->users =  $user->getUsers();
        $template->departments = $user->getDepartments();
		echo $template;
	}
	else{
		redirect("index.php", "You must login before","error");
	}
}catch(PDOException $e){
	echo "<strong>Error: </strong>". $e->getMessage();
}