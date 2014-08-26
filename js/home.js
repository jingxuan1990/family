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
			old_password = $.trim($("#oldPassword").val());
			span_obj = $(this).next();
			if($.trim(old_password) == ''){
				$("#oldPassword").removeClass('has-success');
				$("#oldPassword").addClass('has-error');
				span_obj.text("旧密码不能为空！");
				span_obj.css('color', '#a94442');
				return;
			}else{
				$("#oldPassword").removeClass('has-error');
				$("#oldPassword").addClass('has-success');
				span_obj.text("");
			}
			
			password1 = $.trim($("#password1").val());
			password2 = $.trim($("#password2").val());
			// valiate the form 
			if(isNotVaild(password1)){
				$("#password1").parent().removeClass("has-success");
				$("#password1").parent().addClass("has-error");
				span_obj.text("密码长度必须在4-16字符之间！");
				span_obj.css('color', '#a94442');
				return;
			}else{
				$("#password1").parent().removeClass("has-error");
				$("#password1").parent().addClass("has-success");
				span_obj.text("");
			}
			
			if(isNotVaild(password2)){
				$("#password2").parent().removeClass("has-success");
				$("#password2").parent().addClass("has-error");
				span_obj.text("密码长度必须在4-16字符之间！");
				span_obj.css('color', '#a94442');
				return;
			}else{
				$("#password2").parent().removeClass("has-error");
				$("#password2").parent().addClass("has-success");
				span_obj.text("");
			}
				
			if(password1 != password2){
				$("#password1").removeClass('has-success');
				$("#password2").removeClass('has-success');
				$("#password1").addClass('has-error');
				$("#password2").addClass('has-error');
				span_obj.text("两次密码输入不一致！");
				span_obj.css('color', '#a94442');
				return;
			}else{
				$("#password1").removeClass('has-error');
				$("#password2").removeClass('has-error');
				$("#password1").addClass('has-success');
				$("#password2").addClass('has-success');
				span_obj.text("");
			}
			
			$.ajax({
				type: 'POST',
				url : 'user/update_password',
				data: {'password': password2, 'old_password':old_password},
				success: function(result){
				    span_obj.text(result.message);
				 if(result.status){
					span_obj.css('color', '#3c763d');		        
				 }else{
				    span_obj.css('color', '#a94442');
				 }
				},
				error:function(result){
					span_obj.text("修改密码时发生错误，请稍候重试！");
					span_obj.css('color', '#a94442');
				},
				dataType: 'json'
			});
		});
		
		$("button.btn.btn-primary.btn-block").click(function(){
			var money_obj = $("#money");;
			var span_obj  = money_obj.next();
			if(!$.isNumeric(money_obj.val())){
				money_obj.parent().removeClass('has-success');
				money_obj.parent().addClass('has-error');
				span_obj.text("金额必须非空且是数字！");
				return;
			}else{
				money_obj.parent().removeClass('has-error');
				money_obj.parent().addClass('has-success');
				span_obj.text("");
			}
			
			var desc_obj = $("textarea.form-control");
			var desc_span_obj = desc_obj.next();
			if(desc_obj.val().trim().length > 100){
				desc_obj.parent().removeClass('has-success');
				desc_obj.parent().addClass('has-error');
				desc_span_obj.text("描述信息限制长度为100个字符！");
				return;
			}else{
				desc_obj.parent().removeClass('has-error');
				desc_obj.parent().addClass('has-success');
				desc_span_obj.text("");
			}
			
			var record_span = $(this).next();
			$.ajax({
				type: 'POST',
				url : 'user/add_record',
				data: {'money': money_obj.val(), 'desc':desc_obj.val()},
				success: function(result){
					record_span.text(result.message);
				 if(result.status){
					 record_span.css('color', '#3c763d');
				 }else{
					 record_span.css('color', '#a94442');
				 }
				},
				error:function(result){
					record_span.text("添加记录时发生错误，请重试！");
					record_span.css('color', '#a94442');
				},
				dataType: 'json'
			});
		});
		
		function isNotVaild(string){
			var len = string.trim().length;
			if(len <= 4 ||  len >=16){
				return true;
			}
		}
		
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