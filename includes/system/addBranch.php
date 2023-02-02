<?php
if (isset($_POST['saveBranch'])) {
    $exist = mysqli_query($conn,"SELECT branch_name FROM branches WHERE branch_name='{$_POST['branch']}'");
    if (mysqli_num_rows($exist)<=0) {
        $branch = mysqli_real_escape_string($conn,strtoupper($_POST['branch']));
        $phone = mysqli_real_escape_string($conn,$_POST['branchPhone']);
        $date = time();
        $sql = "INSERT INTO branches SET branch_name='{$branch}', phone_contact='{$phone}', savedBy='{$_SESSION['id']}', last_updated='{$date}', last_updated_by='{$_SESSION['id']}'";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if ($query) {
            $message='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>New branch has been saved</div>';
            //echo '<script type="text/javascript">window.location="./setup.php?action=addDept";</script>';
            //header('location:./messages.php?action=new');
        }
        else{
            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
            //header('location:./messages.php?action=new');
        }
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>This branch already exists</div>';
        //header('location:./messages.php?action=new');
    }
}
?>
<div class="row">
	<form class="form-horizontal col-md-8 newMessage" method="post">
		<h4 class="center">Add new branch<hr></h4>
        <?=(isset($message))?$message:'';?>
			<?php if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}  ?>
			<div class="form-group">
				<div class="col-md-4"><label>Branch name</label></div>
				<div class="col-md-8"><input type="text" name="branch" class="form-control" placeholder="Branch name..." required></div>
			</div>
            <div class="form-group">
                <div class="col-md-4"><label>Branch contact phone</label></div>
                <div class="col-md-8"><input type="text" name="branchPhone" class="form-control" placeholder="Branch contact phone..." required></div>
            </div><br><br>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><input type="submit" name="saveBranch" class="btn btn-success btn-sm" value="Save branch"></div>
		</div>
	</form>
</div>