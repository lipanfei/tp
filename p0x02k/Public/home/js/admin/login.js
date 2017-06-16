/**
 * 前端登录业务类
*@author signwa
 */

var login = {
	check : function(){
		//获取登录页面中的用户明和密码
		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();

		if(!username){
			dialog.error('用户名不可以为空');
		}

		if(!password){
			dialog.error('密码不可以为空');
		}

		var url = "http://localhost/p0x02k/index.php?m=admin&c=login&a=check";
		var data = {'username' : username, 'password' : password};
		//执行异步请求 $.post
		$.post(url,data,function(result){
			if(result.status == 0){
				return dialog.error(result.message);
			}

			if(result.status ==1){
				return dialog.success(result.message, 'http://localhost/p0x02k/index.php?m=admin&c=index');
			}
		},'json');
	}
}