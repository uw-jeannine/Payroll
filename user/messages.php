<?php
session_start();
$_SESSION['page']='messages';
	include "./includes/header.php";
?>
<div class="container">
<div class="row body outer">
<div class="col-md-2">
	<div class="row aside-menu">
		<ul class="nav nav-pills nav-stacked">
			<li <?=(isset($_GET['action']) && $_GET['action']=='new')?'class="active" data-title="Compose new message"':''; ?>><a href='messages.php?action=new'><i class="fa fa-pencil-square-o"></i> Compose</a></li>
			<li <?=((!isset($_GET['action']) || (isset($_GET['action']) && $_GET['action']=='in'))&& isset($_SESSION['page']) && $_SESSION['page']=='messages')?'class="active" data-title="Inbox messages"':''; ?>><a href='messages.php'><i class="fa fa-inbox"></i> Inbox</a></li>
			<li <?=(isset($_GET['action']) && ($_GET['action']=='sent' || $_GET['action']=='out'))?'class="active" data-title="Sent Messages"':''; ?>><a href='messages.php?action=sent'><i class="fa fa-send"></i> Sent</a></li>
		</ul>
	</div>
</div>
<div class="col-md-10">

<?php	
if(count($_GET)===0) {
	include "./includes/Allmessages.php";
}
else{
	if (isset($_GET['action'])) {
		if ($_GET['action']==='new') {
			include "./includes/forms/newMessage.php";
		}
		elseif ($_GET['action']==='sent') {
			include "./includes/sentMessages.php";
		}
		elseif(($_GET['action']=='in' || $_GET['action']=='out') && isset($_GET['viewMsg'])){
			include "./includes/viewMessage.php";
		}
		else{
			return error();
		}
	}
		
}
?>
</div>
</div>
<?php
include "./includes/footer.php";
?>