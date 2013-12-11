// NIEUWSBRIEF JAVASCRIPT
// Popup-scherm voor tonen Subscribe/unsubscribe informatie.
// (c) Mailinglijst.nl, 2002
// versie voor ML 3.x dd november 2009

function subscribe(list_ID){
var stroptions, strURL
var lngtop, lngleft

	strURL = "http://www.mailinglijst.nl/nieuwsbrief/subscribe/?l=" + list_ID
	lngtop = 50
	lngleft = 50
	stroptions= "width=400,height=500,top="+lngtop + ",left=" +lngleft + ",scrollbars=1"
	whandle = window.open(strURL,'nieuwsbrief',stroptions);
	whandle.focus();
}
