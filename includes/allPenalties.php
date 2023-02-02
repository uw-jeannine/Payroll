<?php
if (isset($_GET['delete'])) {
	$pen = mysqli_real_escape_string($conn,$_GET['delete']);
	$pen_del = mysqli_query($conn,"SELECT * FROM penalties WHERE penalty_id='{$pen}'");
	if (mysqli_num_rows($pen_del)) {
		mysqli_query($conn,"DELETE FROM penalties WHERE penalty_id='{$pen}'");
		$_SESSION['message']='<div class="alert alert-success text-center col-md-6 col-md-pull-3 col-md-push-3"><a href="#" class="close" data-dismiss="alert">&times;</a> Penalties successfully ignored</div>';
		echo "<script type='text/javascript'>window.location='./admin.php?action=penalties';</script>";
	}
	else{
		return error();
	}
}
?>
<div class="col-md-10">
		<h4 class="center">Employees with penalties</h4><hr>
	<?php
	$query = mysqli_query($conn,"SELECT * FROM penalties,employees,branches,departments WHERE  employees.id=penalties.penalty_to AND branches.branch_id=employees.branch AND departments.dept_id=employees.department ORDER by penalties.punish_date desc");
	if (mysqli_num_rows($query)) {
	?>
		<?php
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
		?>
		<table class="table table-stripped">
			<thead><tr><th>Date</th><th>Employee names</th><th>Description</th><th>Ignore penalty</th></tr></thead>
		<?php
	        while ($fet=mysqli_fetch_array($query)) {
	        	echo '<tr><td><i class="text-muted">'.date('D d M Y h:i',$fet['punish_date']).'</i></td><td>'.$fet['firstname'].' '.$fet['lastname'].'</td><td><a href="#" data-what="penalty'.$fet['penalty_id'].'" class="viewPen">'.substr($fet['penalty_description'],0,50);
	        	echo (strlen($fet['penalty_description'])>50)?'...':'';
				echo '</a></td><td><a href="./admin.php?action=penalties&delete='.$fet['penalty_id'].'"/>Ignore this penalty</a></td></tr>';
	        	?>
							<div id="penalty<?=$fet['penalty_id'];?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?=$fet['firstname'].' '.$fet['lastname'];?> penalty</h4>
										</div>
										<div class="modal-body">
											<div class="well">
											<label>Names</label>  <?=$fet['firstname'].' '.$fet['lastname'];?><br><br>
											<label>Branch</label>  <?=$fet['branch_name'];?><br><br>
											<label>Department</label>  <?=$fet['dept_name'];?>											
											</div>
											<div class="well">
											<label>Date mistake was done</label> <?=date('D d M Y h:i',$fet['punish_date']);?><br><br>
											<label>Mistake description</label> <?=$fet['penalty_description'];?><br><br>
											<label>Fine</label> Rwf <?=$fet['fines'];?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
			<?php
			    }
					echo "</table>";      	
			}
			else{
echo '<div class="col-md-8 col-md-push-2"><div class="alert alert-warning text-center"><h4><br>No employee who has penalty<hr><hr></h4></div></div>';

			}
		?>		
</div>