<div class="row pay-table">
	<div class="col-md-12 text-center pay-h">
		<h4> Employees payments <small> <label>Today</label> <?=date('D, d M Y', time()); ?> <label class='text-success'>Payment date</label></small><hr></h4>
	</div>


	<img src="images/log.jpg" width="8%">
	MSGR.FELICIEN MUBILIGI TVET</br>
	HUYE DISTRICT</br>

	Account No:( 1234567890 )    BANK OF KIGALI, HUYE BRANCH


	<div class="col-md-12 text-center to-be-paid">
		<?php
		$query = mysqli_query($conn,"SELECT * FROM employees,branches,departments WHERE branches.branch_id=employees.branch AND  departments.dept_id=employees.department AND employees.type!='Admin' ORDER BY firstname");
		$rows = mysqli_num_rows($query);
		if ($rows>0) {
			$incr=1;
			$total=0;
		?>
		<table class="table table-bordered table-hover table-collapse text-left payments">
			<thead><th>#</th><th><i class="fa fa-credit-card"></i> Account N<sup>o</sup></th><th><i class="fa fa-money"></i> Net salary</th><th><i class="fa fa-user"></i> Names</th><th><i class="fa fa-phone"></i> Phone</th><th><i class="fa fa-map-o"></i> Address</th></thead>
			<tbody>
			<?php
			while ($fet=mysqli_fetch_array($query)) {
				$que_fines = mysqli_query($conn,"SELECT * FROM penalties WHERE penalty_to='{$fet['id']}'");
				if (mysqli_num_rows($que_fines)) {
					$fines=0;
					while($fet_fines=mysqli_fetch_array($que_fines)){
						$fines=$fines+$fet_fines['fines'];
					}
				}
				else{
					$fines=0;
				}			
				$net_salary = $fet['salary']-($fines+$fet['assurance']+$fet['deductions']);
				echo '<tr><td>'.$incr.'</td><td class="acc">'.$fet['BankAccountNo'].'</td><td class="acc"> <i class="text-muted">Rwf</i> '.$net_salary.'</td><td><a href="#" data-what="payment'.$fet['id'].'" class="viewPay name" data-placement="right" title="View payment history of '.$fet['lastname'] .'">'.$fet['firstname'].' '.$fet['lastname'].'</a></td><td>'.$fet['phone'].'</td><td>'.$fet['address'].'</td></tr>';
				$incr++;
				?>
				<div id="payment<?=$fet['id'];?>" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?=$fet['firstname'].' '.$fet['lastname'];?> payment history</h4>
										</div>
										<div class="modal-body text-left  payment-view">
											<div class="well col-md-12">
												<div class="col-md-4"><img width="100%" src="./employees_pictures/<?=$fet['picture'];?>"></div>
												<div class="col-md-8">
													<label>Account N<sup>o</sup></label>  <i><?=$fet['BankAccountNo'];?></i><br>
													<label>Names</label>  <i><?=$fet['firstname'].' '.$fet['lastname'];?></i><br>
													<label>Branch</label>  <i><?=$fet['branch_name'];?></i><br>
													<label>Department</label>  <i><?=$fet['dept_name'];?></i>											
												</div>
											</div>
											<div class="well">
											<label>Salary</label>  <i><b>Rwf</b> <?=$fet['salary'];?></i><br>
											<label class="text-info">Assurance</label>  <i><b>Rwf</b> <?=$fet['assurance'];?></i><br>
											<label class="text-info">Other deductions</label>  <i><b>Rwf</b> <?=$fet['deductions'];?></i><br>
											<label class="text-danger">Total fines</label>  <i><b>Rwf</b> <?=$fines;?></i><br>
											<span class="salary text-success"><label>Net salary</label>  <i><b>Rwf</b> <?=($fet['salary']-($fines+$fet['assurance']+$fet['deductions']));?></i><span><br>										
											</div>
										</div>
									</div>
								</div>
				</div>
			<?php
				$total=$total+$net_salary;
			}
				echo '<tr class="total"><td  class="text-center" colspan="2">Total</td><td colspan="4">Rwf '.$total .'</td></tr>';
			?>
			</tbody>
		</table>
		<?php	
		}
		?>

	</div>
	if
	
	<div class="col-md-12 text-right">
		<?php
		$pay_date=(mysqli_fetch_array(mysqli_query($conn,"SELECT payment_date FROM payments"))[0]);
		$month_start=$pay_date-2592000;
		if ((time()-$month_start)>=2592000) {
		echo '<button class="btn btn-default command-pay">Pay employees & Print their list to Bank</button>';
		}
		else{
			$days= (int) (($pay_date-time())/86400 ) ;
			$hours=(int) ((($pay_date-time())%86400 )/3600);
			echo '<h5 class="timer"><i class="fa fa-hourglass-half"></i> '; 
			echo ($days>0)?$days:'';
			if($days>0) echo ($days>1)?' days':' day';
			echo ($hours>0 && $days>0)?' and ':'';
			echo ($hours>0)?$hours:'';
			if($hours>0) echo ($hours>1)?' hours':' hour';
			echo ' left to pay employees</h5>';
		}
		?>
	</div>
</div>