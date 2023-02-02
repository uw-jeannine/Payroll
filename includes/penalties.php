<?php
if (isset($_POST['punish'])) {
    $who = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM employees WHERE username='{$_POST['who']}'"));
    if ($who) {
        $descr = mysqli_real_escape_string($conn,ucfirst($_POST['description']));
        $date = time();
        $fines = mysqli_real_escape_string($conn,ucfirst($_POST['fines']));
        $que_exist_fines = mysqli_query($conn,"SELECT fines FROM penalties WHERE id ='{$who['id']}'");
        $tot_fines=0;
        if ($que_exist_fines) {
        	while ($fine_by=mysqli_fetch_array($que_exist_fines)) {
        		$tot_fines= $tot_fines+$fine_by;
        	}
        }
        $tot_ded=$who['assurance']+$who['deductions']+$tot_fines;
        if ($fines>($who['salary']-$tot_ded)) {
        	$message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Insufficient net salary with net salary of <b class="text-muted">Rwf '.($who['salary']-$tot_ded).'</b></div>';
        }
    	else{
	        $sql = "INSERT INTO penalties SET penalty_description='{$descr}', fines='{$fines}', penalty_by='{$_SESSION['id']}', penalty_to='{$who[0]}', punish_date='{$date}',read_=0";
	        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	        if ($query) {
	            $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$who['firstname'].' '.$who['lastname'].' has been punished with fines of <b class="text-muted">Rwf '.$fines.'</b> and lefts with <b class="text-muted">Rwf '.($who['salary']-$tot_ded).'</b></div>';
	            echo '<script type="text/javascript"> window.location="./admin.php?action=penalties"; </script>';
		    }
	        else{
	            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
	        }
		}
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Invalid address of employee</div>';
    }
}
?>
<div class="col-md-10">
	<form class="form-horizontal col-md-9 newMessage" method="post">
		<h4 class="center">Punish an employee</h4><hr>
			<?=(isset($message))?$message:' '; ?>
			<div class="form-group">
				<div class="col-md-4"><label>Who you want to punish</label></div>
				<div class="col-md-8"><input type="text" name="who" id="receiver" class="form-control" placeholder="Who?" value="<?=(isset($_POST['who']))?$_POST['who']:'';?>" readonly required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Penalty fines</label></div>
				<div class="col-md-8"><input type="number" name="fines" class="form-control" placeholder="Penalty fines..." <?=(isset($_POST['fines']))?'value="'.$_POST['fines'].'" id="error"':'';?> required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Mistake description</label></div>
				<div class="col-md-8">
					<textarea class="form-control" rows="10" name="description" placeholder="Describe a mistake an employee has done ..." required><?=(isset($_POST['description']))?$_POST['description']:'';?></textarea>
				</div>
			</div>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="punish" class="btn btn-success btn-sm"><i class="fa fa-legal"></i> Punish</button></div>
		</div>
	</form>
</div>
<div id="searchReceiver" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Who to punish?</h4>
			</div>
	<div class="modal-body">
		<form role="form" class="form-horizontal">
		<div class="form-group">
			<div class="col-md-4"><Label>Firstname,Lastname or Username</label></div>
			<div class="col-md-8"><input type="text" name="searchName" id="keyName" class="form-control" placeholder="Search by username,firstname or username "/></div>
		</div>
	</form>
		<div class="text-info user-results"></div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	</div>
</div>
</div>
</div>