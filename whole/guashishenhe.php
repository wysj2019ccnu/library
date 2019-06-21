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
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>欢迎登陆图书管理系统 <?php print($userRow['username']); ?></title>

<style type="text/css">
.biaoti{
  font-size: 23px;
  color: white;
margin-top: 10px;
margin-left: 20px;
}
.shangmian{
  background-color:#66B3FF;
}

.gongneng{
 
  width:750px;
  height: 400px;
  margin-left: 400px;
  background-color:#66B3FF;
}
.zhuye{
  margin-left: 400px;
  margin-top: -550px;
  width:375px; 
  height:70px; 
  text-align: center;
  vertical-align:middle; 
  background-color:#66B3FF;
} 
.zhuye1{
  color: white;
  font-size: 35px;
  margin-top: 10px;
 }

.lianjie{
  width: 375px;
  margin-left: 800px;
  margin-top: -70px;

  font-size: 35px;
  color: black;
  text-align:center;
 }

 .lianjie1{
 
   font-size: 35px;
 }
.haha{
	margin-left: 110px;
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
<div class="haha">
<a class="btn btn-default" href="home2.php" role="button">返回主页</a>
</div>
</body>
</html>



<?php
	header("Content-Type: text/html;charset=utf-8");
 	error_reporting(E_ALL & ~E_NOTICE); 
	session_start();
	$user_id = $_SESSION['user_session'];
	if(empty($user_id)){
		header("Location: sign-up.php");
	}
	require_once 'dbconfig.php';
	$database = new Database();
	$db = $database->dbConnection();
	$act = isset($_GET['act']) ? $_GET['act'] : 'index';
	if($act == 'index'){
		$sql = "select * from record where lost=1";
		$result = $db->query($sql);
		$record_list = $result->fetchAll();
		foreach ($record_list as &$record){
			$url = "http://isbn.szmesoft.com/isbn/query?isbn=".$record['isbn'];
			$book = file_get_contents($url);
			$book = json_decode($book, true);
			$record['bookname'] = isset($book['BookName'])?  $book['BookName'] : '';
			$record['borrow_checked'] = $record['borrow_checked'] == 1 ? '已审核' : '未审核';
			$record['returned'] = $record['returned'] == 1 ? '已还书' : '未还书';
			$record['lost'] = $record['lost'] == 1 ? '已挂失' : '未挂失';
			$record['lost_checked_name'] = $record['lost_checked'] == 1 ? '已审核' : '未审核';
		}
		
	}

	if($act == 'shenhe'){
		$id = $_GET['id'];
		$sql = "update record set lost_checked=1 where id=$id";
		$result = $db->exec($sql);
		if($result !== false){
			echo "<script>alert('审核成功');location.href='guashishenhe.php';</script>";
			die;
		}else{
			echo "<script>alert('审核失败');history.back();</script>";
			die;
		}

	}


	
?>

<!DOCTYPE html>
<html>
<head>
	<title>挂失审核</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
	
		<table class="table table-bordered">
		  <tr>
		  	<th>书名</th>
		  	<th>isbn</th>
		  	<th>借书审核</th>
		  	<th>是否还书</th>
		  	<th>是否挂失</th>
		  	<th>挂失审核</th>
		  	<th>操作</th>
		  </tr>
		  <?php
		  	foreach($record_list as $row){
		  		$str = "<tr>
				  	<td>{$row['bookname']}</td>
				  	<td>{$row['isbn']}</td>
				  	<td>{$row['borrow_checked']}</td>
				  	<td>{$row['returned']}</td>
				  	<td>{$row['lost']}</td>
				  	<td>{$row['lost_checked_name']}</td>";
			  	if($row['lost_checked'] == '1'){
				 	$str .= '<td>已审核</td>';
				}else{
				 	$str .= "<td><a href='guashishenhe.php?act=shenhe&id={$row['id']}'>挂失审核</a></td>";
				}
				$str .= '</tr>'; 
		  		echo $str;
		  	}
		  		
		  	
		  ?>
		</table>
	</div>
	
</body>
</html>