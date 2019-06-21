
<?php session_start();
error_reporting(E_ALL & ~E_NOTICE); 
$sql_connection = mysqli_connect("localhost", "root", "", "library")or die("error connecting to MySQL database");
if ($_SESSION['user_id']==""){
 echo "<script language=javascript>alert('您还没有登陆');window.location='index.php'</script>";
 exit();
 }else {
 
 $borrowsql="INSERT INTO record(user_id, isbn, borrowed, borrow_checked) values('".$_SESSION['user_id']."','".$_SESSION['isbn1']."', '1','admin')";
 mysqli_query($sql_connection,$borrowsql);
 mysqli_close($sql_connection);}
echo "<script language=javascript>window.location='seek.php';</script>";
?>


