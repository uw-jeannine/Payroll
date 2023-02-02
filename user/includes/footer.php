<div class="row text-center footerr">
	<ul class="col-md-12 list-unstyled list-inline text-right">
<li  <?=(isset($_GET['action']) && $_GET['action']=='Contact')?'class="active" data-title="us"':''; ?>><a style="color:white;" href="./employees.php?action=contact">Contact us</a>&nbsp;&nbsp;|</li>
<li  <?=(isset($_GET['action']) && $_GET['action']=='a')?'class="active" data-title="this software"':''; ?>><a style="color:white;" href="#">About this software</a>&nbsp;&nbsp;|</li>
		
		
		<li><a style="color:white;" href="includes/logout.php">Logout</a></li>
		</ul>
&copy;&nbsp;&nbsp;Rafiki Gentil&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('Y', time()); ?>
</div>
<!--end of includes-->
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.tip').tooltip();
var title=$('.active:last').data('title');
if (title!=null) {
document.title=title;
};
});
</script>
</body>
</html>