<?='<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-danger text-center">Penalities</div></div>';
?>
<div class="row">
	<div class="col-md-12">
		<?php
		$incr=1;
		$query = mysqli_query($conn,"SELECT * FROM penalties,employees WHERE penalty_to='{$_SESSION['id']}' AND employees.id=penalties.penalty_by");
		if (mysqli_num_rows($query)>0) {
		?>

	<div class="col-md-10 msg-results"></div>
	<div class="col-md-12 messages">

		<tbody>
		<?php
		$incr=1;
		while ($fet=mysqli_fetch_array($query)) {
			echo '<div class="well"> ';
			//echo ($fet['read_']==0)?'':'';
			echo '<div class="col-md-7">'.$fet['penalty_description'].'</div><div class="col-md-3">'.ucfirst(strtolower($fet['firstname'])).'&nbsp'.$fet['lastname'].'<i>'.date('D, d M Y',$fet['punish_date']).'</i></div><i class="fa fa-clock-o"></i> '.date('h:m A',$fet['punish_date']).'</div></div>';
			$incr++;
		}
		?>
</div>
		<?php
		}
		else{
			echo '<div class="col-md-10 col-md-push-1 empty"><div class="alert alert-danger text-center"><hr><h4>You don\'t have any incoming penalty yet!<hr></h4></div></div>';
		}
		?>
	</div>

</div>