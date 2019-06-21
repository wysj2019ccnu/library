<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	//$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}


if(isset($_POST['btn-login2']))
{
    $uname = strip_tags($_POST['txt_uname_email']);
    //$umail = strip_tags($_POST['txt_uname_email']);
    $upass = strip_tags($_POST['txt_password']);
        
    if($login->doLogin2($uname,$upass))
    {
        $login->redirect('home2.php');
    }
    else
    {
        $error = "Wrong Details !";
    }   
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />


<style type="text/css">
body{
    background-color: #66B3FF;
    background-image: url();
}
.signin-form{
   
}
h1{
   color: white;
   margin-left: 600px;
   margin-top: 40px;
}
</style>


</head>
<body>

 
<h1>图书管理系统</h1>
<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Nomal Users</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        Name<input type="text" class="form-control" name="txt_uname_email" placeholder="Username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        Password<input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
      	<br />
            <label>You don't have a account. <a href="sign-up.php">Sign-up</a></label>
      </form>

    </div>
    
</div>














<div class="signin-form">

    <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Administrator</h2><hr />
        
        <div id="error">
        <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
        ?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
        <hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login2" class="btn btn-default">
                    <i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
        <!-- <br />
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label> -->
      </form>

    </div>
    
</div>

</body>
</html>