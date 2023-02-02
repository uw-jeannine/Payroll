<?php
$check=mysqli_query($conn,"DELETE FROM employees WHERE id='{$_GET['del']}'");
if ($check) {
	

$query=mysqli_query($conn,"DELETE FROM employees WHERE id='{$_GET['del']}'");
if($query){
	$_SESSION['message']='<div class="alert alert-success col-md-6 col-md-push-3 col-md-pull-3"><a href="#" class="close" data-dismiss="alert">&times;</a>Employee successfully deleted</div>';
	echo "<script type='text/javascript'>window.location='employees.php';</script>";
}
else{
	echo "Failed";
}
}
else{
	echo '<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-success text-center">Ooops! Sorry<hr><h4><br>Invalid request.<br><br></h4></div></div>';
}

?>






<div class="row pay-table">
	<div class="col-md-12 text-center pay-h">
		<h4> Deactivated Employees <small> <label>Today</label> <?=date('D, d M Y', time()); ?> <label class='text-success'> date</label></small><hr></h4>
	</div>
	<div class="col-md-12 text-center to-be-paid">
		<?php
		$query = mysqli_query($conn,"SELECT * FROM employees,branches,departments WHERE branches.branch_id=employees.branch AND  departments.dept_id=employees.department ORDER BY firstname");
		$rows = mysqli_num_rows($query);
		if ($rows>0) {
			$incr=1;
			$total=0;
		?>
		
			
				


					</div>
	<div class="col-md-12 msg-results"></div>
	<div class="col-md-12 messages">
	<table class="table table-hover">
		<thead>
			<tr><th style="width:500px">Name</th><th>Department</th><th colspan="2">Date and time</th><th colspan="2">Actions</th></tr>
		</thead>
		<tbody>

	</tbody>







	</table>
			<?php
			
			}
				echo '';
			?>

		<?php	
		
		?>
					</tbody>
		</table>

	</div>
	<div class="col-md-12 text-right">
		<?php
		$pay_date=(mysqli_fetch_array(mysqli_query($conn,"SELECT payment_date FROM payments"))[0]);
		$month_start=$pay_date-2592000;
		if ((time()-$month_start)>=2592000) {
		echo '<button class="btn btn-default command-pay">Print list</button>';
		}
		else{
			$days= (int) (($pay_date-time())/86400 ) ;
			$hours=(int) ((($pay_date-time())%86400 )/3600);
			echo '<h5 class="timer"><i class="fa fa-hourglass-half"></i> '; 
			echo ($days>0)?$days:'';
			if($days>0) echo ($days>1)?' days':' day';
			echo ($hours>0 && $days>0)?' and ':'';
			echo ($hours>0)?$hours:'';
			if($hours>0) echo ($hours>1)?' hours':' hour';
			echo ' left to pay employees</h5>';
		}
		?>
	</div>
</div>