<?php
session_start();

include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$topic = $_POST['topic'];
	$cont = $_POST['cont'];
	if($_POST['bid'] != "")
{

	$sql="insert into topic_master(content,loginid,topic_parent) values('$cont','$_SESSION[lid]','$_POST[bid]')";
	
	
}
	else{
	$sql = "insert into topic_master(topic,content,loginid) values('$topic','$cont','$_SESSION[lid]')";
	}
	
	//echo $sql;
	$rec = mysqli_query($conn,$sql);
	
	if($rec == true)
	{
		if($_POST['bid'] != "")
		{
			echo "<script>
				alert('Reply Added');
				location.replace('blog.php');
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
if(isset($_GET['Id']))
{
	$Id = $_GET['Id'];
	$sql="select * from topic_master where bid='$Id'";
	$id_sql=mysqli_query($conn,$sql);
	$id_data=mysqli_fetch_assoc($id_sql);
	
}
?>
<html>
<head>
<title>StudentFeed</title>
<script language="javascript" src="js/all.js"></script>
				<link rel="stylesheet" type="text/css" href="assets/css/style.css" >

</head>

<body>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			 
          
		    
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"> <div class="top_bar">
              <h1>StudentFeed!! </h1>
			  </div>			</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td width="75%" align="left"> <a href="#" > <?php if(@$_SESSION['lid'] != ""){ echo $_SESSION['fname']." ".$_SESSION['lname']; }?>
				</a>          </td>
                <td width="25%" align="right"><?php if(@$_SESSION['lid'] == ""){?><a href="registration.php">Sign Up | </a>  <a href="login.php">Login</a><?php }else{?>
              <a href="topic_entry.php">Topic Entry | </a>  <a href="#" onClick="conf('logout.php')">Logout</a><?php }?></td>
              </tr>
            </table></td>
          </tr>
		  <?php
			  	$fsql = "select * from topic_master where topic_parent='0' order by entry_date";
				$frec = mysqli_query($conn,$fsql);
				$fnum = mysqli_num_rows($frec);
				if($fnum > 0)
				{
			?>
          <tr>
            <td colspan="2" align="center" style="background-color:#E5E5E5"><table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr style="background-color:#FFFFFF">
                <th width="4%" height="30" align="center" scope="col">Sl.</th>
                <th width="23%" align="left" scope="col">Topic</th>
                <th width="61%" align="left" scope="col">Content</th>
                <th width="5%" scope="col">&nbsp;</th>
                <th width="7%" scope="col">&nbsp;</th>
              </tr>
              <?php
			  $i = 1;
			  	while($fres = mysqli_fetch_assoc($frec))
				{
			  ?>
              <tr style="background-color:#FFFFFF">
                <td height="30" align="center" valign="top"><?php echo $i;?></td>
                <td align="left" valign="top"><?php echo $fres['topic'];?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th scope="col">&nbsp;</th>
                    </tr>
					<?php 
					if(@$_SESSION['lid'] != "")
					{
						$lksql = "select * from like_dislike where login_id='$_SESSION[lid]' and topic_id='$fres[bid]'";
						//echo $lksql;
						$lkrec = mysqli_query($conn,$lksql);
						$lknum = mysqli_num_rows($lkrec);
						$lkres = mysqli_fetch_assoc($lkrec);
					?>
                    <tr>
                      <td align="center" id="ld<?php echo $fres['bid'];?>"><?php if($lknum > 0){if($lkres['like_dislike_status'] == 1){?><img src="like_dislike/IMG_20181126_132315.jpg" width="35" height="25"><?php }elseif($lkres['like_dislike_status'] == 0){?><img src="like_dislike/IMG_20181126_132340.jpg" width="35" height="25"><?php } echo " (".$lknum.")";}?></td>
                    </tr>
                    <tr>
                      <td align="center" height="10"></td>
                    </tr>
					
                    <tr>
                      <td align="center"><span id="lk<?php echo $fres['bid'];?>"><?php if($lknum == 0 || $lkres['like_dislike_status'] == 0){?><a href="#" onClick="make_like('<?php echo $fres['bid'];?>','<?php echo @$_SESSION['lid']?>','1')">Like</a><?php }?></span> <span id="sl<?php echo $fres['bid'];?>"><?php if($lknum == 0){?>/<?php }?></span><span id="dl<?php echo $fres['bid'];?>"><?php if($lknum == 0 || $lkres['like_dislike_status'] == 1){?><a href="#" onClick="make_like('<?php echo $fres['bid'];?>','<?php echo @$_SESSION['lid']?>','0')"> Dislike</a><?php }?></span> </td>
                    </tr>
					<?php
					}
					?>
                  </table></td>
                <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="86%"><?php echo $fres['content'];?></td>
                    <td width="14%" align="center"><?php if($fres['topic_image'] == ""){?>&nbsp;<?php }else{?>
                  <img src="content_image/<?php echo $fres['topic_image'];?>" width="57" height="61" />                  <?php }?></td>
                  </tr>
                  <tr>
                    <td height="10" colspan="2"></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<?php
					$rsql = "select * from topic_master tm,registration r where tm.topic_parent='$fres[bid]' and tm.loginid=r.uid order by tm.entry_date";
						//echo $rsql;
					$rrec = mysqli_query($conn,$rsql);
					$rnum = mysqli_num_rows($rrec);
					?>
                      <tr>
                        <td width="48%">&nbsp;</td>
                        <td width="20%" align="center"><?php echo $fres['entry_date'];?></td>
                        <td width="19%" align="center"><a href="#" onClick="showhide('<?php echo $fres['bid'];?>')">View Replies</a> (<?php echo $rnum;?>)</td>
                        <td width="13%" align="center"><a href="topic_entry.php?Id=<?php echo $fres['bid'];?>">Reply</a></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right" style="visibility:hidden" id="sh<?php echo $fres['bid'];?>"><table width="90%" border="0" cellspacing="0" cellpadding="0">
						<input name="tc<?php echo $fres['bid'];?>" id="tc<?php echo $fres['bid'];?>" type="hidden" value="0" />
						<?php
						$c = 1;
						while($rres = mysqli_fetch_assoc($rrec))
						{
						?>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="7%" align="center"><?php echo $c;?></td>
                                <td width="82%"><?php echo $rres['content'];?></td>
                                <td width="11%" align="center"><?php if($rres['topic_image'] == ""){?>&nbsp;<?php }else{?>
                  <img src="content_image/<?php echo $rres['topic_image'];?>" width="44" height="40" />                  <?php }?></td>
                              </tr>
                              
                              <tr>
                                <td align="center">&nbsp;</td>
                                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="48%">&nbsp;</td>
                                    <td width="20%" align="center"><?php echo $rres['entry_date'];?></td>
                                    <td align="center"><?php echo $rres['first_name']." ".$rres['last_name'];?></td>
                                  </tr>
                                  <!--<tr>
                                      <td colspan="3" align="right" style="visibility:hidden">&nbsp;</td>
                                    </tr>-->
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
						  <?php
						  	$c++;
						  }
						  ?>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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
        <td>&nbsp;</td>
      </tr>
    </table></th>
  </tr>
</table>
</body>
</html>
