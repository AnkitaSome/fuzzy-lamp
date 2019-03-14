<?php 
include "connection/connection.php";
if(isset($_GET['Eid']))
{
$id=$_GET['Eid'];
$sql="select * from topic_master where bid='$id'";
	$id_sql=mysqli_query($conn,$sql);

	$id_data=mysqli_fetch_array($id_sql);
	

	$topic=$id_data['topic'];
	
	$content=$id_data['content'];
	
		
		

}
if(isset($_POST['Edit'])){
echo $_POST['cont'];
echo $_POST['topic'];
$esql="update topic_master set topic='$_POST[topic]' , content='$_POST[cont]' where bid='$id'";

	$edsql=mysqli_query($conn,$esql);
	
	
	if($edsql==true)
				
				{echo "<script>
				alert('Content Updated');
				location.replace('topic_entry.php');
			</script>";}

}

?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form  method="post">
<table width="32%" height="218" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%"><div align="justify">Topic:</div></td>
    <td width="72%"><input name="topic" type="text" id="topic" value="<?php echo $topic;?>"></td>
  </tr>
  <tr>
    <td>Content:</td>
    <td><textarea name="cont" cols="45" rows="5" id="cont" > <?php echo $content;?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Edit" type="submit"  value="Edit"></td>
  </tr>
</table>
</body>
</html>