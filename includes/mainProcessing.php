<?php
if (isset($_POST['save'])) {
    $fname = mysqli_real_escape_string($conn,strtoupper($_POST['firstname']));
    $lname = mysqli_real_escape_string($conn,ucfirst($_POST['lastname']));
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,ucfirst($_POST['address']));
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $branch = mysqli_real_escape_string($conn,ucfirst($_POST['branch']));
    $designation = mysqli_real_escape_string($conn,ucfirst($_POST['designation']));
    $dept = mysqli_real_escape_string($conn,ucfirst($_POST['department']));
    $joinDate = mysqli_real_escape_string($conn,$_POST['joinDate']);
    $salary = mysqli_real_escape_string($conn,$_POST['salary']);
    $assurance = mysqli_real_escape_string($conn,$_POST['assurance']);
    $accountNo = mysqli_real_escape_string($conn,$_POST['accountNo']);
    $type = mysqli_real_escape_string($conn,ucfirst($_POST['type']));
    $emp_id = $fname.time();
    $username = mysqli_real_escape_string($conn,$_POST['user']);
    $pass = mysqli_real_escape_string($conn,sha1($_POST['pass']));
    $pic = $_FILES['picture'];
    $ext = explode('/',$_FILES['picture']['type']);
    $extension = $ext[count($ext)-1];
    move_uploaded_file($pic['tmp_name'], './employees_pictures/'.$pic_name=$fname.$lname.time().'.'.$extension);
    $sql = "INSERT INTO employees SET firstname='{$fname}', lastname='{$lname}', gender='{$gender}', dateOfBirth='{$dob}', phone='{$phone}', address='{$address}', branch='{$branch}', designation='{$designation}', department='{$dept}', joinDate='{$joinDate}', salary='{$salary}', assurance='{$assurance}', BankAccountNo='{$accountNo}', type='{$type}', empl_ID='{$emp_id}', username='{$username}', password='{$pass}',picture='{$pic_name}'";
    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if ($query) {
        $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>An employee saved successfully</div>';
        header($_SERVER['REQUEST_URI']);
    }
    else{
        $_SESSION['message']='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Error</div>';
        header('Location:./employees.php?action=addEmployee');
    }
}
?>
<?php
if (isset($_POST['send'])) {
    $receiver = mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM employees WHERE username='{$_POST['to']}'"))['id'];
    if ($receiver) {
        $title = mysqli_real_escape_string($conn,ucfirst($_POST['title']));
        $date = time();
        $body = mysqli_real_escape_string($conn,ucfirst($_POST['body']));
        $sql = "INSERT INTO messages SET title='{$title}', body='{$body}', sender='{$_SESSION['id']}', receiver='{$receiver}', datetime='{$date}'";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if ($query) {
            $_SESSION['message']='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Message sent</div>';
            header('location:./messages.php?action=new');
        }
        else{
            $_SESSION['message']='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
            header('location:./messages.php?action=new');
        }
    }
    else{
        $_SESSION['message']='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Invalid destination address</div>';
        header('location:./messages.php?action=new');
    }
}
?>