<?php
session_start();
$_SESSION['page']='home';
	include "./includes/header.php";
?>
<div class="container">
<div class="row body outer">
<?php
if (count($_GET)>0) {
if (isset($_GET['action'])) {
	if ($_GET['action']==='addEmployee') {
		include "./includes/forms/addEmployee.php";
	}
	
	elseif ($_GET['action']==='viewEmployees') {
		include "./includes/employees.php";
	}

	elseif ($_GET['action']==='settings') {
		include "./includes/settings.php";
	}
	elseif ($_GET['action']==='penalities') {
		include "./includes/penalities.php";
	}
	elseif ($_GET['action']==='contact') {
		include "./includes/contact.php";
	}
	elseif ($_GET['action']==='changePassword') {
		include "./includes/changePassword.php";
	}
	elseif ($_GET['action']==='about') {
		include "./includes/about.php";
	}
	else{
		include "./includes/error.php";
	}
}
else{
		include "./includes/error.php";
	}
}
elseif (count($_GET)==0) {
			include "./includes/home.php";
		}		
else {
	include "./includes/error.php";
}
?>
</div>
<?php
include "./includes/footer.php";
?>

