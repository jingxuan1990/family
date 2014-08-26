/**
 * when the document is on ready, load the js
 */
(function($){
	
	$(function(){
		// stop form dom default event
		$("form").submit(function(event){
			event.preventDefault();
		});
		
		$("button.btn.btn-primary.update_password").click(function(e){
			e.preventDefault();
			
			old_password = $.trim($("#oldPassword").val());
			if($.trim(old_password) == ''){
				$.notify("Error", "旧密码不能为空！", "error");
				return;
			}
			
			password1 = $.trim($("#password1").val());
			password2 = $.trim($("#password2").val());
			// valiate the form 
			if($.isNotVaild(password1) || $.isNotVaild(password2)){
				$.notify("Error", "新密码长度必须在5-16个字符之间！", "error");
				return;
			}
			
			if(password1 != password2){
				$.notify("Error", "两次密码输入不一致！", "error");
				return;
			}
			
			$.ajax({
				type: 'POST',
				url : 'user/update_password',
				data: {'password': password2, 'old_password':old_password},
				success: function(result){
					 if(result.status){
						 $.notify("Success", result.message, "success");
					 }else{
						 $.notify("Error", result.message, "error");
					 }
				},
				error:function(){
					 $.notify("Error", "修改密码时发生错误！", "error");
				},
				dataType: 'json'
			});
		});
		
		$("button.btn.btn-primary.btn-block").click(function(){
			var money = $("#money").val(),
			    desc = $("textarea.form-control").val();
			
			if(!$.isNumeric(money)){
				$.notify("Error", "金额必须非空且是数字！", "error");
				return;
			}
			
			if(desc.trim().length < 10){
				$.notify("Error", "描述信息长度至少为10个字符！", "error");
				return;
			}
			
			if(desc.trim().length > 100){
				$.notify("Error", "描述信息限制长度为100个字符！", "error");
				return;
			}
			
			$.ajax({
				type	: 'POST',
				url 	: 'user/add_record',
				data	: {'money' :  money, 'desc' : desc},
				success : function(result){
							 if(result.status){
								 $.notify("Success", result.message, "success");
							 }else{
								 $.notify("Error", result.message, "error");
							 }
						  },
				error  :  function(result){
							 $.notify("Error", "添加记录时发生错误!", "error");
						  },
			  dataType : 'json'
			});
		});
		
		$("a.btn.btn-primary").each(function(index){
			var add = index === 0 ? 1 : 0;
			$(this).click(function(){
				$.ajax({
					type: 'POST',
					url : 'user/add_or_sub_count/' +　add,
					success: function(result){
						$("span.badge").text(result.count);
					},
					dataType: 'json'
				});
			});
		});
		
		
		$("td.delete").click(function(){
			if(confirm("确定删除该条记录？")){
				var record_id  = $(this).next().val();
				var current_tr = $(this).parent();
				$.ajax({
					type: 'POST',
					url : 'user/delete_record/' +　record_id,
					success: function(result){
						if(result.status){
							current_tr.remove();
						}
					},
					dataType: 'json'
				});
			}
			
		});
	});
}(jQuery));