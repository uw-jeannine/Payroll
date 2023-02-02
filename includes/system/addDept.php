<?php
if (isset($_POST['saveDept'])) {
    $exist = mysqli_query($conn,"SELECT dept_name FROM departments WHERE dept_name='{$_POST['dept']}'");
    if (mysqli_num_rows($exist)<=0) {
        $dept = mysqli_real_escape_string($conn,strtoupper($_POST['dept']));
        $date = time();
        $sql = "INSERT INTO departments SET dept_name='{$dept}', savedBy='{$_SESSION['id']}', last_updated='{$date}', last_updated_by='{$_SESSION['id']}'";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if ($query) {
            $message='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Department saved</div>';
            //echo '<script type="text/javascript">window.location="./setup.php?action=addDept";</script>';
            //header('location:./messages.php?action=new');
        }
        else{
            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
            //header('location:./messages.php?action=new');
        }
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Department already exists</div>';
        //header('location:./messages.php?action=new');
    }
}
?>
<div class="row">
	<form class="form-horizontal col-md-8 newMessage" method="post">
		<h4 class="center">Add new department<hr></h4>
		<?=(isset($message))?$message:'';?>
			<?php if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}  ?>
			<div class="form-group">
				<div class="col-md-4"><label>Department name</label></div>
				<div class="col-md-8"><input type="text" name="dept" class="form-control" placeholder="Department name..." required></div>
			</div><br><br>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><input type="submit" name="saveDept" class="btn btn-success btn-sm" value="Save department"></div>
		</div>
	</form>
</div>