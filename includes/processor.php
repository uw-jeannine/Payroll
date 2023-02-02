<?php
	session_start();
	require_once "connect.php";
	if (isset($_POST['lookReceiver'])) {
		echo "Search for:<b>". htmlentities($_POST['lookReceiver'])."</b><br>";
		$name = mysqli_real_escape_string($conn,$_POST['lookReceiver']);
		$que=mysqli_query($conn,"SELECT employees.*,branches.branch_name,departments.dept_name FROM employees,branches,departments WHERE (firstname LIKE '%".$name."%' OR lastname LIKE '%".$name."%' OR username LIKE '%".$name."%') AND id!='{$_SESSION['id']}' AND branches.branch_id=employees.branch AND departments.dept_id=employees.department");
		$row=mysqli_num_rows($que);
		if ($row>0 && !empty($name)) {
			while ($res=mysqli_fetch_array($que)) {
				echo "<b class='empty-a text-success choosen' data-uname='".$res['username']."'>".$res['firstname'].'&nbsp;'.$res['lastname'].'('.$res['username'].')</b>&nbsp; | <i class="text-muted">'.$res['designation'].' - Dept.: '.$res['dept_name'].' - '.$res['branch_name'].' Branch</i><br>';
			}
		}
		else{
			echo "No result found";
		}
	}
	if (isset($_POST['search'])) {
		echo "Search for:<b>". htmlentities($_POST['search'])."</b><br>";
		$keyword = mysqli_real_escape_string($conn,$_POST['search']);
		$que=mysqli_query($conn,"SELECT employees.*,branches.branch_name,departments.dept_name FROM employees,branches,departments WHERE (firstname LIKE '%".$keyword."%' OR lastname LIKE '%".$keyword."%' OR username LIKE '%".$keyword."%') AND id!='{$_SESSION['id']}' AND branches.branch_id=employees.branch AND departments.dept_id=employees.department ORDER BY employees.firstname asc");
		$row=mysqli_num_rows($que);
		if ($row>0) {
			echo "<b>".$row."&nbsp;";
			echo ($row>1)?"results":"result";
			echo " found</b>";
			?>
			<table class="table table-bordered table-striped table-hover" id>
		<thead>
			<tr><th>#</th><th>Firstname</th><th>Lastname</th><th>Designation</th><th>Department</th><th>Branch</th><th>Phone</th><th>Account No</th><th>Actions</th></tr>
		</thead>
		<tbody>
		<?php
			$incr=1;
			while ($fet_no=mysqli_fetch_array($que)) {
			echo '<tr><td>'.$incr.'</td><td>'.ucfirst($fet_no['firstname']).'</td><td>'.ucfirst($fet_no['lastname']).'</td><td>'.ucfirst($fet_no['designation']).'</td><td>'.ucfirst($fet_no['dept_name']).'</td><td>'.ucfirst($fet_no['branch_name']).'</td><td>'.$fet_no['phone'].'</td><td>'.$fet_no['BankAccountNo'].'</td><td><a href="employees.php?del='.$fet_no['id'].'"><i class="fa fa-times-circle-o"></i> Delete</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="admin.php?edit='.$fet_no['id'].'"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="employees.php?view='.$fet_no['id'].'"><i class="fa fa-info"></i> Full info</a></td></tr>';
			$incr++;
		}
		?>
	</tbody>
	</table>
					<?php
						
		}
		if ($row==0) {
				echo "<b>No results found</b>";
			}
	}
if (isset($_POST['searchMsg'])) {
		echo "Search for:<b>". htmlentities($_POST['searchMsg'])."</b>";
		$keyword = mysqli_real_escape_string($conn,$_POST['searchMsg']);
		if(isset($_POST['what']) && $_POST['what']=="inbox"){
		$selector = 'messages.receiver';
		$selectWho = 'messages.sender';
		}
		else{
		$selector = 'messages.sender';
		$selectWho = 'messages.receiver';
		}
		$query=mysqli_query($conn,"SELECT * FROM messages,employees WHERE (messages.title LIKE '%$keyword%' OR messages.body LIKE '%".$keyword."%') AND $selector='{$_SESSION['id']}' AND employees.id=$selectWho ORDER BY datetime DESC") or die(mysqli_error($conn));
		if (($rows=mysqli_num_rows($query))>0) {
			echo "<br><b class='text-info'><i class='fa fa-eye'></i>  ".$rows;
			echo ($rows>1)?" results":" result";
			echo " found</b>";
		?>
		<table class="table table-striped table-hover">
		<thead>
			<tr><th style="width:500px">Title</th><th><?=($_POST['what']=='inbox')?'From':'To'; ?></th><th colspan="2">Date</th></tr>
		</thead>
		<tbody>
		<?php
		$incr=1;
		while ($fet=mysqli_fetch_array($query)) {
			echo '<tr ';
			echo ($fet['read_']==0)?'class="success"':'';
			echo '><td> <a href="messages.php?action=in&viewMsg='.$fet['msg_id'].'"> '.$fet['title'].'</a></td><td>'.ucfirst(strtolower($fet['firstname'])).'&nbsp'.$fet['lastname'].'</td><td class="text-muted"><i>'.date('D, d M Y',$fet['datetime']).'</i> </td><td><i class="fa fa-clock-o"></i> '.date('h:m A',$fet['datetime']).'</td></tr>';
			$incr++;
		}
		?>
	</tbody>
	</table>
	<?php
	}
	else{
		echo "<br><span class='text-danger'><i class='fa fa-warning'></i> No result found</span>";
	}
	}
?>