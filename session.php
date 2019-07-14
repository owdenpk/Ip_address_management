<?php
include('config.php');
session_start();
$user_check=$_SESSION['login_user'];
$ses_sql=mysqli_query($mysqli,"select  username, mem_id  from  users  where  username='$user_check'  ");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$loggedin_session=$row['username'];
$loggedin_id=$row['mem_id'];
if(!isset($loggedin_session)  ||  $loggedin_session==NULL)
{
	header("Location: index.php");
}
?>