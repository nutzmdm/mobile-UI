/*Personnal JS functions
/Including jquery-mobile global configuration override
*/

$(document).bind('mobileinit',function(){
   $.mobile.selectmenu.prototype.options.nativeMenu = false;
   $.mobile.page.prototype.options.domCache = false;
   $.mobile.ajaxEnabled = true;
   $.mobile.changePage.defaults.reloadPage = true;
});