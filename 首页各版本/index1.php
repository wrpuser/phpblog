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



?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>博客首页-非响应式</title>
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
			// error_reporting(0);
			// if(isset($_COOKIE['num'])){ //也可以使用cookie登录，但是退出登录那里使用setcookie('num','',time()-1)清除cookie无效
			if(isset($_SESSION['num'])){
				// $_result=mysql_query("select mb_num from mb_user where mb_num='{$_COOKIE['num']}'");
				$_result=mysql_query("select mb_id, mb_num from mb_user where mb_num='{$_SESSION['num']}'");
				$_rows=mysql_fetch_array($_result);

				echo "<p class='wel'><form class='wel' id='quitfm' action='?action=quit' method='post'><a id='quit' href='###'>退出</a></form></p>";
				echo "<p class='wel'>欢迎你，<span>".$_rows['mb_num']."</span></p>";

				//发表文章
				//form表单提交
				global $_rows, $_id, $_html;
				if($_GET && $_GET['action']=='publish' && $_GET['uid']==$_rows['mb_id']){

					//获取表单提交过来的数据
					$_clean=array();
					$_clean['uid']=$_GET['uid'];
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

					//发表一篇文章，生成对应的ID
					$_id=mysql_insert_id();
					//echo "刚刚插入的数据ID是:".$_id;

					//如果是ajax提交，因为无数新，所以下面这段就会无效
					if(mysql_affected_rows()==1){

						//从数据库读取
						if(isset($_id)){
							
							$_query=mysql_query("select mb_article_id, mb_uid, mb_article_title, mb_article_content, mb_article_time from mb_article where mb_article_id='{$_id}' ");
							$_data=mysql_fetch_array($_query);

							if($_data){
								$_html=array();
								$_html['article_id']=$_data['mb_article_id'];
								$_html['uid']=$_data['mb_uid'];
								$_html['article_title']=$_data['mb_article_title'];
								$_html['article_content']=$_data['mb_article_content'];
								$_html['article_time']=$_data['mb_article_time'];

								//print_r($_html);

							}else{
								echo "<script>alert('没有数据！');</script>";
							}

						}
						mysql_close();
						echo "<script>alert('恭喜，文章发表成功！');</script>";		

					}

				}


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
				<a href=""><li class="active">首页</li></a>
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
			<figure  class="figure">
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>

					<div class="top">
						<a href="article.php?id=<?php echo $_id?>">	
						 <h4><?php echo $_html['article_title'];?></h4>
						 <p><?php echo mb_substr($_html['article_content'], 0, 60, 'utf-8');?></p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li><span>发布</span>：<span><?=$_html['article_time']?></span></li>
							<li><span>阅读</span>：<span>0</span>次</li>
							<li><span>评论</span>：<a href=""><span>0</span>条</a></li>
						</ul>
					</div>							
				</figcaption>
			</figure>	

			<figure  class="figure">
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>					
					<div class="top">
						<a href="">
							<h4>为什么说php是世界上最好的语言</h4>
							<p>php是一门非常简单的后端语言，学习起来比较容易，上手快，但是功能的却十分强大...</p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li><span>发布</span>：<span>2016-10-24</span></li>
							<li><span>阅读</span>：<span>0</span>次</li>
							<li><span>评论</span>：<a href=""><span>0</span>条</a></li>
						</ul>
					</div>							
				</figcaption>
			</figure>

			<figure  class="figure">
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>					
					<div class="top">
						<a href="">
							<h4>为什么说php是世界上最好的语言</h4>
							<p>php是一门非常简单的后端语言，学习起来比较容易，上手快，但是功能的却十分强大...</p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li><span>发布</span>：<span>2016-10-24</span></li>
							<li><span>阅读</span>：<span>0</span>次</li>
							<li><span>评论</span>：<a href=""><span>0</span>条</a></li>
						</ul>
					</div>							
				</figcaption>
			</figure>

			<figure  class="figure">
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>					
					<div class="top">
						<a href="">
							<h4>为什么说php是世界上最好的语言</h4>
							<p>php是一门非常简单的后端语言，学习起来比较容易，上手快，但是功能的却十分强大...</p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li><span>发布</span>：<span>2016-10-24</span></li>
							<li><span>阅读</span>：<span>0</span>次</li>
							<li><span>评论</span>：<a href=""><span>0</span>条</a></li>
						</ul>
					</div>							
				</figcaption>
			</figure>

			<figure  class="figure">
				<div class="img">
					<img src="images/1.png" alt="">
				</div>					
				<figcaption>					
					<div class="top">
						<a href="">
							<h4>为什么说php是世界上最好的语言</h4>
							<p>php是一门非常简单的后端语言，学习起来比较容易，上手快，但是功能的却十分强大...</p>	
						</a>
					</div>							
					<div class="bottom"> 
						<ul>
							<li>发布：<span>2016-10-24</span></li>
							<li>阅读：<span>0</span>次</li>
							<li>评论：<a href=""><span>0</span>条</a></li>
						</ul>
					</div>							
				</figcaption>
			</figure>

		</article>
		<aside class="col-lg-4">
			<section class="right">
				<p>热门内容</p>
				<div class="right-list">
					<a href="article.php?id="><h5>为什么说php是世界上最好的语言...</h5></a>
					<span class="det">阅读：<span>100</span>次</span><span class="det">评论：<a href=""><span>100</span>条</a></span>
				</div>
				<div class="right-list">
					<a href=""><h5>为什么说php是世界上最好的语言...</h5></a>
					<span class="det">阅读：<span>100</span>次</span><span class="det">评论：<a href=""><span>100</span>条</a></span>
				</div>
				<div class="right-list">
					<a href=""><h5>为什么说php是世界上最好的语言...</h5></a>
					<span class="det">阅读：<span>100</span>次</span><span class="det">评论：<a href=""><span>100</span>条</a></span>
				</div>
				<div class="right-list">
					<a href=""><h5>为什么说php是世界上最好的语言...</h5></a>
					<span class="det">阅读：<span>100</span>次</span><span class="det">评论：<a href=""><span>100</span>条</a></span>
				</div>
				<div class="right-list">
					<a href=""><h5>为什么说php是世界上最好的语言...</h5></a>
					<span class="det">阅读：<span>100</span>次</span><span class="det">评论：<a href=""><span>100</span>条</a></span>
				</div>
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
			echo "<form action='?action=publish&uid=".$_rows['mb_id']."' method='post'><p>标题：<input name='title' id='title' type='text' /></p>";
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