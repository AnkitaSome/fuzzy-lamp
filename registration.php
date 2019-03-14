<?php

include "connection/connection.php";

if(isset($_POST['Submit_bt']))
{
	$first = $_POST['fname'];
	$last = $_POST['lname'];
	$college_id = $_POST['college_id'];
	$dateofbirth = $_POST['year']."-".$_POST['month']."-".$_POST['dt'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	
	
	$sql = "insert into registration(first_name,last_name,college_id,dob,email,password,confirm_password,contact,address) values('$first','$last','college_id','$dateofbirth','$email','$password','$confirm_password','$contact','$address')";
	//echo $sql;
	$rec = mysqli_query($conn,$sql);
	
	if($rec == true)
	{
		echo "<script>
				alert(' Thank You For Registration! NOw You Can Login');
				location.replace('login.php?');
			</script>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/reg_style.css">

<title>Untitled Document</title>
</head>

<body>
<div class="wrapper">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="3" scope="col"><div class="reg_header"><h1> StudentFeed!! </h1> 
	SignUp below!   </div> </th>
    </tr>
  <div class="reg_form">
  <form method="post" action="">
  
  <tr>
    <td width="13%">&nbsp;</td>
    <td width="68%"><table width="66%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th width="29%" height="30" align="right" valign="middle" scope="col">First Name </th>
        <th width="5%" align="center" scope="col">:</th>
        <th width="66%" align="left" scope="col"><input name="fname" type="text" id="fname" /></th>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">Last Name </td>
        <td align="center">:</td>
        <td align="left"><input name="lname" type="text" id="lname" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">College Id</td>
        <td align="center">:</td>
        <td align="left"><input name="college_id" type="text" id="college_id" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">DOB</td>
        <td align="center">:</td>
        <td align="left"><select name="dt" id="date">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
		   <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
          <option>24</option>
          <option>25</option>
          <option>26</option>
          <option>27</option>
          <option>28</option>
          <option>29</option>
          <option>30</option>
          <option>31</option>
        </select>
          <select name="month" id="month">
            <option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
		    </select>
          <select name="year" id="year">
            <option>1970</option>
			<option>1971</option>
			<option>1972</option>
			<option>1973</option>
			<option>1974</option>
			<option>1975</option>
			<option>1976</option>
			<option>1977</option>
			<option>1978</option>
			<option>1979</option>
			<option>1980</option>
			<option>1981</option>
			<option>1982</option>
			<option>1983</option>
			<option>1984</option>
			<option>1985</option>
			<option>1986</option>
			<option>1987</option>
			<option>1988</option>
			<option>1989</option>
			<option>1990</option>
			<option>1991</option>
			<option>1992</option>
			<option>1993</option>
			<option>1994</option>
			<option>1995</option>
			<option>1996</option>
			<option>1997</option>
			<option>1998</option>
			<option>1999</option>
			<option>2000</option>
			<option>2001</option>
			<option>2002</option>
			<option>2003</option>
			<option>2004</option>
			<option>2005</option>
			<option>2006</option>
			<option>2007</option>
			<option>2008</option>
			<option>2009</option>
			<option>2010</option>
			<option>2011</option>
			<option>2012</option>
			<option>2013</option>
			<option>2014</option>
			<option>2015</option>
			<option>2016</option>
			<option>2017</option>
			<option>2018</option>
          </select>
          </td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">Email</td>
        <td align="center">:</td>
        <td align="left"><input name="email" type="email" id="email" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">Password</td>
        <td align="center">:</td>
        <td align="left"><input name="password" type="password" id="password" /></td>
      </tr>
      <tr>
        <td height="42" align="right" valign="middle">Confirm Password</td>
        <td align="center">:</td>
        <td align="left"><input name="confirm_password" type="password" id="confirm_password" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">Contact</td>
        <td align="center">:</td>
        <td align="left"><input name="contact" type="text" id="contact" /></td>
      </tr>
      <tr>
        <td height="30" align="right" valign="middle">Address</td>
        <td align="center">:</td>
        <td align="left"><input name="address" type="text" id="address" /></td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="top"><input type="submit" name="Submit_bt" value="Submit" /></td>
        </tr>
    </table></td>
    <td width="19%">&nbsp;</td>
  </tr>
  </form>
   </div>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
