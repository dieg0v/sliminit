$(function(){
	$('#cookies_accept').click(function(event){
		event.preventDefault();
		App.setCookie();
	})
});

var App = {};
App.cookies = {};

App.setCookie  = function(){
   myDate = new Date();
   myDate.setTime(myDate.getTime()+(App.cookies.days*24*60*60*1000));
   document.cookie = ''+App.cookies.name+'=True; expires=' + myDate.toGMTString()+';path=/';
   $('.cookies-advise').fadeOut();
}
