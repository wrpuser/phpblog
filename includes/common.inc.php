<?php
//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','myblog');


if(!mysql_connect(DB_HOST, DB_USER, DB_PWD)){
	exit('数据库连接失败！');
}

if (!mysql_select_db(DB_NAME)) {
	exit('找不到指定的数据库');
}

//写入数据库的中文编码
if (!mysql_query('SET NAMES UTF8')) {
	exit('字符集错误');
}


?>