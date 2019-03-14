<?php
include "connection/connection.php";

if(isset($_POST['Submit_bt']))
{
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	
	
	$sql = "select * from registration where email='$email'";
	//echo $sql;
	$rec = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($rec);
	if($num > 0)
	{
		$res = mysqli_fetch_assoc($rec);
		if($password == $res['password'])
		{
			session_start();
			$_SESSION['fname'] = $res['first_name'];
			$_SESSION['lname'] = $res['last_name'];
			$_SESSION['lid'] = $res['uid'];

			echo "<script>
				alert('Successfully Logged In');
				location.replace('index.php');
			</script>";
		}else
		{
			echo "<script>
				alert('Wrong Password');
				location.replace('login.php?');
			</script>";
		}
	}else
	{
		echo "<script>
				alert('Wrong Email Address');
				location.replace('login.php?');
			</script>";
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reg_style.css">

</head>

<body>
<div class="wrapper">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col"><div class="reg_header"><h1> StudentFeed!! </h1> 
	LogIn below!   </div>&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <div class="reg_form">
  <form method="post" action="">
  <tr>
    <td>&nbsp;</td>
    <td><table width="66%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td width="29%" height="30" align="right" valign="top">Email</td>
        <td width="5%" align="center">:</td>
        <td width="66%" align="left"><input name="email" type="email" id="email" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="top">Password</td>
        <td align="center">:</td>
        <td align="left"><input name="password" type="password" id="password" /></td>
      </tr>

      <tr>
        <td colspan="3" align="center" valign="top"><input type="submit" name="Submit_bt" value="Login" /></td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  </form>
   </div>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
