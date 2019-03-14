<?php
include "connection/connection.php";
$R = $_GET['R'];
$S = $_GET['S'];
$T = $_GET['T'];

$csql = "select * from like_dislike where topic_id='$R' and login_id='$S'";
$crec = mysqli_query($conn,$csql);
$cnum = mysqli_num_rows($crec);

if($cnum > 0)
{
	$sql = "update like_dislike set like_dislike_status='$T' where topic_id='$R' and login_id='$S'";
}else
{
	$sql = "insert into like_dislike(topic_id,login_id,like_dislike_status) values('$R','$S','$T')";
}
$rec = mysqli_query($conn,$sql);
if($rec)
{
	$nsql = "select * from like_dislike where topic_id='$R' and like_dislike_status='1'";
	$nrec = mysqli_query($conn,$nsql);
	$nnum = mysqli_num_rows($nrec);
	
	$op = $nnum."@".$T."@".$R."@".$S;
	
	echo $op;
}
?>
