<?php
if (isset($_POST['saveD'])) {
	$balance=mysqli_real_escape_string($conn,$_POST['balance']);
	if ((mysqli_num_rows(mysqli_query($conn,"SELECT * FROM payments")))==0) {
		$query = mysqli_query($conn, "INSERT INTO payments  SET account='{$balance}'") or die(mysqli_error($conn));
		if ($query) {
			$message="Successfully saved";
		}
	}
	else{
		$query = mysqli_query($conn, "UPDATE payments  SET account='{$balance}'") or die(mysqli_error($conn));
		if ($query) {
			$message= "Successfully saved";
		}
	}
}
?>
	<div class="col-md-12 text-center pay-h">
		<div class="col-md-8"><h4> Account <hr></h4>
	</div></div>
	<div class="col-md-12 text-center text-success h4"><?=(isset($message))?$message."<br><br>":'';?></div>
	<div class="col-md-6">
		<div class="panel panel-default">
		<div class="panel-heading text-center"><b>Set account balance</b></div>
		<div class="panel-body">
			<form method="POST" role="form" class="form-horizontal">
			<div class="form-group"><label class="col-md-4"> Balance</label><div class="col-md-8"><input type="number" class="form-control" name="balance" placeholder="Balane in Rwf" required/></div></div>
			<div class="form-group text-center"><button name="saveD" class="btn btn-success btn-sm" type="submit"><i class="fa fa-calendar-check-o"></i> Save change</div>
		</form>
	</div>
	</div>
	</div>
	<div class="col-md-6">
		<?php
				$fet=mysqli_fetch_array(mysqli_query($conn,"SELECT account FROM payments"));
				$credit=0;
				$que_=mysqli_query($conn,"SELECT salary FROM employees");
				while($all_=mysqli_fetch_array($que_)){
					$credit=$credit+$all_['salary'];
				}
				
			 ?>
		<div class="panel panel-<?=($fet['account']>$credit)?'success':'danger'; ?>">
		<div class="panel-heading text-center "><b><?=($fet['account']>$credit)?'':'<i class="fa fa-warning"></i> '; ?> In account</b></div>
		<div class="panel-body text-center text-<?=($fet['account']>$credit)?'success':'danger'; ?>">
			<span class="big"><i>Rwf</i> <?=$fet['account']; ?></span>
			<?php 
				if($fet['account']<$credit){
					echo '<h4>Rwf '.($credit-$fet['account']).' to add to pay employees</h4>';
				}
			?>
	</div>
	</div>
	</div>
	