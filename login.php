<?php
	//设置字符编码
	header("Content-type: text/html; charset=utf-8"); 
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//打开sesstion
	session_start();
	if($_GET && $_GET['action']=='login'){
		// PHP对表单提交过来的数据进行验证
		require dirname(__FILE__).'/includes/check.func.php';
		// error_reporting(0);
		$_clean=array();
		$_clean['num']=$_POST['num'];
		$_clean['pass']=_check_pass($_POST['pass'], 6);

		// 到数据库去验证
		$_result=mysql_query("select mb_num, mb_level from mb_user where mb_num='{$_clean['num']}' and mb_pass='{$_clean['pass']}' limit 1");
		$_rows=mysql_fetch_array($_result); 
		if($_rows){
			// 登录成功，记录登录信息
			mysql_query("update mb_user set 
											mb_last_time=NOW(),
											mb_last_ip='{$_SERVER["REMOTE_ADDR"]}',
											mb_login_count=mb_login_count+1
										where
											mb_num='{$_clean['num']}'
						");

			//设置cookie
			// setcookie('num', $_rows['mb_num']);
			// 设置session，要先打开session
			$_SESSION['num']=$_rows['mb_num'];
			if($_rows['mb_level']==1){
				$_SESSION['root']=$_rows['mb_num'];

			};

			mysql_close();
			echo "<script>alert('恭喜，登录成功！');location.href='index.php'</script>";
		}else{
			echo "<script>alert('尚未注册或密码不正确！')</script>";
		};
	};

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<!-- 头部 -->
	<header class="header">
		<div class="header-top">
			<p class="info"><a href="register.php">注册</a><a href="login.php">登录</a></p>
		</div>
		<hgroup>
			<h3>凌晨三点</h3>
			<p>人不能离近了看，就像油画，这个世界美好的人和事物根本不存在。</p>
		</hgroup>
		<nav class="nav">
			<ul class="col-lg-9">
				<a href="index.php"><li>首页</li></a>
				<a href=""><li>前端技术</li></a>
				<a href=""><li>后端技术</li></a>
				<a href=""><li>服务器技术</li></a>
				<a href=""><li>Hybird App</li></a>
				<a href=""><li>微信开发</li></a>
			</ul>
			<div class="search col-lg-3">
				<form action="">
					<input type="text" value="">
					<input type="submit" value="搜索">
				</form>
			</div>
		</nav>
	</header>
	<!-- 注册 -->
	<div class="log"> 
		<div class="log-inner">
			<form action="?action=login" method="post">
				<p>请登录</p>
				<p>账号：<input type="text" name="num" value=""></p>
				<p>密码：<input type="password" name="pass" value=""></p>
				<p><button id="log" type="submit" class="btn btn-default">登录</button</p>
			</form>
		</div>
		
	</div>
</body>
</html>