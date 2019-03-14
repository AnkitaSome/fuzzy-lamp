<?php
session_start();
if($_SESSION['lid'] == "")
{
	echo "<script>
		alert('Please Login First.');
		location.replace('login.php');
		</script>";
}
?>