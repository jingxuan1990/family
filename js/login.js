$(document).ready(function(){
	// login in the system
	function login(){
		var username = $("form input[type='text']").val();
		var password = $("form input[type='password']").val();
		if(isNotVaild(username) || isNotVaild(password)){
			return;
		}
		// using ajax request for login in
		$.ajax({
			  type: "POST",
			  url: 'login/user_login',
			  data: {'username':username, 'password':password},
			  success: function(result){
				  if(result.status){
					  window.location.href = 'index.php';
				  }else{
					  loginErrorMessage(result.message);
				  }
					  
			  },
			  error:function(result){
				  loginErrorMessage("用户登录时发生错误！");
			  },
			  dataType: 'json'
			});
	}
	
	$("form button").click(function(){
		if(vaild_Form()){
			login(); // click the button for login in
		}
	});
	
	function vaild_Form(){
		$(".form-control:input").each(function(index){
			var message;
			if($(this).attr("type") === "text"){
				message = "用户名长度（5-16）不合法！";
			}else{
				message = "密码长度（5-16）不合法！";
			}
			if(isNotVaild($(this).val())){
				$(this).parent().removeClass('has-success');
				$(this).parent().addClass('has-error');
				$(this).next().text(message);
				return false;
			}else{
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');
				$(this).next().text("");
			}
		});
		return true;
	}
	
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

	$("body").on("keyup", function(event){
		if(event.keyCode === 13){
			if(vaild_Form()){
				login();
			}
		}
			
	});
	
});