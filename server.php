<?php
	//判断是否登录了
	/*if(!isset($_COOKIE['num'])){
		echo "<script>alert('请先登录！')</script>";
	}*/

	//设置字符编码
	header("Content-type: text/html; charset=utf-8"); 
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//开启session
	session_start();
	//退出登录
	if($_GET && $_GET['action']=='quit'){
		// setcookie('num','',time()-1);
		unset($_SESSION['num']);
		session_destroy();

	}

	//退出功能，今天是表单方法，明天试一下ajax方法

	//发表文章
	//ajax提交，对应下面的ajax
	/*if($_POST && $_POST['action']=='publish'){

		//获取ajax提交过来的数据
		$_clean=array();
		$_clean['uid']=$_POST['uid'];
		$_clean['title']=$_POST['title'];
		$_clean['content']=$_POST['content'];

		//写入数据库
		mysql_query("insert into mb_article(
											mb_uid,
											mb_article_title,
											mb_article_content,
											mb_article_time
											)
									  values(
											'{$_clean['uid']}',
											'{$_clean['title']}',
											'{$_clean['content']}',
											NOW()
									  	)
				   ");

		// aja无数新，获取不到当前发布文章的ID
		// $_GET['id']=mysql_insert_id();

		// aja无数新，所以下面这段无效
		// if(mysql_affected_rows()==1){
			// mysql_close();
			// echo "<script>alert('恭喜，文章发表成功！');location.href='index.php'</script>";
		// }


	}*/

	//发表文章
	//form表单提交
	global $_rows, $_id, $_html;
	if($_GET && $_GET['action']=='publish'){

		//获取表单提交过来的数据
		$_clean=array();
		$_clean['title']=$_POST['title'];
		$_clean['content']=$_POST['content'];

		//写入数据库
		mysql_query("insert into mb_article(
											mb_article_title,
											mb_article_content,
											mb_article_time
											)
									  values(
											'{$_clean['title']}',
											'{$_clean['content']}',
											NOW()
									  	)
				   ");

		//发表一篇文章，生成对应的ID
		$_id=mysql_insert_id();
		// echo "刚刚插入的数据ID是:".$_id;

		//如果是ajax提交，因为无数新，所以下面这段就会无效
		if(mysql_affected_rows()==1){
			mysql_close();
			echo "<script>alert('恭喜，文章发表成功！');</script>";		

		}

	}	

	

	//从数据库读取	
	/*$_query=mysql_query("select mb_article_id, mb_article_title, mb_article_content, mb_article_time from mb_article order by mb_article_time desc limit 5");
	$_data=mysql_fetch_array($_query);*/

	/*if($_data){

		$_html=array();
		$_html['article_id']=$_data['mb_article_id'];
		$_html['article_title']=$_data['mb_article_title'];
		$_html['article_content']=$_data['mb_article_content'];
		$_html['article_time']=$_data['mb_article_time'];

		print_r($_html);

	}else{
		echo "<script>alert('没有数据！');</script>";
	}*/

	//阅读量
	// mysql_query();

	



?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>服务器技术</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<!-- 头部 -->
	<header class="header">
		<div class="header-top">
			<?php
			// if(isset($_COOKIE['num'])){ //也可以使用cookie登录，但是退出登录那里使用setcookie('num','',time()-1)清除cookie无效
			if(isset($_SESSION['num'])){
				error_reporting(0);
				//引入公共文件
				require dirname(__FILE__).'/includes/common.inc.php';
				// $_result=mysql_query("select mb_num from mb_user where mb_num='{$_COOKIE['num']}'");
				$_result=mysql_query("select mb_id, mb_num from mb_user where mb_num='{$_SESSION['num']}'");
				$_rows=mysql_fetch_array($_result);

				echo "<p class='wel'><form class='wel' id='quitfm' action='?action=quit' method='post'><a id='quit' href='###'>退出</a></form></p>";
				echo "<p class='wel'>欢迎你，<span>".$_rows['mb_num']."</span></p>";


			}else{
				echo "<p class='info'><a href='register.php'>注册</a><a href='login.php'>登录</a></p>";
			}		

			?>
		</div>
		<hgroup>
			<h3>凌晨三点</h3>
			<p>人不能离近了看，就像油画，这个世界美好的人和事物根本不存在。</p>
		</hgroup>
		<nav class="nav">
			<ul class="col-lg-9">
				<a href="index.php"><li>首页</li></a>
				<a href="front_end.php"><li>前端技术</li></a>
				<a href="back_end.php"><li>后端技术</li></a>
				<a href="server.php"><li class="active">服务器技术</li></a>
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
	<!-- 轮播图 -->
	<div id="ad-carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#ad-carousel" data-slide-to="0" class="active"></li>
			<li data-target="#ad-carousel" data-slide-to="1"></li>
			<li data-target="#ad-carousel" data-slide-to="2"></li>
			<li data-target="#ad-carousel" data-slide-to="3"></li>
			<li data-target="#ad-carousel" data-slide-to="4"></li>
		</ol>
		<div class="carousel-inner mycarousel-inner">
			<div class="item active">
            	<img src="images/slider1.jpg" alt="1 slide">

	            <div class="container">
	                <div class="carousel-caption">
	                    
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img src="images/slider1.jpg" alt="2 slide">

	            <div class="container">
	                <div class="carousel-caption">
	                    
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img src="images/slider1.jpg" alt="3 slide">

	            <div class="container">
	                <div class="carousel-caption">
	                    
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img src="images/slider1.jpg" alt="4 slide">

	            <div class="container">
	                <div class="carousel-caption">
	                    
	                </div>
	            </div>
	        </div>
	        <div class="item">
	            <img src="images/slider1.jpg" alt="5 slide">

	            <div class="container">
	                <div class="carousel-caption">
	                    
	                </div>
	            </div>
	        </div>

		</div>
	</div>
	<!-- 内容 -->
	<div class="containter">
		<article class="col-lg-8">

		<?php
		$_query=mysql_query("select mb_article_id, mb_article_title, mb_article_content, mb_article_time, mb_article_readcount from mb_article order by mb_article_time desc limit 5");
		$_html=array();
		while(!!$_data=mysql_fetch_array($_query)){

			$_html['article_id']=$_data['mb_article_id'];
			$_html['article_title']=$_data['mb_article_title'];
			$_html['article_content']=$_data['mb_article_content'];
			$_html['article_time']=$_data['mb_article_time'];
			$_html['article_readcount']=$_data['mb_article_readcount'];
		?>
			<figure  class='figure'>
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>

					<div class="top">
						<a href="article.php?id=<?php echo $_html['article_id']?>">	
						 <h4><?php echo $_html['article_title'];?></h4>
						 <p><?php echo mb_substr($_html['article_content'], 0, 60, 'utf-8');?></p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li><span>发布</span>：<span><?=$_html['article_time']?></span></li>
							<li><span>阅读</span>：<span><?=$_html['article_readcount']?></span>次</li>
							<!-- <li><span>评论</span>：<a href=""><span>0</span>条</a></li> -->
						</ul>
					</div>							
				</figcaption>
			</figure>
		<?php  } ?>				

		</article>
		<aside class="col-lg-4">
			<section class="right">
				<p>热门内容</p>

				<?php
					$_query=mysql_query("select mb_article_id, mb_article_title, mb_article_content, mb_article_time, mb_article_readcount from mb_article order by mb_article_time desc limit 5");
					$_html=array();
					while(!!$_data=mysql_fetch_array($_query)){

						$_html['article_id']=$_data['mb_article_id'];
						$_html['article_title']=$_data['mb_article_title'];
						$_html['article_content']=$_data['mb_article_content'];
						$_html['article_time']=$_data['mb_article_time'];
						$_html['article_readcount']=$_data['mb_article_readcount'];
					?>
				<div class="right-list">
					<a href="article.php?id=<?php echo $_html['article_id']?>"><h5><?= $_html['article_title'];?></h5></a>
					<span class="det">阅读：<span><?=$_html['article_readcount']?></span>次</span><span class="det">评论：<a href=""><span>0</span>条</a></span>
				</div>
				<?php }?>
	
			</section>

			<section class="right">
				<p>标签云</p>
				<div class="right-list">
					<ul class="pre">
						<li>功能</li>
						<li>主题</li>
						<li>插件</li>
						<li>设计</li>
						<li>分享</li>
						<li>生活</li>
					</ul>
				</div>
			</section>
		</aside>
		<?php
		/*if(isset($_SESSION['num'])){
			echo "<hr width='100%'>";
			echo "<p>标题：<input id='title' type='text' /></p>";
			echo "<div class='ubb'>";
				echo "<textarea id='content' cols='100%'' rows='10' placeholder='请在此处发表文章...''></textarea>";
				echo "<p><button id='publish' class='btn btn-default'>发表</button></p>";
			echo "</div>";
		}*/

		if(isset($_SESSION['num'])){
			echo "<hr width='100%'>";
			echo "<form action='?action=publish' method='post'><p>标题：<input name='title' id='title' type='text' /></p>";
			echo "<div class='ubb'>";
				echo "<textarea name='content' id='content' cols='100%'' rows='10' placeholder='请在此处发表文章...'></textarea>";
				echo "<p><button type='submit' id='publish' class='btn btn-default'>发表</button></p>";
			echo "</div></form>";
		}
		
		?>
	</div>
	<footer class="footer">
		<p>copright @2017</p>
	</footer>
	<script>
		$('#quit').click(function(){
			$('#quitfm').submit();
		})


		//ajax提交
		/*$('#publish').click(function(){
			var title=$('#title').val();
			var content=$('#content').val();
			$.ajax({
				url:'index.php',
				type:'post',
				data:{
					action: 'publish',
					uid: '<?php echo $_rows["mb_id"];?>',
					title: title,
					content: content
				},
				success:function(data){
	
					alert('恭喜，文章发表成功！');

					//如果请求当前也页面，回传的数据是当前模板，所以这种情况不在此处获取数据
					// console.log(data.title);
				
				}
			})
		})*/


	</script>

</body>
</html>