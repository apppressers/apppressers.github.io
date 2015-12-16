var wp2android_is_ipad = navigator.userAgent.match(/ipad/i) != null;
var wp2android_is_iphone = navigator.userAgent.match(/iphone/i) != null;



//used for developing purpose, to remove the cookie and retry
//jQuery.removeCookie('ml_ios_app_not_redirected');


var ml_ios_app_not_redirected = jQuery.cookie("ml_ios_app_not_redirected");
var present_redirect_alert = ((wp2android_is_ipad || wp2android_is_iphone) && ml_ios_app_not_redirected != 1);
if(present_redirect_alert)
{
	<?php
	echo "var answer = confirm('$ml_popup_message_on_mobile_message');";
	//YES -> redirect
	echo "if(answer) {window.location.href = '$ml_popup_message_on_mobile_url';}";
	//NO -> not displayed for a day
	echo "else { jQuery.cookie('ml_ios_app_not_redirected',1,{expires: 7});}"
	?>
}
