<?php
	session_start();
	unset($_SESSION['status']);
	unset($_SESSION['id']);
	unset($_SESSION['quickName']);
	unset($_SESSION['type']);
	session_destroy();
	header('location:../../');
?>