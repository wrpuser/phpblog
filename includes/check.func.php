<?php

/**
 * _check_num表示检测并过滤账号
 * @access public 
 * @param string $_string 受污染的账号
 * @param int $_min_num  最小位数
 * @param int $_max_num 最大位数
 * @return string  过滤后的账号 
 */
function _check_num($_string, $_min_num, $_max_num){
	//去掉两边的空格
	$_string = trim($_string);
}

function _check_pass($_pass, $_min_num){
	//密码不得小于6位
	if (strlen($_pass) < $_min_num) {
		echo '<script>alert("密码不得小于'.$_min_num.'位！");</script>';
	}

	//将密码返回
	return md5($_pass);
}

?>