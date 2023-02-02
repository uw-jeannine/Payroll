<?php
session_start();
$_SESSION['page']='employees';
	include "includes/header.php";
?>
<div class="container">
<div class="row body outer">
<?php
if (count($_GET)>0) {
	if (isset($_GET['action'])) {
		if ($_GET['action']==='addEmployee') {
			include "./includes/forms/addEmployee.php";
		}
		
		elseif ($_GET['action']==='penalties') {
			include "./includes/penalties.php";
		}
		
		else{
				return error();
		}
	}
	elseif (isset($_GET['view'])) {
			include "./includes/view.php";	
	}	
	elseif (isset($_GET['del'])) {
			include "./includes/delete.php";	
	}
	else{
		return error();
	}
}	
else {
	include "./includes/employees.php";
}
?>
</div>
<?php
include "./includes/footer.php";
?>