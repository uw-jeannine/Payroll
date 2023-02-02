<i class="active" data-title="Change Password"></i>
<?php
if (isset($_POST['savePass'])) {
	$password = mysqli_real_escape_string($conn,sha1($_POST['password']));
    $exist = mysqli_query($conn,"SELECT id,password FROM employees WHERE id='{$_SESSION['id']}' AND password='$password'");
    if (mysqli_num_rows($exist)>0) {
        $nuPass = mysqli_real_escape_string($conn,sha1($_POST['nuPass']));
        $reNuPass = mysqli_real_escape_string($conn,sha1($_POST['reNuPass']));
        if ($nuPass==$reNuPass) {
	        $sql = "UPDATE employees  SET password='{$nuPass}' WHERE id='{$_SESSION['id']}'";
	        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	        if ($query) {
	            $message='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Password changed successfully</div>';
	            //echo '<script type="text/javascript">window.location="./setup.php?action=addDept";</script>';
	            //header('location:./messages.php?action=new');
	        }
	    
	        else{
	            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Error occured</div>';
	            //header('location:./messages.php?action=new');
	        }
	    }
    	
    	else{
	            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Password do not match </div>';
    	}
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Invalid old password</div>';
        //header('location:./messages.php?action=new');
    }
}
?>
<div class="row">
	<form class="form-horizontal col-md-8 col-md-push-2 newMessage" method="post">
		<h4 class="center">Change Passsword<hr></h4>
        <?=(isset($message))?$message:'';?>
			<?php if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}  ?>
			<div class="form-group">
				<div class="col-md-4"><label>Old password</label></div>
				<div class="col-md-8"><input type="password" name="password" class="form-control" placeholder="Old Password..." required></div>
			</div>
            <div class="form-group">
                <div class="col-md-4"><label>New password</label></div>
                <div class="col-md-8"><input type="password" name="nuPass" class="form-control" placeholder="New password..." required></div>
            </div>
            <div class="form-group">
                <div class="col-md-4"><label>Re-enter new password</label></div>
                <div class="col-md-8"><input type="password" name="reNuPass" class="form-control" placeholder="Re-enter new passsword..." required></div>
            </div><br><br>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="savePass" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save password</button></div>
		</div>
	</form>
</div>