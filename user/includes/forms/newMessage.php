<?php
if (isset($_GET['to'])) {
		$to = mysqli_fetch_array(mysqli_query($conn,"SELECT id,firstname,lastname,username FROM employees WHERE id='{$_GET['to']}'"));
		if($to){
			$goto=$to['id'];
			$names= $to['firstname'].' '.$to['lastname'];
		}
		else{
			function error(){
				echo '<br><br><div class="col-md-12"><div class="alert alert-danger text-center">Oops! Sorry page not found.<hr><h3><i class="fa fa-warning"></i> Invalid request</h3></div></div>';
			}
			return error();
		}
}
if (isset($_POST['send'])) {
    $receiver = mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM employees WHERE username='{$_POST['to']}'"))['id'];
    if ($receiver) {
        $title = mysqli_real_escape_string($conn,ucfirst($_POST['title']));
        $date = time();
        $body = mysqli_real_escape_string($conn,ucfirst($_POST['body']));
        $sql = "INSERT INTO messages SET title='{$title}', body='{$body}', sender='{$_SESSION['id']}', receiver='{$receiver}', datetime='{$date}'";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if ($query) {
            $message='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Message sent</div>';
            //header('location:./messages.php?action=new');
        }
        else{
            $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>An error occurs</div>';
            //header('location:./messages.php?action=new');
        }
    }
    else{
        $message='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Invalid destination address</div>';
        //header('location:./messages.php?action=new');
    }
}
?>
<div class="row">
	<form class="form-horizontal col-md-8 newMessage" method="post">
		<h4 class="center">New Message</h4><hr>
			<?=(isset($message))?$message:' '; ?>
			<div class="form-group">
				<div class="col-md-4"><label>To</label></div>
				<?php
				if (isset($_GET['to'])) {
				?>
				<div class="col-md-8"><span class="like-input form-control"><?=$names;?></span>
					<input type="hidden" value="<?=$to['username'];?>" name="to"></div>
				<?php
				}
				if (!isset($_GET['to'])) {
				?>
				<div class="col-md-8"><input type="text" name="to" id="receiver" class="form-control" placeholder="To ..." readonly required></div>
				<?php 
				}
				?>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Title</label></div>
				<div class="col-md-8"><input type="text" name="title" id="title" class="form-control" placeholder="Message title..." required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>Message body</label></div>
				<div class="col-md-8">
					<textarea class="form-control" rows="10" name="body" placeholder="Message body ..." required></textarea>
				</div>
			</div>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="send" class="btn btn-success btn-sm"><i class="fa fa-send-o"></i> Send</button></div>
		</div>
	</form>
</div>
<div id="searchReceiver" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Who do you want to send message?</h4>
			</div>
	<div class="modal-body">
		<form role="form" class="form-horizontal">
		<div class="form-group">
			<div class="col-md-4"><Label>Firstname,Lastname or Username</label></div>
			<div class="col-md-8"><input type="text" name="searchName" id="keyName" class="form-control" placeholder="Search by username,firstname or username "/></div>
		</div>
	</form>
		<div class="text-info user-results"></div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	</div>
</div>
	</div>
	</div>