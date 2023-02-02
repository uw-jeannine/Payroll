<?php
$query_br = mysqli_query($conn,"SELECT branch_id,branch_name FROM branches") or die(mysqli_error($conn));
$query_dpt = mysqli_query($conn,"SELECT dept_id,dept_name FROM departments");
if (isset($_POST['save'])) {
    $fname = mysqli_real_escape_string($conn,strtoupper($_POST['firstname']));
    $lname = mysqli_real_escape_string($conn,ucfirst(strtolower($_POST['lastname'])));
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
    $username = mysqli_real_escape_string($conn,$_POST['user']);
    $pass = mysqli_real_escape_string($conn,sha1($_POST['pass']));
    $pic = $_FILES['picture'];
    $ext = explode('/',$_FILES['picture']['type']);
    $imageType=['image/jpg','image/jpeg','image/bmp','image/png'];
    $extension = $ext[count($ext)-1];
    $check_acc = mysqli_query($conn,"SELECT BankAccountNo FROM employees WHERE BankAccountNo='{$accountNo}'");
	$check_email = mysqli_query($conn,"SELECT username FROM employees WHERE username='{$username}'");
	$check_phone = mysqli_query($conn,"SELECT phone FROM employees WHERE phone='{$phone}'");
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
		if(in_array($extension, $imageType)){
			$errors[]="* Invalid picture format(must be jpg,png or bmp)";
		}
    if (count($errors)<=0) {
	    move_uploaded_file($pic['tmp_name'], './employees_pictures/'.$pic_name=$fname.$lname.time().'.'.$extension);
	    $sql = "INSERT INTO employees SET firstname='{$fname}', lastname='{$lname}', gender='{$gender}', dateOfBirth='{$dob}', phone='{$phone}', address='{$address}', branch='{$branch}', designation='{$designation}', department='{$dept}', joinDate='{$joinDate}', salary='{$salary}', assurance='{$assurance}', deductions='{$deductions}', BankAccountNo='{$accountNo}', type='{$type}', username='{$username}', password='{$pass}',picture='{$pic_name}'";
	    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	    if ($query) {
	        $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>An employee saved successfully</div>';
	       echo '<script type="">window.location="./employees.php";</script>';
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
<div class="col-md-12" data-title="Add new employee"><h4 class="center">Add new employee</h4><hr>
	<form class="form-horizontal col-md-6 col-md-push-3 col-md-pull-3" id="updateEmployee" method="post" enctype="multipart/form-data">
		<?=(isset($message))?$message:''; ?>
		<fieldset>
			<legend>Personal information</legend>
			<div class="form-group">
				<div class="col-md-4"><label>Names</label></div>
				<div class="col-md-4"><input type="text" name="firstname" class="form-control" placeholder="Firstname..." value="<?=(isset($status))?$_POST['firstname']:''; ?>" required/></div>
				<div class="col-md-4"><input type="text" name="lastname" class="form-control" placeholder="Lastname..." value="<?=(isset($status))?$_POST['lastname']:''; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Date of birth</label></div>
				<div class="col-md-8"><input type="date" name="dob" class="form-control" placeholder="DD/MM/YYYY" value="<?=(isset($status))?$_POST['dob']:''; ?>" required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Gender</label></div>
				<div class="col-md-8">
					<select name="gender" class="form-control">
						<option id="OK" value="Male" >Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Telephone No</label></div>
				<div class="col-md-8"><input type="number" name="phone" class="form-control" placeholder="Telephone No..." value="<?=(isset($status))?$_POST['phone']:''; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Email</label></div>
				<div class="col-md-8"><input type="email" name="user" class="form-control" placeholder="Email..." value="<?=(isset($status))?$_POST['user']:''; ?>"required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Address</label></div>
				<div class="col-md-8"><input type="text" name="address" class="form-control" placeholder="Address..." value="<?=(isset($status))?$_POST['address']:''; ?>" required/></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Photo</label></div>
				<div class="col-md-8"><input type="file" name="picture" class="form-control" placeholder="Address..." value="<?=(isset($status))?$_FILES['picture']['name']:''; ?>" required/></div>
			</div>
		</fieldset>
		
		<fieldset>
			<legend>Professional information</legend>
		<div class="form-group">
			<div class="col-md-4"><label>Branch</label></div>
			<div class="col-md-8">
				<select class="form-control" name="branch">
					<?php while($fet_br=mysqli_fetch_array($query_br)){
						echo "<option value='".$fet_br['branch_id']."'>".$fet_br['branch_name']."</option>";}?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Designation</label></div>
			<div class="col-md-8"><input type="text" name="designation" class="form-control" placeholder="Designation..." value="<?=(isset($status))?$_POST['designation']:''; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Department</label></div>
			<div class="col-md-8"><select class="form-control" name="department">
					<?php 
					while($fet_dpt=mysqli_fetch_array($query_dpt)){
						echo "<option value='".$fet_dpt['dept_id']."'>".$fet_dpt['dept_name']."</option>";}
						?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Date of joining</label></div>
			<div class="col-md-8"><input type="date" name="joinDate" class="form-control" value="<?=(isset($status))?$_POST['joinDate']:''; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Salary</label></div>
			<div class="col-md-8"><input type="number" name="salary" class="form-control" placeholder="Salary (in Rwf)..." value="<?=(isset($status))?$_POST['salary']:''; ?>" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Assurance</label></div>
			<div class="col-md-8"><input type="number" name="assurance" class="form-control" placeholder="Assurance (in Rwf)..." value="<?=(isset($status))?$_POST['assurance']:''; ?>" required/></div>
		</div>
				<div class="form-group">
			<div class="col-md-4"><label>Deductions</label></div>
			<div class="col-md-8"><input type="number" name="deductions" class="form-control" placeholder="Deductions (in Rwf)" value="<?=(isset($status))?$_POST['deductions']:''; ?>"></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Bank Account No</label></div>
			<div class="col-md-8"><input type="number" name="accountNo" class="form-control" placeholder="Bank account number..." value="<?=(isset($status))?$_POST['accountNo']:''; ?>" required/></div>
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
	</fieldset>
	<fieldset>
		<legend>Login Password</legend>
		<div class="form-group">
			<div class="col-md-4"><label>Password</label></div>
			<div class="col-md-8"><input type="password" name="pass" class="form-control" placeholder="Password..." id="password" required/></div>
		</div>
		<div class="form-group">
			<div class="col-md-4"><label>Re-enter Password</label></div>
			<div class="col-md-8"><input type="password" name="confirm_password" class="form-control" placeholder="Re enter password..." required/></div>
		</div>
	</fieldset>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="save" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp; Save</button></div>
		</div>
	</form>
</div>
</div>