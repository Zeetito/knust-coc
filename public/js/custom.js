$(document).ready(function(){

    $('.get_info_modal_button').on('click', function () {
        var url = $(this).data('url');
        var data;
        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                // console.log(url);
                $('#get_fetched_content').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
})

