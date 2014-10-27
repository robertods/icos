var windowFocus = true;
var username;
var alertaHeartbeatCount = 0;
var minAlertaHeartbeat = 1000;
var maxAlertaHeartbeat = 33000;
var alertaHeartbeatTime = minAlertaHeartbeat;
var originalTitle;
var AlertBlinkOrder = 0;

var newAlerts = new Array();
var newAlertsWin = new Array();

function alertasHeartbeat(){

	var itemsfound = 0;
	
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newAlertsWin) {
			if (newAlertsWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= AlertBlinkOrder) {
					document.title = x+' te escribió...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			AlertBlinkOrder = 0;
		} else {
			++AlertBlinkOrder;
		}

	} else {
		for (x in newAlertsWin) {
			newAlertsWin[x] = false;
		}
	}

	for (x in newAlerts) {
		if (newAlerts[x] == true) {
			if (alertaboxFocus[x] == false) {				
				$('#alertabox_'+x+' .alertaboxhead').toggleClass('alertaboxblink');
			}
		}
	}
		
	$.ajax({
	  url: "alertas/alertaheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{

				alert(item.f);
				/*alertaboxtitle = item.f;

				if ($("#alertabox_"+alertaboxtitle).length <= 0) {
					createAlertaBox(alertaboxtitle);
				}
				if ($("#alertabox_"+alertaboxtitle).css('display') == 'none') {
					$("#alertabox_"+alertaboxtitle).css('display','block');
					restructureAlertaBoxes();
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#alertabox_"+alertaboxtitle+" .alertaboxcontent").append('<div class="alertaboxmessage"><span class="alertaboxinfo">'+item.m+'</span></div>');
				} else {
					newAlerts[alertaboxtitle] = true;
					newAlertsWin[alertaboxtitle] = true;
					$("#alertabox_"+alertaboxtitle+" .alertaboxcontent").append('<div class="alertaboxmessage"><span class="alertaboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="alertaboxmessagecontent">'+item.m+'</span></div>');
				}

				$("#alertabox_"+alertaboxtitle+" .alertaboxcontent").scrollTop($("#alertabox_"+alertaboxtitle+" .alertaboxcontent")[0].scrollHeight);
				*/
				itemsfound += 1;
			}
		});

		alertaHeartbeatCount++;

		if (itemsfound > 0) {
			alertaHeartbeatTime = minAlertaHeartbeat;
			alertaHeartbeatCount = 1;
		} else if (alertaHeartbeatCount >= 10) {
			alertaHeartbeatTime *= 2;
			alertaHeartbeatCount = 1;
			if (alertaHeartbeatTime > maxAlertaHeartbeat) {
				alertaHeartbeatTime = maxAlertaHeartbeat;
			}
		}
		
		setTimeout('alertasHeartbeat();',alertaHeartbeatTime);
	}});
	
	
}