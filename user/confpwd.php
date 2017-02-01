<?php
ob_start();
session_start();
include_once('../admin/includes/config.php');


   $userpass =$_POST['passwordc'];
   $userpass1 =md5($userpass );
   $user_id = $_SESSION['id_user'];


   
        $rows = $conn->query("select user_password from os_user where user_password ='$userpass1'   AND id_user='$user_id'") or die(mysql_error());
		//$dfdf=$rows ->fetch_assoc();
//echo $dfdf['user_bednumber'];
/*echo count($rows);
if($rows ->num_rows > 0)
{
  echo "yes";
}
else
{
echo "no";
}

     */
	 if($rows ->num_rows > 0)
{
  echo "good";
}
else
{
echo "please enter correct password";
}
	
	
?>