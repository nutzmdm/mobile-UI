/*Personnal JS functions
/Including jquery-mobile global configuration override*/

$(document).bind('mobileinit',function(){
   /*$.mobile.selectmenu.prototype.options.nativeMenu = false;*/ /*ne pas activer sinon le reload sur menus déroulants ne fonctionne plus*/
   $.mobile.page.prototype.options.domCache = false;
   $.mobile.ajaxEnabled = false;
   $.mobile.changePage.defaults.reloadPage = false;
});

function getParamValue(param,url)
{
	var u = url == undefined ? document.location.href : url;
	var reg = new RegExp('(\\?|&|^)'+param+'=(.*?)(&|$)');
	matches = u.match(reg);
	return (matches && matches[2] != undefined) ? decodeURIComponent(matches[2]).replace(/\+/g,' ') : '';
}