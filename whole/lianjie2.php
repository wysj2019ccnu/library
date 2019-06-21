 <?php

  require_once("session.php");
  
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>




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
.chaxun{
  background-color: white;
  width: 100px;
  height: 30px;
  text-align: center;
  font-size: 20px;
margin-top: -70px;
margin-left: 100px;
}
.huanshu{
background-color: white;
  width: 100px;
  height: 30px;
  text-align: center;
  font-size: 20px;
margin-top: -27px;
margin-left: 320px;
}
.guashi{
background-color: white;
  width: 100px;
  height: 30px;
  text-align: center;
  font-size: 20px;
margin-top: -30px;
margin-left: 530px;
}
 
 .tu1{
  position: absolute;
  
  transform: scale(1.2);
  margin-left: 90px;
  margin-top:110px;
 }
 .tu2{
  position: absolute;
transform: scale(0.6);
  
  margin-top: 55px;
  margin-left: 240px;
 }
 .tu3{
  

transform: scale(0.4);
  margin-left: 390px;
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
        <span class="geren" ></span ><font color="white">&nbsp;你好 <?php echo $userRow['username']; ?>&nbsp;</font><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="return.php"><span class="glyphicon glyphicon-user"></span>&nbsp;我的图书</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
      
    
<div class="container-fluid" style="margin-top:80px;">
  
    <div class="container">
    
      
 <script language =javascript >
var curIndex=0;
//时间间隔(单位毫秒)，每秒钟显示一张，数组共有5张图片放在Photos文件夹下。
var timeInterval=1000;
var arr=new Array();
arr[0]="图片/tu1.jpg";
arr[1]="图片/tu2.jpg";
arr[2]="图片/tu3.jpg";
arr[3]="图片/tu4.jpg";

setInterval(changeImg,timeInterval);
function changeImg()
{
var obj=document.getElementById("obj");
if (curIndex==arr.length-1)
{
curIndex=0;
}
else
{
curIndex+=1;
}
obj.src=arr[curIndex];
}

</script>
<img id="obj" src ="图片/tu1.jpg" width=300 height=550 border =0 >

        
       <div class="zl">
        <div class="zhuye">
        <a href="lianjie2.php"><div class="zhuye1"> 我的功能</div></a> 
      </div>
      <div class="lianjie">
        <a href="home2.php"><div class="gongneng1">审核</div></a>
      </div>
       </div>
        
       <div class="gongneng">
       <div class="tu1">
          <img src="图片/biao1.png" >
        </div>
        <div class="tu2">
          <img src="图片/biao2.png">
        </div>
        <div class="tu3">
          <img src="图片/biao3.png">
        </div>

      <div class="chaxun">
        <a href="seek.php">查询/借阅</a>
      </div>
      <div class="huanshu">
        <a href="return.php">还书</a>
      </div>
      <div class="guashi">
        <a href="guashi.php">挂失</a>
      </div>
</div>
       
       
   
    
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>