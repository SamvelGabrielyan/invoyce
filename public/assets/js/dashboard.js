function getInvoiceLink(id) {
    var baseurl = window.location.origin;
    document.getElementById("invoice_url").value = '';
    $.ajax({
        type: "GET",
        url: baseurl + "/dashboard/getInvoiceUrl/" + id,
        success: function (res) {
            if (res) {
                document.getElementById("invoice_url").value = res;
            } else {
//$("#state").empty();
            }
        }
    });
}

/***********************Copy URL************************************/
var copyTextareaBtn = document.querySelector('#js__textareacopybtn');
copyTextareaBtn.addEventListener('click', function (event) {
    var copyTextarea = document.querySelector('#invoice_url');
    copyTextarea.select();
    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';

    } catch (err) {
        console.log('Oops, unable to copy');
    }
});