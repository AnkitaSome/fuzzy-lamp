<?php 
include "connection/connection.php";
if(isset($_GET['Did']))
{
$id=$_GET['Did'];
$dsql = "delete from topic_master where bid='$id'";
				$del = mysqli_query($conn,$dsql) ;
				if($del==true)
				{echo "<script>
				alert('Content Deleted');
				location.replace('topic_entry.php');
			</script>";}

 
}

?>