<?php
if (isset($_GET['editBranch'])) {
	$toUp = "SELECT branch_name,phone_contact FROM branches WHERE branch_id='{$_GET['editBranch']}'";
	$result = mysqli_query($conn,$toUp);
	if (mysqli_num_rows($result)>0) {
if (isset($_POST['updateDept'])) {
    $exist = mysqli_query($conn,"SELECT branch_name FROM branches WHERE branch_name='{$_POST['dept']}' AND branch_id!='{$_GET['editBranch']}'");
    if (mysqli_num_rows($exist)==0) {
        $dept = mysqli_real_escape_string($conn,strtoupper($_POST['dept']));
        $date = time();
        $sql = "UPDATE branches SET branch_name='{$dept}', savedBy='{$_SESSION['id']}', last_updated='{$date}', last_updated_by='{$_SESSION['id']}' WHERE branch_id='{$_GET['editBranch']}'";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if ($query) {
            $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Branch info has been updated</div>';
            echo '<script type="text/javascript">window.location="./setup.php?action=branches";</script>';
        }
        else{
            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
            //header('location:./messages.php?action=new');
        }
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Branch already exists</div>';
        //header('location:./messages.php?action=new');
    }
}
?>
<div class="row">
	<form class="form-horizontal col-md-8 newMessage" method="post">
		<h4 class="center active" data-title="Edit Branch details">Update Branch<hr></h4>
			<?=(isset($message))?$message:' '; 
			$data = mysqli_fetch_array($result)
			?>

			<div class="form-group">
				<div class="col-md-4"><label>Branch name</label></div>
				<div class="col-md-8"><input type="text" name="dept" class="form-control" placeholder="Branch name..." value="<?=(isset($_POST['branch']))?'':$data['branch_name'];?>" required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Branch phone contact</label></div>
				<div class="col-md-8"><input type="text" name="phone" class="form-control" placeholder="Phone contact..." value="<?=(isset($_POST['phone']))?'':$data['phone_contact'];?>" required></div>
			</div>
			<br><br>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><input type="submit" name="updateDept" class="btn btn-success btn-sm" value="Save changes"></div>
		</div>
	</form>
</div>
<?php
	}
	else{
		echo '<div class="col-md-8 col-md-push-1 empty"><div class="alert alert-danger text-center"><hr><h4>Invalid Request</h4> <br><a href="./setup.php?action=branches">Go back</a><hr></div></div>';
	}
}
else{
?>
<div class="row">
	<div class="col-md-12">
		<?php
		$incr=1;
		$query = mysqli_query($conn,"SELECT * FROM branches,employees WHERE employees.id=branches.last_updated_by");
		if (($rows=mysqli_num_rows($query))>0) {
		?>
	<div class="col-md-12">
		<div class="col-md-12"><h4 class="center">Branch<?=($rows>1)?'es':''; ?></h4><hr></div>
	</div>
	<div class="col-md-12 employees">
			<?php if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}  ?>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr><th>#</th><th>Branch</th><th>Last updated by</th><th>Last updated on</th><th>Operations</th></tr>
		</thead>
		<tbody>
		<?php
		$incr=1;
		while ($fet=mysqli_fetch_array($query)) {
			echo '<tr><td>'.$incr.'</td><td>'.$fet['branch_name'].'</td><td>'.htmlspecialchars($fet['firstname'].' '. $fet['lastname']).'</td><td>'.date('D, d M Y, h:i A',$fet['last_updated']).'</td><td><a href="./setup.php?action=branches&editBranch='.$fet['branch_id'].'"/>Edit</a></td>';
			//echo()?'':'';
			echo'</tr>';
			$incr++;
		}
		?>
	</tbody>
	</table>
</div>
		<?php
		}
		else{
			echo '<div class="col-md-8 col-md-push-1 empty"><div class="alert alert-danger text-center"><hr><h4>Oops! There is no any saved Branch.</h4> <br><a href="./setup.php?action=branches">Add some</a><hr></div></div>';
		}
		?>
	</div>
</div>
<?php
}
?>