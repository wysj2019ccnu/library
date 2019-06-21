<?php  session_start();  $_SESSION['user_id'] = $_SESSION['user_session'];

?>


<!DOCTYPE html>
<html>
<head >
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


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




 <title>还书</title>
  <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

  <style type="text/css">
 .biaoti3{
    font-size: 40px;
    margin-left: 600px;
    margin-top: 50px;
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
.fanhui{
   margin-left: 1100px;
    margin-top: -40px;
    position: absolute;
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



<div class="biaoti3">
    已有书籍
</div>

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table" >
<tr>
 <td width="24%" height="35" align="center" bgcolor="#FFFFFF">BookName</td>
 <td width="20%" align="center" bgcolor="#FFFFFF">ISBN</td>
 <td width="15%" align="center" bgcolor="#FFFFFF">状态</td>
 <td width="15%" align="center" bgcolor="#FFFFFF">操作</td>

 </tr>
 <div class="fanhui">
    <a class="btn btn-default" href="home.php" role="button">返回主页</a>
 </div>

 <?php


error_reporting(E_ALL & ~E_NOTICE); 
      define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PWD', '');
    define('DB_NAME', 'library');

    class DBPDO {
 
        private static $instance;       
        public $dsn;       
        public $dbuser;       
        public $dbpwd;       
        public $sth;       
        public $dbh; 
        public $BookName;
        public $Author;
        public $ISBN;
      
        function __construct() {
            $this->dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
            $this->dbuser = DB_USER;
            $this->dbpwd = DB_PWD;
            $this->connect();
            $this->dbh->query("SET NAMES 'UTF8'");
            $this->dbh->query("SET TIME_ZONE = '+8:00'");
        }
         public function connect() {
            try {
                $this->dbh = new PDO($this->dsn, $this->dbuser, $this->dbpwd);
            }
            catch(PDOException $e) {
                exit('连接失败:'.$e->getMessage());
            }
        }
public function select($sql) {
            $this->sth = $this->dbh->query($sql);
            $this->getPDOError();
            $this->sth->setFetchMode(PDO::FETCH_ASSOC);
            $result = $this->sth->fetchAll();
            $this->sth = null;
            return $result;
        }
 private function getPDOError() {
            if($this->dbh->errorCode() != '00000') {
                $error = $this->dbh->errorInfo();
                exit($error[2]);
            }
        }
 
      
        public function __destruct() {
            $this->dbh = null;
        }
    }
 
  
    $test = new DBPDO;
 
    $sql = "SELECT * FROM `record` where  user_id=".$_SESSION['user_id']." and borrowed='1' ";

 
    $rs = $test->select($sql);


foreach($rs as $val) { 
$url="http://isbn.szmesoft.com/isbn/query?isbn=".$val['isbn'];
$data=file_get_contents($url);
$array_data = json_decode($data, true);$BookName=$array_data['BookName'];

$ISBN=$array_data['ISBN'];
echo '<tr align="center"  > ';
echo'<td class="td_bg" width="24%">';echo $BookName;echo'</td>';
echo'<td class="td_bg" width="20%">';echo $ISBN; echo'</td>';
echo'<td class="td_bg" width="15%">';if ( $val['borrow_checked']=="1") {echo "我已借到";}elseif ($val['borrow_checked']=="0") {echo "借书正在审核";}echo'</td>';
echo'<td class="td_bg"     name="fileForm" width="15%">';
echo " <a href=huanshu.php?isbn=".$val['isbn'].">朕要还书</a>";
echo'</td>';
echo'</tr>';
}



?>



</table>
</body>
</html>



