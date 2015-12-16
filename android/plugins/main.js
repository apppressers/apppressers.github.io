function redirectPage() { window.location = linkLocation; }

$(document).ready(function(){
	
	$("body").fadeIn(600);

	$('a').click(function(event) {
    if (this.href == "" || this.href == null) {
      event.preventDefault();
      return;
    }
    if ((this.href.indexOf("#") == -1) && (this.href.indexOf("mailto:") == -1) && (this.href.indexOf("javascript:") == -1) && (this.target != "_blank") && (this.href.indexOf("tel:"))) {
      event.preventDefault();
      linkLocation = this.href;
      $("body").fadeOut(400, redirectPage);
    }
  	});
	
	document.addEventListener("deviceready", onDeviceReady, false);
    function onDeviceReady() { document.addEventListener("backbutton", onBackKeyDown, false); }
    function onBackKeyDown() { navigator.app.exitApp();}
				
});