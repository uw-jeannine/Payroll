<div class="row">
	<div class="col-md-12">
		<?php
		$incr=1;
		$query = mysqli_query($conn,"SELECT * FROM messages,employees WHERE messages.sender='{$_SESSION['id']}' AND employees.id=messages.receiver ORDER BY messages.msg_id DESC limit 15");
		if (($rows=mysqli_num_rows($query))>0) {
		?>
	<div class="col-md-12">
		<div class="col-md-8"><h4 class="center">Sent message<?=($rows>1)?'s':''; ?></h4><hr></div>
		<div class="col-md-4 right"><form class="navbar-form searchMsg">
			<div class="form-group"><input type="text" class="form-control" id="searchMsg" name="searchMsg" placeholder="Search sent message..."/></div> </form></div>
	</div>
	<div class="col-md-12 msg-results"></div>
	<div class="col-md-12 messages">
	<table class="table table-striped table-hover">
		<thead>
			<tr><th style="width:500px">Title</th><th>To</th><th colspan="2">Date</th></tr>
		</thead>
		<tbody>
		<?php
		$incr=1;
		while ($fet=mysqli_fetch_array($query)) {
			echo '<tr ';
			echo ($fet['read_']==0)?'class="success"':'';
			echo '><td><a href="messages.php?action=out&viewMsg='.$fet['msg_id'].'">'.$fet['title'].'</a></td><td>'.ucfirst(strtolower($fet['firstname'])).'&nbsp'.$fet['lastname'].'</td><td class="text-muted"><i>'.date('D, d M Y',$fet['datetime']).'</i> </td><td><i class="fa fa-clock-o"></i> '.date('h:m A',$fet['datetime']).'</td></tr>';
			$incr++;
		}
		?>
	</tbody>
	</table>
</div>
		<?php
		}
		else{
			echo '<div class="col-md-8 col-md-push-1 empty"><div class="alert alert-danger text-center"><hr><h4>You have not yet wrote any message!</h4><hr></div></div>';
		}
		?>
	</div>

</div>