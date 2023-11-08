$(document).ready(function(){


// Getting Info into Static modal/screen
    $(document.body).on('click', '.modal_button',function () {
        var url = $(this).data('url');
        var data;
        // console.log(url);
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

// Content Reciever 
    $('#myModal').on('shown.bs.modal', function (event) {
        // $('#myModal').modal('show');
        var url = $(event.relatedTarget).data('url');
            
                console.log(url);
                var data;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    cache: false,
                    success: function (data) {
                        
                        // console.log(url);
                        $('#modal-content').html(data);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                    });
        
    });



    // Seach Box
    $(document.body).on('keyup','.search_box', function () {
        var url = $(this).data('url');
        var str = $(this).val();
        // The Id identifies which particular search_result div the result should sit in
        // In a case where there're multiple search boxes on a single page
        var id  = $(this).attr('id');


        if (url.includes("?")) {

            var url = (url+"&str="+str);
        }else{

            var url = (url+"?str="+str);
        }
        

        // console.log(url);
        var data;
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                console.log(url);
                $('#search_result_'+id).html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    // Filter Box
    $(document.body).on('change','.filter_box', function () {
        var url = $(this).data('url');
        var str = $(this).val();
        // The Id identifies which particular search_result div the result should sit in
        // In a case where there're multiple search boxes on a single page
        var id  = $(this).attr('id');


        if (url.includes("?")) {

            var url = (url+"&str="+str);
        }else{

            var url = (url+"?str="+str);
        }
        

        // console.log(url);
        var data;
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                console.log(url);
                $('#search_result'+id).html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });


    // Switch Toggle function
    $(document.body).on('change','.toggle_button', function () {
        var switchStatus ;
    // if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
        var id = $(this).attr('id');
        var url = $(this).data('url');
        var data;

        
        console.log(url);

        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                $(this).value = $(this).checked ? data.on : data.off;

                $('#tr_'+id).html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });

    });



    // Checking or Unchecking
    $(document.body).on('click', '.check_button',function () {
        var url = $(this).data('url');
        var id = $(this).attr('id');
        var data;


        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                // if there's nothing to be returned
                if(data == "abort"){
                    $('#myModal').modal('show');
                    $('#modal-content').html("Failure to take action");
                    return false;
                }
                
                // console.log(url);
                $('#tr_'+id).html(data);
                 // Check the succes or failure status
                 
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    // Switching Tabs
    $(document.body).on('click', '.nav-link',function () {
        
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-pane");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("nav-link");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            var tabName = $(this).attr('aria-controls');
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).className += " active";  
    });


    // CUSTOM EVENTS

    // EVENT TO CHECK IF A SCROLLABLE ELEMENT HAS REACHED IT'S END
    // function reachedEnd() {
    //     const element = document.getElementsByClassName('loadMore');

    //     // Check if the user has scrolled to the bottom
    //     if (element.scrollTop + element.clientHeight >= element.scrollHeight) {
    //         console.log('You have reached the bottom!');
    //     }
    // }

    // const appendableElements = document.getElementsByClassName('loadMore');
    // appendableElements.addEventListener('reachedEnd', reachedEnd);


})

