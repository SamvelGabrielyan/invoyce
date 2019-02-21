$(document).ready(function() {
    var URL = $('.demo').data('url');
    $(".demo").on('keyup', function() {
        var search = $(this).val();
        $.ajax({
            type: 'GET',
            url: URL,
            data: {
                'search': search
            },
            success: function(response) {
                var html = '';

                $.each(response, function (index, item) {
                    html += '<div class="">' +
                                '<div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">' +
                                    '<div>T</div>' +
                                '</div>' +
                                '<div class="p-l-10 inline p-t-5">' +
                                    '<a href="' + item.base_url + '/dashboard/invoices/preview/' + item.invoice_id + '">' +
                                        '<h5 class="m-b-5  ">' +
                                            '<span class="semi-bold">' + item.invoice_title + '</span><br>' +
                                            'Sent on ' + item.sent_date + ' - ' + item.paid_status +
                                        '</h5>' +
                                        '<p class="hint-text" style="color:#626262;">' + item.company_name + '</p>' +
                                    '</a>' +
                                '</div>' +
                        '</div>'
                });
                $('#invoice_list').html(html);
            },
            error: function (errors) {
                var message = JSON.parse(errors.responseText);
                $('#invoice_list').html(message.error);
            }
        });
    });

    $('#js-overlay-search-close').on('click', function () {
        $('#invoice_list').html('');
        $('#js-overlay-search-input').val('');
    });
});