<?php
require("core/init.php");
try{
	$user = new User();
	$task = new Task(new Database());
	if($user->isLoggedIn()){
		$template = new Template("templates/dashboard.php");
		$users = $user->getUsers();
		$tasks = $task-> getTasks();
		$template->numberOfUsers =  sizeof($users);
		$template->userTypes = $user->getUserTypes();
		$template->numberOfTasks = sizeof($tasks);
		$template->tasks = $tasks;
		#
		echo $template;
	}
	else{
		redirect("index.php", "You must login before","error");
	}
}catch(PDOException $e){
	echo "<strong>Error: </strong>". $e->getMessage();
}