/* ============================================================
 * Plugin Core Init
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */

'use strict';

$(document).ready(function () {

    $('#start_tour').click(function () {
        $("#notifications").velocity("scroll", {
            duration: 800
        });
    })
});
$('#contactSubmitForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'contact-us',
        data: $('#contactSubmitForm').serialize(),
        cache: false,
        success: function (result) {
            //$('#'+_id).removeAttr('disabled');
            grecaptcha.reset();
            try {
                result = JSON.parse(result);
            } catch (e) {
                swal('Error!', "Request couldn't complete at this time. wrong response received.Please try again later. Thank you.", 'error');
                return false;
            }

            var html = '';
            var message = 'Email has been sent successfully!';
            $('#contactSubmitForm')[0].reset();
            html = '<div class="alert alert-success errordivMain" id="errordiv">' +
                '<span onclick="hideErrorDiv()" class="pull-right" style="color:#933432;font-size: 20px;line-height: 15px; cursor: pointer;" >×</span>' +
                message +
                '</div>';

            $('#response_div').html(html);
        },
        error: function (response, status, error) {
            var errorMessage = '';
            var errors = JSON.parse(response.responseText);
            $.each(errors.message, function (index, value) {
                errorMessage += value[0] + '<br>';
            });
            var html = '<div class="alert alert-danger errordivMain" id="errordiv">' +
                '<span onclick="hideErrorDiv()" class="pull-right" style="color:#933432;font-size: 20px;line-height: 15px; cursor: pointer;" >×</span>' +
                errorMessage +
                '</div>';
            $('#response_div').html(html);
            //$('#'+_id).removeAttr('disabled');
        }
    });
});
/*function sendcontectUs(_id){
	if($('#'+_id).is('[disabled=disabled]')){
		return false;
	} else {
		$('#'+_id).attr('disabled','disabled');
		$.ajax({
			type: "POST",
			url: 'contact-us',
			data: $('#contactSubmitForm').serialize(),
			cache: false,
			success: function(result){
				$('#'+_id).removeAttr('disabled');
				grecaptcha.reset();
				try {
					 result = JSON.parse(result);
				 } catch (e) {
					 swal('Error!',"Request couldn't complete at this time. wrong response received.Please try again later. Thank you.",'error');
					 return false;
				 }
				if(result.success == true){
					$('#contactSubmitForm')[0].reset();
				}
				$('#response_div').html(result.message); 
			},
			error: function (request, status, error) {
				$('#'+_id).removeAttr('disabled');
				
			}
		});
	}
}*/