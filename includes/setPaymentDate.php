<?php
if (isset($_POST['saveD'])) {
	$dat=mysqli_real_escape_string($conn,$_POST['payDate']);
	$date = strtotime($dat);
	$today = date(' D Y M',time());
	if ($date>strtotime(($today))) {
	
	if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM payments"))==0) {
		$query = mysqli_query($conn, "INSERT INTO payments  SET payment_date='{$date}'") or die(mysqli_error($conn));
		if ($query) {
			$message="Successfully saved";
		}
	}
	else{
		$query = mysqli_query($conn, "UPDATE payments  SET payment_date='{$date}'") or die(mysqli_error($conn));
		if ($query) {
			$message="Successfully saved";
		}
	}
	}
	else{
			$error="The payment must scheduled in the future days";
		}
}
?>
	<div class="col-md-12 text-center pay-h">
		<h4> Payment dates <hr></h4>
	</div>
	<div class="col-md-6">
		<?php
			$fet=mysqli_fetch_array(mysqli_query($conn,"SELECT payment_date FROM payments"));
		?>
		<h4>Employees will be paid on <i class="text-info"><?=date('d M Y',$fet['payment_date']); ?></i></h4>
		<b class="text-info"><i class="fa fa-hand-o-right"></i> Employees get paid in a  period of 30 days</b><br><br>
		<span class="text-muted">You may also also change date employees get paid according to your problem</span><br><br>
		<div class="panel panel-default">
		<div class="panel-heading text-center"><b>Set the date on wich employees get paid</b></div>
		<?=(isset($error))?'<br><div class="col-md-12 text-center text-danger"><i class="fa fa-warning"></i> '.$error.'</div><br>':'';?>
		<?=(isset($message))?'<br><div class="col-md-12 text-center text-success"><i class="fa fa-check"></i> '.$message.'</div><br>':'';?>
		<div class="panel-body">
			<form method="POST" role="form" class="form-horizontal">
			<div class="form-group"><label class="col-md-4"> Select date</label><div class="col-md-8"><input type="date" class="form-control" name="payDate"/></div></div>
			<div class="form-group text-center"><button name="saveD" class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save</div>
		</form>
	</div>
	</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-info">
		<div class="panel-heading text-center"><b>Date on which employees will be paid</b></div>
		<div class="panel-body">
			<h1 class="cal text-center text-info"><i class="fa fa-calendar-check-o"></i></h1>
			<h3 class="text-center text-info"><?=date('d M Y',$fet['payment_date']); ?></h3>
	</div>
	</div>
	</div>