<?php
$query = mysqli_query($conn,"SELECT * FROM employees WHERE id='{$_GET['edit']}'");
if (($rows=mysqli_num_rows($query))>0) {
	$fet=mysqli_fetch_array($query);
	$query_br = mysqli_query($conn,"SELECT branch_id,branch_name FROM branches") or die(mysqli_error($conn));
	$query_dpt = mysqli_query($conn,"SELECT dept_id,dept_name FROM departments");
if (isset($_POST['update'])) {
    $fname = mysqli_real_escape_string($conn,strtoupper($_POST['firstname']));
    $lname = mysqli_real_escape_string($conn,ucfirst($_POST['lastname']));
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,ucfirst($_POST['address']));
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $branch = mysqli_real_escape_string($conn,ucfirst($_POST['branch']));
    $designation = mysqli_real_escape_string($conn,ucfirst($_POST['designation']));
    $dept = mysqli_real_escape_string($conn,ucfirst($_POST['department']));
    $joinDate = mysqli_real_escape_string($conn,strtotime($_POST['joinDate']));
    $salary = mysqli_real_escape_string($conn,$_POST['salary']);
    $deductions = mysqli_real_escape_string($conn,$_POST['deductions']);
    $assurance = mysqli_real_escape_string($conn,$_POST['assurance']);
    $accountNo = mysqli_real_escape_string($conn,$_POST['accountNo']);
    $type = mysqli_real_escape_string($conn,ucfirst($_POST['type']));
    $emp_id = $fname.time();
    $username = mysqli_real_escape_string($conn,$_POST['user']);
    if (isset($_FILES['picture']['tmp_name'])) {
    	$pic = $_FILES['picture'];
    	$ext = explode('/',$_FILES['picture']['type']);
    	$imageType=['image/jpg','image/jpeg','image/bmp','image/png'];
    	$extension = $ext[count($ext)-1];
    	if(in_array($extension, $imageType)){
			$errors[]="* Invalid picture format(must be jpg,png or bmp)";
		}
    }
    
    $check_acc = mysqli_query($conn,"SELECT * FROM employees WHERE BankAccountNo='{$accountNo}' AND id!='{$_GET['edit']}'");
	$check_email = mysqli_query($conn,"SELECT * FROM employees WHERE id != '{$_GET['edit']}' AND  username='{$username}'");
	$check_phone = mysqli_query($conn,"SELECT * FROM employees WHERE id != '{$_GET['edit']}' AND phone='{$phone}'");
	$errors=[];
	//var_dump($check_acc);
		if($salary<($assurance+$deductions)){
			$errors[]="* The sum of dedutions & assurance must be less than salary<br>&nbsp;&nbsp;(The assurance and other deductions will be taken from an employee salary)";
		}
		if(mysqli_num_rows($check_acc)>0){
			$errors[]="* The bank account number already exists";
		}
		if(mysqli_num_rows($check_phone)>0){
			$errors[]="* The phone number already exists";
		}
		if(mysqli_num_rows($check_email)>0){
			$errors[]="* The email already exists, add another email";
		}
    if (count($errors)<=0) {
    	if (!empty($_FILES['picture']['tmp_name'])) {
	    	move_uploaded_file($pic['tmp_name'], './employees_pictures/'.$pic_name=$fname.$lname.time().'.'.$extension);
	    }
	    else{
	    	$pic_name=$fet['picture'];
	    }
	    $sql = "UPDATE employees SET firstname='{$fname}', lastname='{$lname}', gender='{$gender}', dateOfBirth='{$dob}', phone='{$phone}', address='{$address}', branch='{$branch}', designation='{$designation}', department='{$dept}', joinDate='{$joinDate}', salary='{$salary}', assurance='{$assurance}', deductions='{$deductions}', BankAccountNo='{$accountNo}', type='{$type}', username='{$username}',picture='{$pic_name}' WHERE id='{$_GET['edit']}'";
	    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	    if ($query) {
	    	if ($_SESSION['id']===$_GET['edit']) {
		    	$genre =($gender=='Male')?'Mr':'Mrs';
		    	$_SESSION['quickName']=$genre.' '.$fname.' '.$lname;
	    	}
	        $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Changes saved successfully</div>';
	        echo '<script type"text/javascript">window.location="employees.php";</script>';
	    }
	    else{
	        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Error</div>';
	        //header('Location:./employees.php?action=addEmployee');
	    }
    }
    else{
    	
    	$plural=(count($errors)>1)?'s':'';
		$feedback="<b>Error".$plural."</b><br>";
    	foreach ($errors as $error) {
    		$feedback=$feedback.$error.'<br>';
    	}
    	$status=0;
    	$message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$feedback.'</div>';
        //header('Location:./employees.php?action=addEmployee');
    }
    
}
?>
<div class="row">
<div class="col-md-12" ><h4 class="center active" data-title="Edit employee records">Edit employee records</h4><hr>
	<form class="form-horizontal col-md-6 col-md-push-3 col-md-pull-3" id="updateEmployee" method="post" enctype="multipart/form-data">
			<?=(isset($message))?$message:'';?>
		<fieldset>
			<legend>Personal information</legend>
			<div class="form-group">
				<div class="col-md-4"><label>Names</label></div>
				<div class="col-md-4"><input type="text" name="firstname" class="form-control" placeholder="Firstname..." value="<?=(isset($_POST['firstname']))?$_POST['firstname']:$fet['firstname']; ?>" required/></div>
				<div class="col-md-4"><input type="text" name="lastname" class="form-control" placeholder="Lastname..." value="<?=(isset($_POST['lastname']))?$_POST['lastname']:$fet['lastname']; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Date of birth</label></div>
				<div class="col-md-8"><input type="date" name="dob" class="form-control" placeholder="DD/MM/YYYY" value="<?=(isset($_POST['dob']))?$_POST['dob']:$fet['dateOfBirth']; ?>" required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Gender</label></div>
				<div class="col-md-8">
					<select name="gender" class="form-control">
						<option value="Male" <?=($fet['gender']=='Male')?'selected':''; ?>>Male</option>
						<option value="Female" <?=($fet['gender']=='Female')?'selected':''; ?>>Female</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Telephone No</label></div>
				<div class="col-md-8"><input type="text" name="phone" class="form-control" placeholder="Telephone No..." value="<?=(isset($_POST['phone']))?$_POST['phone']:$fet['phone']; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Email</label></div>
				<div class="col-md-8"><input type="text" name="user" class="form-control" placeholder="Email..." value="<?=(isset($_POST['user']))?$_POST['user']:$fet['username']; ?>"required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Address</label></div>
				<div class="col-md-8"><input type="text" name="address" class="form-control" placeholder="Address..."  value="<?=(isset($_POST['address']))?$_POST['address']:$fet['address']; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Photo</label></div>
				<div class="col-md-8"><input type="file" name="picture" class="form-control" placeholder="Address..."/></div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Professional information</legend>
		<div class="form-group">
			<div class="col-md-4"><label>Branch</label></div>
			<div class="col-md-8">
				<select class="form-control" name="branch">
					<?php while($fet_br=mysqli_fetch_array($query_br)){
						echo "<option value='".$fet_br['branch_id']."'";
						echo  ($fet['branch']==$fet_br['branch_name'])?'selected':'';
						echo ">".$fet_br['branch_name']."</option>";
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Designation</label></div>
			<div class="col-md-8"><input type="text" name="designation" class="form-control" placeholder="Designation..." value="<?=$fet['designation']; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Department</label></div>
			<div class="col-md-8"><select class="form-control" name="department">
					<?php 
					while($fet_dpt=mysqli_fetch_array($query_dpt)){
						echo "<option value='".$fet_dpt['dept_id']."'";
						echo  ($fet['department']==$fet_dpt['dept_name'])?'selected':'';
						echo ">".$fet_dpt['dept_name']."</option>";}
						?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Date of joining</label></div>
			<div class="col-md-8"><input type="date" name="joinDate" class="form-control" value="<?=$fet['joinDate']; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Salary</label></div>
			<div class="col-md-8"><input type="number" name="salary" class="form-control" placeholder="Salary (in Rwf)..." value="<?=$fet['salary']; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Assurance</label></div>
			<div class="col-md-8"><input type="number" name="assurance" class="form-control" placeholder="Assurance (in Rwf)..." value="<?=$fet['assurance']; ?>" required/></div>
		</div>
				<div class="form-group">
			<div class="col-md-4"><label>Deductions</label></div>
			<div class="col-md-8"><input type="number" name="deductions" class="form-control" placeholder="Deductions (in Rwf)" value="<?=$fet['deductions']; ?>" ></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Bank Account No</label></div>
			<div class="col-md-8"><input type="number" name="accountNo" class="form-control" placeholder="Bank account number..." value="<?=$fet['BankAccountNo']; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Employee type</label></div>
			<div class="col-md-8">
			<select class="form-control" name="type">
					<option>Admin</option>
					<option>Normal-employee</option>
				</select>
			</div>
		</div>
	</fieldset><br><hr>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="update" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;&nbsp;Save change</a></div>
		</div>
	</form>
</div>
</div>
<?php
}
else{
?>
<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-warning text-center"><br>Ooops! Sorry<hr><h4>Invalid Request</h4></div></div>
<?php
}
?>