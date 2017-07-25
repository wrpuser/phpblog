<?php 
	//设置字符编码
	header("Content-type: text/html; charset=utf-8"); 
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章页面</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
	<!-- 头部 -->
	<header class="header">
		
		<hgroup>
			<h3>凌晨三点</h3>
			<p>人不能离近了看，就像油画，这个世界美好的人和事物根本不存在。</p>
		</hgroup>
		<nav class="nav">
			<ul class="col-lg-9">
				<a href="index.php"><li>首页</li></a>
				<a href="front_end.php"><li>前端技术</li></a>
				<a href="back_end.php"><li>后端技术</li></a>
				<a href="server.php"><li>服务器技术</li></a>
				<a href="webapp.php"><li>Hybird App</li></a>
				<a href="wexin.php"><li>微信开发</li></a>
			</ul>
			<div class="search col-lg-3">
				<form action="">
					<input type="text" value="">
					<input type="submit" value="搜索">
				</form>
			</div>
		</nav>
	</header>
	<!-- 文章 -->

	<?php
		$_article_id=$_GET['id'];

		$_result=mysql_query("select mb_article_title, mb_article_content from mb_article where mb_article_id='{$_article_id}' limit 1");
		$_rows=mysql_fetch_array($_result);

		if($_rows){
			$_html=array();
			$_html['article_title']=$_rows['mb_article_title'];
			$_html['article_content']=$_rows['mb_article_content'];
		}

		//阅读量
		mysql_query("update mb_article set mb_article_readcount=mb_article_readcount+1 where mb_article_id='{$_article_id}'");
	?>
	<div class="content"> 
		<div class="content-inner">
			<h3><?= $_html['article_title']?></h3>
			<p><?= $_html['article_content']?></p>
		</div>
		
	</div>
	<footer class="footer">
		<p>copright @2017</p>
	</footer>
	<script>
		$('#quit').click(function(){
			$('#quitfm').submit();
		})

	</script>

</body>
</html>