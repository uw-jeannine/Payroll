<?php
session_start();
$_SESSION['page']='home';
	include "includes/header.php";
?>
<?php
function penaltyMenu(){
?>
<div class="col-md-2">
	<div class="row aside-menu">
		<ul class="nav nav-pills nav-stacked">
			<li <?=(isset($_GET['action']) && $_GET['action']=='punish')?'class="active" data-title="Punish employee"':''; ?>><a href='admin.php?action=punish'><i class="fa fa-legal"></i> Punish employee</a></li>
			<li <?=(isset($_GET['action']) && $_GET['action']=='penalties')?'class="active" data-title="Penalties"':''; ?>><a href='admin.php?action=penalties'><i class="fa fa-balance-scale"></i> Penalities given</a></li>
		</ul>
	</div>
</div>
<?php
}
?>
<div class="container">
<div class="row body outer">
	<link rel="shortcut icon" type="image/png" href="images/a.png">
<?php
if(count($_GET)==0){
	include "./includes/home.php";
}
else{
	if (isset($_GET['action'])) {
		if ($_GET['action']==='addEmployee') {
			include "./includes/forms/addEmployee.php";
		}
		elseif ($_GET['action']==='viewEmployees') {
			include "./includes/employees.php";
		}
		elseif ($_GET['action']==='setup') {
			include "./includes/setup.php";
		}
		
		elseif ($_GET['action']==='contact') {
			include "./includes/contact.php";
		}

		elseif ($_GET['action']==='allPenalities' || $_GET['action']==='punish' || $_GET['action']==='viewPenalty') {
			penaltyMenu();
		include "./includes/penalties.php";
		}
		elseif ($_GET['action']==='penalties') {
			penaltyMenu();
		include "./includes/AllPenalties.php";
		}
						elseif ($_GET['action']==='deactivatedUsers') {
			include "./includes/deactivatedUsers.php";
		}
								elseif ($_GET['action']==='deactivateUsers') {
			include "./includes/deactivateUsers.php";
		}

		elseif ($_GET['action']==='about') {
			include "./includes/about.php";
		}
				elseif ($_GET['action']==='a') {
			include "./includes/a.php";
		}
						elseif ($_GET['action']==='terms') {
			include "./includes/terms.php";
		}

		else{
			return error();
		}
	}
	elseif(isset($_GET['edit'])){
			include "./includes/editUser.php";
	}
	else{
		return error();
	}
}		
?>
</div>
<?php
include "./includes/footer.php";
?>
