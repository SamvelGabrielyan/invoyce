function hideErrorDiv() {
    document.getElementById('errordiv').style.display = "none";

}

function hideErrorDiv2() {
    document.getElementById('errordiv2').style.display = "none";
}

function hideErrorDiv3() {
    document.getElementById('errordiv3').style.display = "none";
}

function validateStanFrm() {
    var start_date = jQuery('#start_date').val();
    var time_periods = jQuery('#time_periods').val();
    var company_name = jQuery('#company_name').val();
    if (start_date.trim() == "" && time_periods.trim() == "") {
        openTab('tab1', 'tab_1', 'next_2', 'previous_1');
        jQuery('#sedule_error').show();
        jQuery('#sedule_error').html("Please select date.");
        return false;
    }

    /***** Paypale method check*******/
    if (jQuery('#paymentmethod').val() == '' && jQuery('#checkupdate').val() == 'yes') {
        jQuery('#paypal_method_error').text('Payment Method is Required!').show();

        return false;
    }
    jQuery('#paypal_method_error').empty().hide();

    if (company_name.trim() == "" || email.trim() == "") {
        openTab('tab2', 'tab_2', 'next_3', 'previous_2');
        $("html, body").animate({scrollTop: 0}, "slow");
    }
}

function validateStanFrmRecurring() {
    var time_periods = jQuery('#time_periods').val();
    if (time_periods.trim() == "") {
        openTab('tab1', 'tab_1', 'next_2', 'previous_1');
        jQuery('#sedule_error').show();
        jQuery('#sedule_error').html("Please select time period.");
        return false;
    }

    /***** Paypale method check*******/
    // if (jQuery('#paymentmethod').val() == '' && jQuery('#checkupdate').val() == 'yes') {
    //     jQuery('#paypal_method_error').text('Payment Method is Required!').show();
    //
    //     return false;
    // }
    jQuery('#paypal_method_error').empty().hide();

    openTab('tab2', 'tab_2', 'next_3', 'previous_2');
    $("html, body").animate({scrollTop: 0}, "slow");
}

function validateStanFrmScheduled() {
    var start_date = jQuery('#start_date').val();
    var time_periods = jQuery('#time_periods').val();
    var company_name = jQuery('#company_name').val();
    if (start_date.trim() == "") {
        openTab('tab1', 'tab_1', 'next_2', 'previous_1');
        jQuery('#sedule_error').show();
        jQuery('#sedule_error').html("Please select date.");
        return false;
    }

    /***** Paypale method check*******/
    // if (jQuery('#paymentmethod').val() == '' && jQuery('#checkupdate').val() == 'yes') {
    //     jQuery('#paypal_method_error').text('Payment Method is Required!').show();
    //
    //     return false;
    // }
    jQuery('#paypal_method_error').empty().hide();
    openTab('tab2', 'tab_2', 'next_3', 'previous_2');
    $("html, body").animate({scrollTop: 0}, "slow");
}

function validateStanFrm1() {
    var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
    var company_name = jQuery('#company_name').val();
    var email = jQuery('#email').val();
    var address = jQuery('#address').val();
    var city = jQuery('#city').val();
    var zip_code = jQuery('#zip_code').val();
    var phone = jQuery('#phone').val();
    var invoice_title = jQuery('#invoice_title').val();

    if (company_name.trim() == "") {
        jQuery('#company_error').show();
        jQuery('#company_error').html("Please enter company name.");
        jQuery('#company_name').focus();
        return false;
    }

    if (email.trim() == "") {
        jQuery('#email_error').show();
        jQuery('#email_error').html("Please enter email address.");
        jQuery('#company_error').hide();
        jQuery('#email').focus();
        return false;
    }
    if (!(pattern.test(email))) {
        jQuery('#email_error').show();
        jQuery('#email_error').html("Please enter valid email address.");
        jQuery('#company_error').hide();
        jQuery('#email').focus();
        return false;
    }

    openTab('tab3', 'tab_3', 'next_4', 'previous_3');
    $("html, body").animate({scrollTop: 0}, "slow");
    //Step Two

}

function validateDetailsAndItemsSteps() {
    var totalInvoice = jQuery('#totalInvoice').val();
    hide_hideerror(totalInvoice);
    var invoice_title = jQuery('#invoice_title').val();
    var invoice_number = jQuery('#invoice_number').val();
    var start_date = jQuery('#start_date').val();
    var time_periods = jQuery('#time_periods').val();
    var invoice_message = jQuery('#invoice_message').val();
    var terms_conditions = jQuery('#terms_conditions').val();

    if (invoice_title.trim() == "") {
        jQuery('#invoice_title_error').show();
        jQuery('#invoice_title_error').html("Please enter invoice title.");
        jQuery('#invoice_title').focus();
        return false;
    }
    if (invoice_number.trim() == "") {
        jQuery('#invoice_number_error').show();
        jQuery('#invoice_number_error').html("Please enter invoice number.");
        jQuery('#invoice_number').focus();
        return false;
    }
    $("html, body").animate({scrollTop: 0}, "slow");

    //Step three
    for (i = 1; i <= totalInvoice; i++) {
        var item_name = jQuery('#item_name_' + i).val();
        var item_description = jQuery('#item_description_' + i).val();
        var item_rate = jQuery('#item_rate_' + i).val();
        var item_qty = jQuery('#item_qty_' + i).val();
        var item_discount = jQuery('#item_discount_' + i).val();

        if (item_name.trim() == "") {
            jQuery('#item_name_error_' + i).show();
            jQuery('#item_name_error_' + i).html("Please enter item name.");
            jQuery('#item_name_' + i).focus();
            return false;
        }

        if (item_rate.trim() == "") {
            jQuery('#item_rate_error_' + i).show();
            jQuery('#item_rate_error_' + i).html("Enter item rate.");
            jQuery('#item_rate_' + i).focus();
            return false;
        }

        if (item_qty.trim() == "") {
            jQuery('#item_qty_error_' + i).show();
            jQuery('#item_qty_error_' + i).html("Enter item qty.");
            jQuery('#item_qty_' + i).focus();
            return false;
        }
        /************* Discount Field check**********/
        var dicounterro_attr = jQuery('#item_discount_error_' + i).attr('data-value');
        if (dicounterro_attr == 1) {
            jQuery('#item_discount_error_' + i).focus();
            return false;

        }
    }

    if (invoice_message.trim() == "" || terms_conditions.trim() == "") {
        openTab('tab5', 'tab_5', 'next_6', 'previous_5');
        $("html, body").animate({scrollTop: 0}, "slow");
        return true;
    }
}

function validateStanFrm3() {

    var totalInvoice = jQuery('#totalInvoice').val();
    hide_hideerror(totalInvoice);
    var invoice_title = jQuery('#invoice_title').val();
    var start_date = jQuery('#start_date').val();
    var time_periods = jQuery('#time_periods').val();
    var invoice_message = jQuery('#invoice_message').val();
    var terms_conditions = jQuery('#terms_conditions').val();

    //Step three
    for (i = 1; i <= totalInvoice; i++) {
        var item_name = jQuery('#item_name_' + i).val();
        var item_description = jQuery('#item_description_' + i).val();
        var item_rate = jQuery('#item_rate_' + i).val();
        var item_qty = jQuery('#item_qty_' + i).val();
        var item_discount = jQuery('#item_discount_' + i).val();

        if (item_name.trim() == "") {
            jQuery('#item_name_error_' + i).show();
            jQuery('#item_name_error_' + i).html("Please enter item name.");
            jQuery('#item_name_' + i).focus();
            return false;
        }

        if (item_rate.trim() == "") {
            jQuery('#item_rate_error_' + i).show();
            jQuery('#item_rate_error_' + i).html("Enter item rate.");
            jQuery('#item_rate_' + i).focus();
            return false;
        }

        if (item_qty.trim() == "") {
            jQuery('#item_qty_error_' + i).show();
            jQuery('#item_qty_error_' + i).html("Enter item qty.");
            jQuery('#item_qty_' + i).focus();
            return false;
        }
        /************* Discount Field check**********/
        var dicounterro_attr = jQuery('#item_discount_error_' + i).attr('data-value');
        if (dicounterro_attr == 1) {
            jQuery('#item_discount_error_' + i).focus();
            return false;

        }
    }

    if (invoice_message.trim() == "" || terms_conditions.trim() == "") {
        openTab('tab5', 'tab_5', 'next_6', 'previous_5');
        $("html, body").animate({scrollTop: 0}, "slow");
        return true;
    }
}


function calculateTotal() {
    var totalInvoice = jQuery('#totalInvoice').val();
    hide_hideerror(totalInvoice);
    var totalInAmount = 0;
    var discountAmount = 0;
    var disType = '';
    var totalDis = 0;
    for (i = 1; i <= totalInvoice; i++) {
        var item_name = jQuery('#item_name_' + i).val();
        var item_description = jQuery('#item_description_' + i).val();
        var item_rate = jQuery('#item_rate_' + i).val();
        var item_qty = jQuery('#item_qty_' + i).val();
        var item_discount = jQuery('#item_discount_' + i).val();
        var itemPrice = item_rate * item_qty;

        if (item_name.trim() == "" || item_rate.trim() == "" || item_qty.trim() == "") {
            openTab('tab4', 'tab_4', 'next_5', 'previous_4');
        }
        /*if(item_name.trim()==""){
        jQuery('#item_name_error_'+i).show();
        jQuery('#item_name_error_'+i).html("Please enter item name.");
        jQuery('#item_name_'+i).focus();
        return false;
        }*/


        if (item_rate.trim() == "") {
            jQuery('#item_rate_error_' + i).show();
            jQuery('#item_rate_error_' + i).html("Enter item rate.");
            jQuery('#item_rate_' + i).focus();
            return false;
        }

        if (item_qty.trim() == "") {
            jQuery('#item_qty_error_' + i).show();
            jQuery('#item_qty_error_' + i).html("Enter item qty.");
            jQuery('#item_qty_' + i).focus();
            return false;
        }

        var radios = document.getElementsByName('item_dis_' + i);
        for (var l = 0, length = radios.length; l < length; l++) {
            if (radios[l].checked) {
                disType = radios[l].value;
            }
        }
        if (typeof item_discount != "undefined" && item_discount != '' && item_discount != 0) {
            if (disType == 'yes') {

                /*** checking if discount is more then current price**********/

                if (parseFloat(item_discount) > parseFloat(item_rate)) {
                    jQuery('#item_discount_error_' + i).show();
                    jQuery('#item_discount_error_' + i).html("Discount cannot be more than per rate cost.");
                    jQuery('#item_discount_error_' + i).focus();
                    jQuery('#item_discount_error_' + i).attr('data-value', 1);
                    return false;

                }
                else {

                    jQuery('#item_discount_error_' + i).attr('data-value', 0);
                    jQuery('#item_discount_error_' + i).hide();
                    jQuery('#item_discount_error_' + i).empty();

                    discountAmount = item_discount;
                }


            } else {
                /****** checking the percentage range if it crosses the limit of 100**********/
                if (parseFloat(item_discount) > 100) {
                    jQuery('#item_discount_error_' + i).attr('data-value', 1);
                    jQuery('#item_discount_error_' + i).show();
                    jQuery('#item_discount_error_' + i).html("Discount percenatage range could only between 0 to 100.");
                    jQuery('#item_discount_error_' + i).focus();
                    return false;
                }
                else {
                    jQuery('#item_discount_error_' + i).attr('data-value', 0);
                    jQuery('#item_discount_error_' + i).hide();
                    jQuery('#item_discount_error_' + i).empty();
                    discountAmount = (itemPrice * item_discount) / 100;
                }


            }

        } else {
            discountAmount = 0;
        }
        totalDis = +totalDis + +discountAmount;
        totalInAmount = +totalInAmount + +(itemPrice - discountAmount);

    }


    var totalInAmount = totalInAmount.toLocaleString(undefined, // use a string like 'en-US' to override browser locale
        {minimumFractionDigits: 2}
    );
    var totalDis = totalDis.toLocaleString(undefined, // use a string like 'en-US' to override browser locale
        {minimumFractionDigits: 2}
    );
    document.getElementById('totalAmount').innerHTML = totalInAmount;
    document.getElementById('totalDiscount').innerHTML = totalDis;
}

function hide_hideerror(totalInvoice) {
    jQuery('#company_error').hide();
    jQuery('#email_error').hide();
    jQuery('#address_error').hide();
    jQuery('#city_error').hide();
    jQuery('#zip_code_error').hide();
    jQuery('#phone_error').hide();
    jQuery('#invoice_title_error').hide();
    jQuery('#invoice_number_error').hide();
    jQuery('#terms_conditions_error').hide();
    jQuery('#invoice_message_error').hide();
    for (k = 1; k <= totalInvoice; k++) {
        jQuery('#item_name_error_' + k).hide();
        jQuery('#item_description_error_' + k).hide();
        jQuery('#item_rate_error_' + k).hide();
        jQuery('#item_qty_error_' + k).hide();
    }

}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
}


/******* jquery form submit even check*****/
jQuery(document).ready(function () {

    jQuery('.scheduled').on('submit', function () {
        /***** Paypal method check*******/
        if (jQuery('#paymentmethod').val() == '') {
            jQuery('#paypal_method_error').text('Payment Method is Required!').show();

            return false;
        }
        jQuery('#paypal_method_error').empty().hide();


    })

});