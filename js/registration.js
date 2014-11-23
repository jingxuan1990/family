(function($){
    $(function(){
        
        $("form button").click(function(e){
            e.preventDefault();
            if(vaild_Registration_From){
                registration();
            }
        });
        
        function registration(){
            var username = $("form input[type='text']").val();
            var password = $("#password1").val();
            
            if(!vaild_Registration_From()){
                return;
            }
            
            $.ajax({
                  type: 'POST',
                  url:  'authentication/registration/register',
                  data: {'username':username, 'password':password},
                  success: function(result){
                      if(result.status){
                          notify = $.notify("Success", result.message, "success");
                          setTimeout(function(){
                              $(notify).hide();
                              window.location.href = 'authentication/login';
                          }, 2000);
                      }else{
                          $.notify("Error", result.message, "error");
                      }
                          
                  },
                  error:function(result){
                      $.notify("Error", "注册时发生错误！", "error");
                  },
                  dataType: 'json'
              });
        }
        
        function vaild_Registration_From(){
            var  username  = $("form input[type='text']").val(),
                 password1 = $("#password1").val(),
                 password2 = $("#password2").val();
            
                 if($.isNotVaild(username)){
                     $.notify("Error", "用户名长度（5-16）不合法！", "error");
                     return false;
                 }else if($.isNotVaild(password1) || $.isNotVaild(password2)){
                     $.notify("Error", "密码长度（5-16）不合法！", "error");
                     return false;
                 }else if(password1 != password2){
                     $.notify("Error", "两次密码输入不一致！", "error");
                     return false;
                 }
            return true;
        }
        
        $("body").on("keyup", function(event){
            if(event.keyCode === 13){
                if(vaild_Registration_From()){
                    registration();
                }
            }
                
        });
        
    });
}(jQuery));