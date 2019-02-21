$(document).ready(function(){
	// Target your .container, .wrapper, .post, etc.
	 $(".close").click(function(){
		//alert("The paragraph was clicked.");
		$("body.fixed-header .header").css({ 'top' : '0' });
	});
	$(".hidemessage").click(function(){
        $(".pgn-wrapper").hide();
        $("body.fixed-header .header").css({ 'top' : '0' });
    });
	$("#fluid-video").fitVids();
});
function hideNotificationAlert(){
	$('#notification_container').remove();
	$.ajax({
		type: "POST",
		url: site_url+'/dashboard/hide-notification',
		data: 'hide=true',
		cache: false,
		success: function(result){},
		error: function (request, status, error) {}
	});
}