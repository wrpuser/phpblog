//等在网页加载完毕再执行
window.onload=function(){

	var fm=document.getElementById('fm');
	fm.onsubmit=function(){
		//能用客户端验证的，尽量用客户端，减少服务器压力
		//账号验证
		if(fm.num.value.length<2 || fm.num.value.length>10){
			alert('账号不得小于2位或大于10位');
			fm.num.value=''; //清空
			fm.num.focus();
			return false;
		}
		if (/[<>\'\"\ ]/.test(fm.num.value)) {
			alert('用户名不得包含非法字符');
			fm.num.value = ''; //清空
			fm.num.focus(); 
			return false;
		}

		//密码验证
		if(fm.pass.value.length<6){
			alert('密码不得小于6位');
			fm.pass.value='';
			fm.pass.focus();
			return false;
		}

		return true;
	}
}