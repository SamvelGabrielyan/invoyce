/***********************pro del***************/
function loadProPrize() {
    var type = 'getprize';
    var proID = jQuery("#prod_id").val();
    var selected_value = [];
    var elements = document.getElementsByName("total_attr[]");
    for (var k = 1; k <= elements.length; k++) {
        var sel_val = jQuery("#arrt_val_" + k).val();
        if (sel_val != '') {
            selected_value.push(sel_val);
        }
    }
    if (elements.length == selected_value.length) {
        jQuery('#diff_prize').hide();
        jQuery('#sel_prize').show();
        jQuery('#sel_prize').html("<img src='images/loader.gif'/>");
        setTimeout(function () {
            jQuery.post("pass.php?action=getProdPrize&type=" + type, {
                atrID: selected_value,
                proID: proID
            }, function (data) {

                jQuery('#sel_prize').show();
                document.getElementById("sel_prize").innerHTML = data;
            });
        }, 500);
    }
}

function showPopupdiv() {
    //$("#popup2").modal('show');
    jQuery("#popup2").addClass("visible").show();
}


function saveToCart() {
    var type = 'getprize';
    var proID = jQuery("#prod_id").val();
    var prod_qty = jQuery("#qty").val();
    var selected_value = [];
    var elements = document.getElementsByName("total_attr[]");
    for (var k = 1; k <= elements.length; k++) {
        var sel_val = jQuery("#arrt_val_" + k).val();
        jQuery('#sel_error_' + k).hide();
        if (sel_val != '') {
            document.getElementById('arrt_val_' + k).style.borderColor = '';
            selected_value.push(sel_val);
        } else {
            var selval = jQuery("#sel_name_" + k).val();
            document.getElementById('arrt_val_' + k).style.borderColor = '#e52213';
            jQuery('#sel_error_' + k).show();
            jQuery('#sel_error_' + k).html("Please Select " + selval);
            return false;


        }
    }
    if (elements.length == selected_value.length) {
        jQuery.post("pass.php?action=saveProduct&type=" + type, {
            atrID: selected_value,
            proID: proID,
            prod_qty: prod_qty
        }, function (data) {
            showPopupdiv();
        });

    }
}

function foNextPage(id) {
    document.form1.pid.value = id;
    document.form1.action.value = 'sendurl';
    document.form1.submit();

}

function removeToCart(recId) {
    var type = 'remove';
    jQuery.post("pass.php?action=removeProduct&type=" + type, {recId: recId}, function (data) {
        //showPopupdiv();
        window.location.reload(true);
    });

}

/**************************Product det********************/







function unsavePro(id, user_id) {
    jQuery.ajax({
        type: 'POST',
        url: 'saveproduct.php',
        data: 'unsaveprodid=' + id + '&user_id=' + user_id,
        success: function (msg) {
            jQuery('#favorite_like' + id).text("Save");
            jQuery('#favorite_like' + id).attr('onclick', 'savePro(' + id + ',' + user_id + ')');
        }
    });
}

function unsaveProWish(id, user_id) {
    jQuery.ajax({
        type: 'POST',
        url: 'saveproduct.php',
        data: 'unsaveprodid=' + id + '&user_id=' + user_id,
        success: function (msg) {
            window.location.reload(true);
        }
    });
}

function hideErrorDiv() {
    document.getElementById('errordiv').style.display = "none";
}


function selectState() {
    var country_name = $("#m__country_name").val();
    var type = 'SelectState';
    $('#StateID').html("<img src='assets/images/1.gif'/>");
    $.post("pass.php?action=Country&type=" + type, {stateID: country_name}, function (data) {
        document.getElementById("StateID").innerHTML = data;
    });
}

function CheckEmailExistence(email) {
    $("#sp_err").html('');
    var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
    if (!(pattern.test(email)) && email != '') {
        $("#checkE").addClass("error_msg");
        $("#checkE").html("Please enter a Valid Email.");
        return false;
    }

    if (email != '') {
        var type = "checkemail";
        $("#checkE").removeClass("green-mess");
        if ($("#checkE").hasClass("error-mess")) {
            $("#checkE").removeClass("error-mess");
        }
        $("#checkE").html("<img src='assets/images/1.gif'>");
        $.post("pass.php?action=Country&type=" + type + "&email=" + email, {page: type, email: email}, function (data) {
            if (data != 0) {
                $('#m__email_adderss').val('');
                $("#checkE").addClass("error_msg");
                $("#checkE").html("Email already exist.");
            } else {
                $("#checkE").html('');
            }
        });
    }

    else {
        $("#checkE").addClass("error_msg");
        $("#checkE").html('Please enter email.');
    }
}


function CheckAffliateEmailExistence(email) {
    $("#sp_err").html('');
    var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
    if (!(pattern.test(email)) && email != '') {
        $("#checkE").addClass("error_msg");
        $("#checkE").html("Please enter a Valid Email.");
        return false;
    }

    if (email != '') {
        var type = "checkaffliateemail";
        $("#checkE").removeClass("green-mess");
        if ($("#checkE").hasClass("error-mess")) {
            $("#checkE").removeClass("error-mess");
        }
        $("#checkE").html("<img src='assets/images/1.gif'>");
        $.post("pass.php?action=Country&type=" + type + "&email=" + email, {page: type, email: email}, function (data) {
            if (data != 0) {
                $('#m__email_adderss').val('');
                $("#checkE").addClass("error_msg");
                $("#checkE").html("Email already exist.");
            } else {
                $("#checkE").html('');
            }
        });
    }

    else {
        $("#checkE").addClass("error_msg");
        $("#checkE").html('Please enter email.');
    }
}


function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
}


/***********************Get base url************************/
function getbaseUrlPath() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));
    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);
        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}
