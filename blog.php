<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include "connection/connection.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="1114" height="214" >
  <tr>
    <td width="1104" height="67">Header</td>
  </tr>
  
	 <?php
			  	$fsql = "select bid,topic,content,loginid,first_name,last_name,uid from topic_master ,registration where loginid=uid and topic_parent='0'";
				$frec = mysqli_query($conn,$fsql);
				$fnum = mysqli_num_rows($frec);
				if($fnum > 0)
				{
			?>
          <tr>
		  <td>
	<table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" >
              <tr style="background-color:#CCFFFF">
                <th width="4%" height="30" align="center" scope="col">Sl.</th>
                <th width="15%" align="left" scope="col">Topic</th>
                <th width="34%" align="left" scope="col">Content</th>
				 <th width="23%" align="left" scope="col">SubmittedBy</th>
                <th width="17%" scope="col">View Replies </th>
                <th width="7%" scope="col">Reply</th>
              </tr>
              <?php
			  $i = 1;
			  	while($fres = mysqli_fetch_assoc($frec))
				{
			  ?>
              <tr style="background-color:#FFFFFF">
                <td height="30" align="center"><?php echo $i;?></td>
                <td align="left"><?php echo $fres['topic'];?></td>
                <td align="left"><?php echo $fres['content'];?></td>
				<td align="left"><?php echo $fres['first_name']." ". $fres['last_name'];?></td>
                <td>&nbsp;</td>
                <td align="center"><a href="topic_entry.php?Id=<?php echo $fres['bid'];?>">Reply</a></td>
              </tr>
              <?php
			  $i++;
			  }
			  ?>
            </table>
	</td>
          </tr>
		  <?php
		  }
		  ?>
	
  <tr>
    <td>Footer</td>
  </tr>
</table>
</body>
</html>
