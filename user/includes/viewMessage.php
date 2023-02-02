<div class="row">
	<div class="col-md-12">
		<?php
		$incr=1;
		$selector = (isset($_GET['action']) && $_GET['action']=='in')?'messages.sender':'messages.receiver';
		$query = mysqli_query($conn,"SELECT * FROM messages,employees,branches,departments WHERE messages.msg_id='{$_GET['viewMsg']}' AND employees.id=$selector AND departments.dept_id=employees.department AND branches.branch_id=employees.branch") or die(mysqli_error($conn));
		if ($query && ($rows=mysqli_num_rows($query))>0) {
			$fet=mysqli_fetch_array($query);
			($fet['read_']==0 && $fet['sender']!=$_SESSION['id'])?mysqli_query($conn,"UPDATE messages SET read_=1 WHERE msg_id='{$_GET['viewMsg']}'"):'';
		?>
		<div class="col-md-12">
		<h4 class="text-center"><?=($fet['sender']==$_SESSION['id'])?'Outbox':'Inbox';?> message</h4><hr></div>
	<div class="col-md-12">
	<div class="panel panel-default msg">
		<?php
			$sender = ($fet['sender']==$_SESSION['id'])?'You':htmlentities($fet['firstname']).'&nbsp;'.htmlentities($fet['lastname']);
			$receiver = ($fet['receiver']==$_SESSION['id'])?'You':htmlentities($fet['firstname']).'&nbsp;'.htmlentities($fet['lastname']);
			$sub=($fet['gender']=='Male')?'him':'her';
			echo '<div class="panel-heading"><b class="text-info">'.htmlentities($fet['title']).'</b><div><i class="text-muted">From </i><b>';
			echo $sender .'</b> to <b>'.$receiver;
			echo '</b> &nbsp;&nbsp;&nbsp;<i class="text-muted">'.date('D, d M Y h:i A',$fet['datetime']).'</i></div></div><div class="panel-body msg_body">'.htmlentities($fet['body']).'</div>';
			$incr++;
		
		?>
		<div class="panel-footer"><span class="text-muted"><?=($fet['sender']==$_SESSION['id'])?'About receiver ':'About sender ';?></span><i><b><?=$fet['designation'];?></b>, <?=$fet['dept_name'];?> Department | <?=$fet['branch_name'];?> Branch</i></div>
	</div>
<?php
$to=(isset($_GET['action']) && $_GET['action']=='in')?'Reply '.$sub:'Write to '.$sub.' again';
?>
<a href="messages.php?action=new&to=<?=$fet['id'];?>"><div class="col-md-2 col-md-push-5"><button type="submit" name="save" class="btn btn-reply"><i class="fa fa-reply"></i>&nbsp; <?=$to;?></button></div></a>
</div>
		<?php
		}
		else{
			echo '<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-warning text-center">'.$_SESSION['quickName'].' <br><br><h4>You don\'t have any messages yet!</h4></div></div>';
		}
		?>
	</div>

</div>