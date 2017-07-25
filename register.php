<?php 
	//设置字符编码
	header("Content-type: text/html; charset=utf-8"); 
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
	if($_GET && $_GET['action']=='register'){
		// JS对表单数据进行验证
		// echo "<script>alert('提交成功');</script>";

		// PHP对表单提交过来的数据进行验证
		require dirname(__FILE__).'/includes/check.func.php';
		$_clean=array();
		$_clean['num']= $_POST['num'];
		$_clean['pass']= _check_pass($_POST['pass'], 6);

		//在新增之前，要判断账号是否重复
		$_result=mysql_query("select mb_num from mb_user where mb_num='{$_clean['num']}' limit 1");
		if(mysql_fetch_array($_result)){
			echo "<script>alert('对不起，此用户已被注册');history.back();</script>";
			exit;
		};

		//写入数据库
		mysql_query("insert into mb_user( 
										mb_num, 
										mb_pass,
										mb_reg_time
										)
									values(
										'{$_clean['num']}',
										'{$_clean['pass']}',
										NOW()
										)"
					);
		if(mysql_affected_rows()==1){
			mysql_close();
			echo "<script>alert('恭喜，注册成功！');location.href='login.php'</script>";
		};


	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册页面</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/register.js"></script>
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
	<div class="reg"> 
		<div class="reg-inner">
			<form id="fm" action="register.php?action=register" method="post">
				<p>请注册</p>
				<p>账号：<input type="text" name="num" placeholder="请输入账号"></p>
				<p>密码：<input type="password" name="pass" placeholder="请输入密码"></p>
				<p><button type="submit" class="btn btn-default">注册</button</p>
			</form>
		</div>
		
	</div>
</body>
</html>