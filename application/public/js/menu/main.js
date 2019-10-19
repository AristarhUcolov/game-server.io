/*
* @LitePanel
* @Developed by QuickDevel
*/

/* Ошибки, предупреждения... */
function showError(text) {
	var element = $('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>\
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>' + text + '</b></div></td></tr></tbody></table></div></div>').prependTo('.content');
	setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 3000);
}
function showWarning(text) {
		var element = $('<div class="alert alert-warning alert-dismissable"><i class="fa fa-warning"></i>\
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>' + text + '</b></div></td></tr></tbody></table></div></div>').prependTo('.content');
	setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 3000);
}
function showSuccess(text) {
var element = $('<div class="b-preloader-body"><div class="b-preloader-background"></div><div class="lasdjasd21"> <table style="height:60px;"><tbody><tr><td><img style="width: 16px;height: 16px;margin: 20px 3px 20px 17px;" src="/application/public/img/loading.gif"></td> <td id="pre-load-text"> ' + text + '. Подождите, пожалуйста.</td></tr></tbody></table></div></div>').prependTo('#content');
setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 3000);
}

function redirect(url) {
	document.location.href=url;
}

function reloadImage(img) {
	var src = $(img).attr('src');
	$(img).attr('src', src+'?'+Math.random());
};

function reload() {
	window.location.reload();
}

function setNavMode(mode) {
	switch(mode) {
		case "user":
		{
			$('#administratorNavModeBtn').removeClass("active");
			$('#userNavModeBtn').addClass("active");
			$('#administratorNavMode').hide();
			$('#userNavMode').fadeIn(500);
			break;
		}
		case "administrator":
		{
			$('#userNavModeBtn').removeClass("active");
			$('#administratorNavModeBtn').addClass("active");
			$('#userNavMode').hide();
			$('#administratorNavMode').fadeIn(500);
			break;
		}
	}
}
