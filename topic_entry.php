<?php
include "chk_login.php";

include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$topic = $_POST['topic'];
	$cont = $_POST['cont'];
	$today = date('Y-m-d');
	
	$content_image = trim($_FILES['cimg']['name']);
	//echo $content_image;
	if($_POST['Submit'] == "Submit" )
	{
		if($_POST['bid'] != "")
		{
			$sql="insert into topic_master(content,loginid,topic_parent,entry_date) values('$cont','$_SESSION[lid]','$_POST[bid]','$today')";
		}
		else{
		$sql = "insert into topic_master(topic,content,loginid,entry_date) values('$topic','$cont','$_SESSION[lid]','$today')";
		}
		
		//echo $sql;
		$rec = mysqli_query($conn,$sql);
		$pk = mysqli_insert_id($conn);
		//echo $pk;exit;
		list($n,$x) = explode(".",@$content_image);
		$new_content_image = $pk.".".$x;
		if($content_image != "")
		{
			if(move_uploaded_file($_FILES['cimg']['tmp_name'],"content_image/".$new_content_image))
			{
				$usql = "update topic_master set topic_image='$new_content_image' where bid='$pk'";
				$urec = mysqli_query($conn,$usql);
			}
			if($rec && @$urec)
			{
				if($_POST['bid'] != "")
				{
					echo "<script>
						alert('Reply Added');
						location.replace('index.php');
					</script>";
				}else
				{
					echo "<script>
							alert('Topic Added');
							location.replace('topic_entry.php?')
						</script>";
				}
			}
		}else
		{
			if($rec)
			{
				if($_POST['bid'] != "")
				{
					echo "<script>
						alert('Reply Added');
						location.replace('index.php');
					</script>";
				}else
				{
					echo "<script>
							alert('Topic Added');
							location.replace('topic_entry.php?')
						</script>";
				}
			}
		}
	}elseif($_POST['Submit'] == "Update")
	{
	
		$id = $_POST['bid'];
		
		
		$esql="update topic_master set topic='$topic' , content='$cont' where bid='$id'";
		$edsql=mysqli_query($conn,$esql);
		//echo $pk;exit;
		list($n,$x) = explode(".",@$content_image);
		$new_content_image = $id.".".$x;
		if($content_image != "")
		{
			if(move_uploaded_file($_FILES['cimg']['tmp_name'],"content_image/".$new_content_image))
			{
				$usql = "update topic_master set topic_image='$new_content_image' where bid='$id'";
				$urec = mysqli_query($conn,$usql);
			}
		if($edsql==true || @$urec==true)
				
				{echo "<script>
				alert('Content Updated');
				location.replace('topic_entry.php');
			</script>";}
			}
	}
}
if(isset($_GET['Id']))
{
	$Id = $_GET['Id'];
	$sql="select * from topic_master where bid='$Id'";
	$id_sql=mysqli_query($conn,$sql);
	$id_data=mysqli_fetch_assoc($id_sql);
	
}
if(isset($_GET['Eid']))
{
	$Id = $_GET['Eid'];
	$sql="select * from topic_master where bid='$Id'";
	$e_sql=mysqli_query($conn,$sql);
	$e_data=mysqli_fetch_assoc($e_sql);
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" src="js/all.js"></script>
				<link rel="stylesheet" type="text/css" href="assets/css/topic_style.css" >

                <style type="text/css">
<!--
.style3 {color: #000033}
-->
                </style>
</head>

<body>
<div class="wrapper">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th colspan="2" align="left" scope="col">&nbsp;  <div class="top_bar">
            <div class="top_bar">  <h1>StudentFeed!! </h1>
			</div>
			  </div>	</th>
        </tr>
      <tr>
        <th align="left" scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
      </tr>
      <tr>
        <th align="left" scope="col">&nbsp; <a href="#"> <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?> </a></th>
        <th align="right" valign="top" scope="col"><a href="index.php">Home</a> |<a href="#" onclick="conf('logout.php')">Logout</a></th>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><?php if(isset($_GET['Id'])){echo "Topic Reply";}else{echo "Topic Entry";}?></td>
              </tr>
              <tr>
                <td align="center">
				 <div class="t1"> 
				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <table width="79%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%" height="30" align="right" valign="top" scope="col">Topic</th>
                      <th width="5%" align="center" valign="top" scope="col">:</th>
                      <th width="55%" align="left" scope="col"><input name="topic" type="text" id="topic" <?php if(isset($_GET['Id'])){ echo "value=".$id_data['topic']." readonly" ;}elseif(isset($_GET['Eid'])){echo "value=".$e_data['topic'];} ?> />
                          <input name="bid" type="text" id="bid" value="<?php if(isset($_GET['Id'])){echo @$_GET['Id'];}elseif(isset($_GET['Eid'])){echo @$_GET['Eid'];}?>" />                      </th>
                    </tr>
                    <tr>
                      <td height="30" align="right" valign="top">Content</td>
                      <td align="center" valign="top">:</td>
                      <td align="left"><textarea name="cont" cols="45" rows="5" id="cont"><?php if(isset($_GET['Eid'])){echo $e_data['content'];}?></textarea></td>
                    </tr>
                    <tr>
                      <td height="30" align="right">Content Image </td>
                      <td align="center">:</td>
                      <td align="left"><input name="cimg" type="file" id="cimg" /></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="3" align="center"><input type="submit" name="Submit" <?php if(isset($_GET['Eid'])){echo "value='Update'";}else{?>value="Submit"<?php }?> /></td>
                      </tr>
                  </table>
                </form>
				</div></td>
              </tr>
            </table></th>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php
			  	$fsql = "select * from topic_master where loginid='$_SESSION[lid]'";
				$frec = mysqli_query($conn,$fsql);
				$fnum = mysqli_num_rows($frec);
				if($fnum > 0)
				{
			?>
          <tr>
            <td align="center" style="background-color:#E5E5E5"><table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr style="background-color:#FFFFFF">
                <th width="7%" height="30" align="center" scope="col"><span class="style3">Sl</span>.</th>
                <th width="24%" align="left" scope="col"><span class="style3">Topic</span></th>
                <th width="39%" align="left" scope="col"><span class="style3">Content</span></th>
                <th width="13%" align="center" scope="col"><span class="style3">Image</span></th>
                <th width="10%" scope="col">&nbsp;</th>
                <th width="7%" scope="col">&nbsp;</th>
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
                <td align="center"><?php if($fres['topic_image'] == ""){?>&nbsp;<?php }else{?><img src="content_image/<?php echo $fres['topic_image'];?>" width="73" height="69" /><?php }?></td>
                <td><a href="delete.php?Did=<?php echo $fres['bid'];?>">Delete</a></td>
                <td><a href="topic_entry.php?Eid=<?php echo $fres['bid'];?>">Edit</a></td>
              </tr>
              <?php
			  $i++;
			  }
			  ?>
            </table></td>
          </tr>
		  <?php
		  }
		  ?>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></th>
  </tr>
</table>
</div>

</body>
</html>
