<div class="row">
	<div class="col-md-10">
	<form class="form-horizontal newMessage" method="post">
		<h4 class="center">Contact us</h4><hr>
			<?=(isset($message))?$message:' '; ?>

			<div class="form-group">
				<div class="col-md-4"><label>all names</label></div>
				<div class="col-md-8"><input type="text" name="title" id="title" class="form-control" placeholder="your names..." required></div>
			</div>
			

						<div class="form-group">
				<div class="col-md-4"><label>Email adress</label></div>
				<div class="col-md-8"><input type="text" name="title" id="title" class="form-control" placeholder="email..." required></div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label>message</label></div>
				<div class="col-md-8">
					<textarea class="form-control" rows="10" name="body" placeholder="message body ..." required></textarea>
				</div>
			</div>
		<div class="form-group">
			<div class="col-md-2 col-md-push-5"><button type="submit" name="send" class="btn btn-success btn-sm"><i class="fa fa-send-o"></i> Submit</button></div>
		</div>
	</form>
</div>

	<div class="col-md-1">
		<div class="row">
<h4 class="center">Find us on</h4><hr>
......
			
	</div>

	</div>
</div>

