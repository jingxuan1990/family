(function($){
	$(function(){
		
		// login in the system
		function login(){
			var username = $("form input[type='text']").val();
			var password = $("form input[type='password']").val();
			
			// using ajax request for login in
			$.ajax({
				  type: "POST",
				  url: 'login/user_login',
				  data: {'username':username, 'password':password},
				  success: function(result){
					  if(result.status){
						  notify = $.notify("Success", result.message, "success");
						  setTimeout(function(){
							  $(notify).hide();
							  window.location.href = 'home';
						  }, 2000);
					  }else{
						  $.notify("Error", result.message, "error");
					  }
						  
				  },
				  error:function(result){
					  $.notify("Error", "登录时发生错误！", "error");
				  },
				  dataType: 'json'
				});
		}
		
		$("form button").click(function(){
			if(vaild_Form()){
				login(); 
			}
		});
		
		function vaild_Form(){
			var username = $("form input[type='text']").val();
			var password = $("form input[type='password']").val();
			
			if($.isNotVaild(username)){
				$.notify("Error", "用户名长度（5-16）不合法！", "error");
				return false;
			}
			if($.isNotVaild(password)){
				$.notify("Error", "密码长度（5-16）不合法！", "error");
				return false;
			}
			return true;
		}
		
		$("body").on("keyup", function(event){
			if(event.keyCode === 13){
				if(vaild_Form()){
					login();
				}
			}
				
		});
	});
}(jQuery));