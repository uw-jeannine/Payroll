<?php
$check=mysqli_query($conn,"DELETE FROM employees WHERE id='{$_GET['del']}'");
if ($check) {
	

$query=mysqli_query($conn,"DELETE FROM employees WHERE id='{$_GET['del']}'");
if($query){
	$_SESSION['message']='<div class="alert alert-success col-md-6 col-md-push-3 col-md-pull-3"><a href="#" class="close" data-dismiss="alert">&times;</a>Employee successfully deleted</div>';
	echo "<script type='text/javascript'>window.location='employees.php';</script>";
}
else{
	echo "Failed";
}
}
else{
	echo '<div class="col-md-4 col-md-push-4 empty"><div class="alert alert-success text-center">Ooops! Sorry<hr><h4><br>Invalid request.<br><br></h4></div></div>';
}

?>