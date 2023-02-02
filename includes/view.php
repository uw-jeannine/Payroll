<div class="row">
	<?php
		$query = mysqli_query($conn,"SELECT employees.*,branches.branch_name,departments.dept_name FROM employees,branches,departments WHERE employees.id!='{$_SESSION['id']}' AND employees.id='{$_GET['view']}' AND branches.branch_id=employees.branch AND departments.dept_id=employees.department ORDER BY employees.firstname ASC limit 20");
		if (($rows=mysqli_num_rows($query))>0) {
			$fet=mysqli_fetch_array($query);
		?>
	<div class="col-md-12">
		<div class="col-md-12 text-center"><h4>Full information of an employee<hr></h4></div>
		<div class="col-md-4 text-center">
			<a href="#"><img style="height:270px;width:270px;" src="employees_pictures/<?=$fet['picture']; ?>" class="img-rounded img-responsive pic" /></a>
		</div>
		<div class="col-md-8">
			<h4 class="active" data-title="<?=($fet['gender']=='Male')?'Mr ':'Mrs '; ?><?=$fet['firstname']." ". $fet['lastname']; ?>"><?=($fet['gender']=='Male')?'Mr ':'Mrs '; ?><?=$fet['firstname']." ". $fet['lastname']; ?></h4>
		</div>
		<div class="col-md-4">
			<table class="table table-hover table-striped">
				<tr><tr><th>Phone No </th><td><?=$fet['phone']; ?></td></tr></tr>
				<tr><tr><th>Email </th><td><?=$fet['username']; ?></td></tr></tr>
				<tr><tr><th>DOB </th><td><?=$fet['dateOfBirth']; ?></td></tr></tr>
				<tr><tr><th>Designation </th><td><?=$fet['designation']; ?></td></tr></tr>
				<tr><tr><th>Department </th><td><?=$fet['dept_name']; ?></td></tr></tr>
				<tr><tr><th>Branch </th><td><?=$fet['branch_name']; ?></td></tr></tr>
			</table>
		</div>
		<div class="col-md-4">
			<table class="table table-hover table-striped">
				<tr><tr><th>Joined date </th><td><?=$fet['joinDate']; ?></td></tr></tr>
				<tr><tr><th>Salary </th><td><?=$fet['salary']; ?></td></tr></tr>
				<tr><tr><th>Insurance </th><td><?=$fet['assurance']; ?></td></tr></tr>
				<tr><tr><th>Bank Account No </th><td><?=$fet['BankAccountNo']; ?></td></tr></tr>
				<tr><tr><th>Adress </th><td><?=$fet['address']; ?></td></tr></tr>
				<tr><tr><th>Type </th><td><?=$fet['type']; ?></td></tr></tr>
			</table>
		</div>
	</div>
	

<?php
}
else{
	echo '<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-danger text-center"> Ooops! Sorry<hr><h4><br>Invalid request<br><br></h4></div></div>';
}
?>
</div>
<div id="modal_pic" class="modal fade">
	<div class="modal-dialog text-center">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h5 class="modal-title text-center"><?=($fet['gender']=='Male')?'Mr ':'Mrs '; ?><?=$fet['firstname']." ". $fet['lastname']; ?></h5>
			</div>
			<div class="modal-body">
				<img src="./employees_pictures/<?=$fet['picture']; ?>" class="img-rounded img-responsive" />	
			</div>
		</div>
	</div>
</div>