<?php session_start();error_reporting(E_ALL & ~E_NOTICE); 
$isbn=$_GET["isbn"];
echo "<script language=javascript>alert('还书成功了');</script>";
$sql_connection = mysqli_connect("localhost", "root", "", "library")or die("error connecting to MySQL database");
if ($_SESSION['user_id']==""){
echo "<script language=javascript>alert('您还没有登陆');window.location='index.php'</script>";exit();}else{


$returnsql="UPDATE record SET borrowed='admin',borrow_checked='admin',returned='1' where isbn='$isbn'and user_id= '".$_SESSION['user_id']."' ";
mysqli_query($sql_connection,$returnsql) ;
mysqli_close($sql_connection);}
echo "<script language=javascript>window.location='return.php';</script>";
 ?>