<?php
session_start();
$_SESSION['page']='payments';
	include "includes/header.php";
?>
<div class="container">
<div class="row body outer">
<div class="col-md-2">
	<div class="row aside-menu">
		<ul class="nav nav-pills nav-stacked">
			<li <?=(!isset($_GET['action']))?'class="active" data-title="Account"':''; ?>><a href='payments.php'><i class="fa fa-archive"></i> Account</a></li>
			<li <?=(isset($_GET['action']) && $_GET['action']=='pay' && isset($_SESSION['page']) && $_SESSION['page']=='payments')?'class="active" data-title="Pay employees"':''; ?>><a href='payments.php?action=pay'><i class="fa fa-money"></i> Pay employees</a></li>
			<li <?=(isset($_GET['action']) && $_GET['action']=='PayDates' && isset($_SESSION['page']) && $_SESSION['page']=='payments')?'class="active" data-title="Payment dates"':''; ?>><a href='payments.php?action=PayDates'><i class="fa fa-calendar"></i> Payment dates</a></li>
		</ul>
	</div>
</div>
<div class="col-md-10">

<?php	
if(count($_GET)===0) {
	include "./includes/account.php";
}
else{
	if (isset($_GET['action'])) {
		if ($_GET['action']==='pay') {
			include "./includes/payEmployees.php";
		}
		elseif ($_GET['action']==='PayDates') {
			include "./includes/setPaymentDate.php";
		}
		else{
			echo "PAGE NOT FOUND";
		}
	}
	if (isset($_GET['viewMsg'])) {
			//if ($_GET['viewMsg']==='') {
			include "./includes/viewMessage.php";
		//}
		}	
}
?>
</div>
</div>
<?php
include "./includes/footer.php";
?>