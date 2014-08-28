 (function(window, $){
	 $(function(){
	      PNotify.prototype.options.styling = "bootstrap3";
	      $.extend({
	        notify : function(pnotify_title, pnotify_text, pnotify_type){
	                    new PNotify({
	                      title: pnotify_title,
	                      text : pnotify_text,
	                      type : pnotify_type,
	                      delay: 2000,
	                      stack: false,
	                      before_open: function(PNotify) {
	                       // Position this notice in the center of the screen.
	                        PNotify.get().css({
	                        // "top"  : ($(window).height() / 10) - (PNotify.get().height() / 2),
	                        "top" : 50,
	                        "left" : ($(window).width() / 2) - (PNotify.get().width() / 2)
	                        });
	                      }
	                    });
	                  },
	                  
	       isNotVaild: function(string){
	      				  var len = string.trim().length;
	      				  if(len <= 4 ||  len >=16){
	      					  return true;
	      				  }
	       			   }
	      });
	 });
}(window, jQuery));