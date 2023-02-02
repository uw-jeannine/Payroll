<?php
    require_once "./includes/connect.php";
    if (!isset($_SESSION['id']) || !isset($_SESSION['status']) || !isset($_SESSION['type']) || $_SESSION['type']!='Admin' || $_SESSION['status']!=1) {
        header('location:./includes/logout.php');
    }
    function error(){
        echo '<br><br><div class="col-md-12"><div class="alert alert-danger text-center">Oops! Sorry page not found.<hr><h3><i class="fa fa-warning"></i> Invalid request</h3></div></div>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/jpg" href="./images/a.jpg"> 
<title>Payroll management system</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="js/font-awesome/css/font-awesome.min.css">
<style type="text/css" media="print">
.footerr,.nav, .btn{
    display: none;
}
*{
    top: 0px;
    font-size: 12px;
}
</style>
<link rel="stylesheet" type="text/css" href="css/custom-styles.css">
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validate.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.searchMsg').submit(function(e){
            e.preventDefault();
            searchMsg("<?=(isset($_GET['action']) && $_GET['action']=='sent')?'sent':'inbox';?>");
        });
    $('#searchMsg').keyup(function(){
          searchMsg("<?=(isset($_GET['action']) && $_GET['action']=='sent')?'sent':'inbox';?>");
    }); 
});   
</script>
</head> 
<body>
<div class="container">
    <header>
        <div class="row outer visible-md visible-lg title"><h1 style="font-weight:bold;"> PAYROLL MANAGEMENT SYSTEM </h1></div>
    </header>
    <div class="row">
        <nav class="navbar navbar-default">
            
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand">Payroll system</span>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav navbar-right menus">
                        <li <?=(!isset($_GET['action']) && !isset($_GET['edit']) && isset($_SESSION['page']) && $_SESSION['page']=='home')?'class="active" data-title="Home"':''; ?>><a href="admin.php"><i class="fa fa-home"></i> Home</a></li>
                        <li <?=(!isset($_GET['action']) && !isset($_GET['edit']) && isset($_SESSION['page']) && $_SESSION['page']=='payments')?'class="active" data-title="Payments"':''; ?>><a href="payments.php"><i class="fa fa-money"></i> Payments</a></li>
                        <li <?=(isset($_GET['action']) && $_GET['action']=='addEmployee')?'class="active" data-title="Add employee"':''; ?>><a href="employees.php?action=addEmployee"><i class="fa fa-user-plus"></i> Add employee</a></li>
                        <li <?=((!isset($_GET['action']) && isset($_SESSION['page']) && $_SESSION['page']=='employees') || isset($_GET['edit']))?'class="active" data-title="Employees"':''; ?>><a href="employees.php"><i class="fa fa-users"></i> Employees</a></li>
                        <li  <?=(isset($_GET['action']) && ($_GET['action']=='punish' || $_GET['action']=='penalties'))?'class="active" data-title="Punish employee"':''; ?>><a href="./admin.php?action=punish"><i class="fa fa-balance-scale"></i> Penalties</a></li>
                        <li <?=(isset($_SESSION['page']) && $_SESSION['page']=='messages')?'class="active" data-title="Inbox messages"':''; ?>><a href="messages.php"><i class="fa fa-envelope-o"></i> Messages</a></li>
                        <li <?=(isset($_SESSION['page']) && $_SESSION['page']=='setup')?'class="active" data-title="System Setup"':''; ?>><a href="./setup.php"><span></span><i class="fa fa-sliders"></i> System setup</a></li>
                        <li>
                            <a href="#" data-toggle="dropdown" data-target="dropdown-menu" data-placement="right"><i class="fa fa-user-secret"></i>  <?=$_SESSION['quickName'];?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                               <li><a href="./admin.php?action=about"><i class="fa fa-user"></i> &nbsp;About you</a></li>
                               <li><a href="./setup.php?action=changePassword"><i class="fa fa-key"></i> &nbsp;Change password</a></li>
                                <li class="divider"></li>
                                <li><a class="tip" title="Logout" href="./includes/logout.php"><i class="fa fa-sign-out"></i> &nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>
</div>