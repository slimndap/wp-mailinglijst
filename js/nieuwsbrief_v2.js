// Popup-scherm voor tonen Subscribe/unsubscribe informatie.
// NIEUWE stijl, gecentreerd. 
// Parameters voor lijstnummer, emailadres, achternaam, account
// extra parameter FAST=1 voor snelle inschrijving
// (c) Mailinglijst.nl, 2002-2013

function subscribe(list_ID, emailaddress, lastname, account_ID, fast, lang){
	var stroptions, strURL
	var lngtop, lngleft

	strURL = "http://subscribe.mailinglijst.nl?l=" + list_ID
	if (emailaddress != null) { strURL = strURL + '&e=' + emailaddress }
	if (lastname != null) { strURL = strURL + '&n=' + lastname }
	if (account_ID != null) { strURL = strURL + '&a=' + account_ID }
	if (fast != null) { strURL = strURL + '&fast=' + fast }
	if (lang != null) { strURL = strURL + '&lang=' + lang }

	// Calculate top and left to center the POPUP 
	var lngHeight = 570
	var lngWidth = 640

	wLeft = window.screenLeft ? window.screenLeft : window.screenX;
    	wTop = window.screenTop ? window.screenTop : window.screenY;

    	lngleft = wLeft + (window.innerWidth / 2) - (lngWidth / 2);
    	lngtop = wTop + (window.innerHeight / 2) - (lngHeight / 2);

	// Options
	stroptions= "width=" + lngWidth + ",height=" + lngHeight + ",top=" + lngtop + ",left=" + lngleft + ",scrollbars=1"

	// Open the window
	whandle = window.open(strURL,'nieuwsbrief',stroptions);
	whandle.focus();
}