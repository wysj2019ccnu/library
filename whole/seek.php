<?php  session_start();  $_SESSION['user_id'] = $_SESSION['user_session'];

?>
<!DOCTYPE html >
<html lang="zh-CN">
<head>


	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Title</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>



 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>图书查询与借阅</title>
 <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script>
function submitBtnClick(){document.fileForm.submit();}
$(document).ready(function(){
  $("button").click(function(){
    $("#submitBtn").load("borrow.php",function(){
        alert("Application message has been sent.");
    });
});
});
</script>

 <style type="text/css">
 .chaxun{
 	
 	margin-top: 100px;
 	
 }
 .biaoti1{
 	font-size: 40px;
 	margin-left: 600px;
 	margin-top: 50px;
 }
 .fanhui{
 	margin-left: 950px;
 	margin-top: 3px;
    position: absolute;
 }
 
 .biaoti{
  font-size: 23px;
  color: white;
margin-top: 10px;
margin-left: 20px;
}
.shangmian{
  background-color:#66B3FF;
}

</style>

</head>

<body>
	<nav class="shangmian">
      <div class="container">
        <div class="navbar-header">
          
          <!-- <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a> -->
          <div class="biaoti">
          图书管理系统
        </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html">Back to Article</a></li>
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="geren" ></span ><font color="white">我的空间</font><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="return.php"><span class="glyphicon glyphicon-user"></span>&nbsp;我的图书</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="biaoti1">
		书目检索
	</div>
	<div class="chaxun">
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="1" class="table">
 <td height="27" valign="top" bgcolor="" class="bg_tr">
 <form id="form1" name="form1" method="post" action="" style="margin:0px; padding:0px;">
 <table width="45%" height="42" border="0" align="center" cellpadding="0" cellspacing="0" class="bk">
 <tr>
 <td width="36%" align="center">
 <select name="seltype" id="seltype">
 <option>ISBN</option>
 </select>
 </td>
 <td width="31%" align="center">
 <input type="text" name="coun" id="coun" />
 </td>
 <td width="33%" align="center">
 <input class="btn btn-default" type="submit" value="搜索">
 </td>

<div class="fanhui">
<a class="btn btn-default" href="home.php" role="button">返回主页</a>
</div>

 
 
 </tr>
 </table>
 </form>
 </td>
 </tr>
</table>
<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->

</div>
<?php  error_reporting(E_ALL & ~E_NOTICE); 

class Seek{
 public $isbn;
 public $BookName;
 public $Author;
 public $ISBN;


public function __construct()
{if (isset($_POST["coun"])) {

echo'<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table" >';echo'<tr>';
echo'<td width="24%" height="35" align="center" bgcolor="#FFFFFF">';echo 'BookName';echo'</td>';
echo'<td width="20%" align="center" bgcolor="#FFFFFF">';echo 'Author';echo'</td>';
echo'<td width="15%" align="center" bgcolor="#FFFFFF">';echo 'ISBN';echo'</td>';
echo'<td width="15%" align="center" bgcolor="#FFFFFF">';echo '操作';echo'</td>';
echo'</tr>';

$isbn=$_POST["coun"];
$url="http://isbn.szmesoft.com/isbn/query?isbn=".$isbn;
$data=file_get_contents($url);
$array_data = json_decode($data, true);
$PhotoUrl=$array_data['PhotoUrl'];
//echo '<img align="middle" width="10%" alt="未找到图片" style="" src="http://isbn.szmesoft.com/ISBN/GetBookPhoto?ID='. $array_data['PhotoUrl']  .'">';

echo'<tr align="center"  bgcolor="">';
$BookName=$array_data['BookName'];
echo'<td class="td_bg" width="24%">';echo $BookName;echo'</td>';$Author=$array_data['Author'];
echo'<td class="td_bg" width="20%">';echo $Author;echo'</td>';$ISBN=$array_data['ISBN'];$_SESSION['isbn1']=$array_data['ISBN'];

echo'<td class="td_bg" width="15%">';echo $ISBN;echo'</td>';
echo'<td class="td_bg"  name="fileForm" width="15%">';echo'<button id="submitBtn" onclick="submitBtnClick()" style="background-color:lightblue;" />';echo'Borrow';echo'</button>';
echo'</td>';
echo'</tr>';
} 
}
}
new Seek;




?>

</table>
</body>
</html>


