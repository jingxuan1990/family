$(document).ready(function(){
	
	$("form button").click(function(e){
		var username = $("form input[type='text']").val();
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();
		if(isNotVaild(username) || isNotVaild(password1) || isNotVaild(password2)){
			return;
		}
		
		if(password1 != password2){
			return;
		}
		// using ajax request for login in
		$.ajax({
			  type: "POST",
			  url: 'index.php/registration/register',
			  data: {'username':username, 'password':password1},
			  success: function(result){
				  if(result.status){
					  window.location.href = 'index.php/login';
				  }else{
					  loginErrorMessage(result.message);
				  }
					  
			  },
			  error:function(result){
				  loginErrorMessage("用户注册时发生错误！");
			  },
			  dataType: 'json'
			});
	});
	
	$("form input[type='text']").blur(function(e){
		if(isNotVaild($(this).val())){
			$(this).parent().removeClass('has-success');
			$(this).parent().addClass('has-error');
		    $(this).next().text("用户名不合法，请重新输入！");
		}else{
			$(this).parent().removeClass('has-error');
			$(this).parent().addClass('has-success');
			$(this).next().text("");
		}
	});
	
	$("form input[type='password']").blur(function(e){
		
		if(isNotVaild($(this).val())){
			$(this).parent().removeClass('has-success');
			$(this).parent().addClass('has-error');
			$(this).next().text("密码不合法，请重新输入！");
			return;
		}else{
			$(this).parent().removeClass('has-error');
			$(this).parent().addClass('has-success');
			$(this).next().text("");
		}
		var pw_obj  = $("#password1");
		var pw2_obj = $("#password2");
		var password1 = pw_obj.val();
		var password2 = pw2_obj.val();
		if(password1 != password2){
			pw_obj.parent().removeClass('has-success');
			pw2_obj.parent().removeClass('has-success');
			pw_obj.parent().addClass('has-error');
			pw2_obj.parent().addClass('has-error');
			$(this).next().text("两次密码输入不匹配！");
		}else{
			pw_obj.parent().removeClass('has-error');
			pw2_obj.parent().removeClass('has-error');
			pw_obj.parent().addClass('has-success');
			pw2_obj.parent().addClass('has-success');
			pw_obj.next().text("");
			pw2_obj.next().text("");
		}
	});
	
	function isNotVaild(string){
		var len = string.trim().length;
		if(len <= 4 ||  len >=16){
			return true;
		}
	}
	
	function loginErrorMessage(message){
		var html = $.parseHTML("<div class='alert alert-danger' role='alert'>" + message +"</div>");
	    $("#alertTemplate").append(html);
		setTimeout(function(){
			$("#alertTemplate").html("");
		}, 2000);
	}
	
});