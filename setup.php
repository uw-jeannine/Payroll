<?php
session_start();
$_SESSION['page']='setup';
	include "./includes/header.php";
?>
<div class="container">
<div class="row body outer">
<div class="col-md-2">
<div class="row aside-menu">
	<ul class="nav nav-pills nav-stacked">

	<li <?=(isset($_GET['action']) && $_GET['action']=='addDept')?'class="active" data-title="Add new department"':''; ?>><a href='setup.php?action=addDept'><i class="fa fa-plus-square-o"></i>  Add new department</a></li>
	<li <?=(isset($_GET['action']) && $_GET['action']=='departments')?'class="active" data-title="Departments"':''; ?>><a href='setup.php?action=departments' ><i class="fa fa-building-o"></i> Departments</a></li>
	<li <?=(isset($_GET['action']) && $_GET['action']=='addBranch')?'class="active" data-title="Add new branch"':''; ?>><a href='setup.php?action=addBranch'><i class="fa fa-plus-square-o"></i> Add new branch</a></li>
	<li <?=(isset($_GET['action']) && $_GET['action']=='branches')?'class="active" data-title="Branches"':''; ?>><a href='setup.php?action=branches'><i class="fa fa-bank"></i> Branches</a></li>
	<li <?=(isset($_GET['action']) && $_GET['action']=='changePassword')?'class="active" data-title="Change Password"':''; ?>><a href='setup.php?action=changePassword'><i class="fa fa-key"></i> Change Password</a></li>
</ul>
</div>
</div>
<div class="col-md-10">
<?php	
if(count($_GET)===0) {
	include "./includes/system/home.php";
}
elseif (isset($_GET['action'])) {
		if ($_GET['action']==='addDept') {
			include "./includes/system/addDept.php";
		}
		elseif ($_GET['action']==='departments') {
			include "./includes/system/departments.php";
		}
		elseif ($_GET['action']==='addBranch') {
			include "./includes/system/addBranch.php";
		}
		elseif ($_GET['action']==='branches') {
			include "./includes/system/branches.php";
		}
		elseif ($_GET['action']==='changePassword') {
			include "./includes/system/changePassword.php";
		}
		else{
			return error();
		}
	}	
else{
			return error();
		}
?>
</div>
</div>
<?php
include "./includes/footer.php";
?>