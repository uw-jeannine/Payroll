
<div class="row">
		<?php
		$incr=1;
		$query = mysqli_query($conn,'SELECT employees.*,branches.branch_name,departments.dept_name FROM employees,branches,departments WHERE branches.branch_id=employees.branch AND departments.dept_id=employees.department');
		if (mysqli_num_rows($query)>0) {
		?>
	<div class="col-md-12">
		
	<div class="col-md-12 second-header">
		<div class="col-md-8"><h4 class="center">Deactivated Employees</h4></div>
		<div  class="iki"><form class="navbar-form searchForm">
			<div class="form-group"><input type="text" class="form-control" id="search" name="search" placeholder="Search..."/></div>

			 </form></div>
	</div>
	<div class="col-md-12 results"></div>
	<div class="col-md-12 employees">
		<span class="col-md-6 col-md-push-3 col-md-pull-3">
		<?php echo (isset($_SESSION['message']))?$_SESSION['message']:''; ?>
		<?php unset($_SESSION['message']); ?>
	</span>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr><th>#</th><th>Firstname</th><th>Lastname</th><th>Designation</th><th>Department</th><th>Branch</th><th class="iki">Actions</th></tr>
		</thead>
		<tbody>
		<?php
		$incr=1;
$query = mysqli_query($conn,"SELECT employees.*,branches.branch_name,departments.dept_name FROM employees,branches,departments WHERE employees.id!='{$_SESSION['id']}' AND branches.branch_id=employees.branch AND departments.dept_id=employees.department ORDER BY employees.firstname ASC limit 20");
		while ($fet=mysqli_fetch_array($query)) {
			echo '<tr><td>'.$incr.'</td><td>'.ucfirst($fet['firstname']).'</td><td>'.ucfirst($fet['lastname']).'</td><td>'.ucfirst($fet['designation']).'</td><td>'.ucfirst($fet['dept_name']).'</td><td>'.ucfirst($fet['branch_name']).'</td><td>| <a href="employees.php?deactivate='.$fet['id'].'"><i class="fa fa-external-link"></i> Deactivate</a>&nbsp;&nbsp; |<a href="employees.php?del='.$fet['id'].'"><i class="fa fa-times-circle-o"></i> Delete</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="admin.php?edit='.$fet['id'].'"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="employees.php?view='.$fet['id'].'"><i class="fa fa-info"></i> Full info</a></td></tr>' ;
			$incr++;
		}
		?>
	</tbody>
	</table>
</div>
	</div>

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

<div class="col-md-12 text-right">
		
		

<?php
}
else{

echo '<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-warning text-center">Ooops!<hr><h4><br>No deactived users in the system.<br><br></h4></div><p class="text-center"></p></div>';
}
?>	

	</div>