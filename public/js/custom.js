$(document).ready(function(){

    //  // Show loading overlay when the page starts loading
    //  $('#loading-overlay').show();

    //  // Hide loading overlay when the page has finished loading
    //  $(window).on('load', function() {
    //      $('#loading-overlay').fadeOut('slow');
    //  });
     

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

    $('#myModal').on('shown.bs.modal', handleModalShown);
    $('#myModal2').on('shown.bs.modal', handleModalShown);
    $('#myLargeModal').on('shown.bs.modal', handleModalShown);
    function handleModalShown(event) {
        // $('#myModal').modal('show');
        var url = $(event.relatedTarget).data('url');
            
        console.log(url);
        var data;
        var formData = $('#myForm').serialize();
        console.log(formData);

        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                // console.log(data);
                $('.modal-content').html(data);
            },
            error: function(err) {
                console.log(err);
            }
            });
        
    };

    // Data Tables
    $('.datatable_print').DataTable( {
        dom:'Bfrtip',
        buttons: [
            // 'copy', 'pdf','print','excel',
            'print','excel',
        ]
    
    } );

    $('.datatable').DataTable( {
 
    } );


    // // Confrim Password
    // $(document.body).on('click','.confirm_password', function () {
    //     var formData = $('#myForm').serialize();
    //     var url = $(this).data('url');
    //     // var str = $(this).val();

    //     // if (url.includes("?")) {

    //     //     var url = (url+"&str="+str);
    //     // }else{

    //     //     var url = (url+"?str="+str);
    //     // }



    //     // console.log(url);
    //     var data;
    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         data: formData,
    //         cache: false,
    //         success: function (data) {
                
    //             console.log(url);
    //             $('.modal-content').html(data);
    //             $('#myModal').modal('show');
    //         },
    //         error: function(err) {
    //             console.log(err);
    //         }
    //     });
    // });

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

    // Table Replace Stuff
    $(document.body).on('click','.table_replace_button', function () {
        var url = $(this).data('url');


        // console.log(url);
        var data;
        $.ajax({
            type: "GET",
            url: url,
            data: data,
            cache: false,
            success: function (data) {
                
                console.log(url);
                $('#table_replaceable').html(data);
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
                    $('.modal-content').html("Failure to take action");
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

    // Hide Session Messages after 5 Seconds
    $(document).ready(function() {
        // Find the popMessage element using jQuery
        var popMessageElement = $('.PopMessage');

        // Hide the popMessage element after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            popMessageElement.slideUp(500);
        }, 5000);
    });

    // Qr Code
    var qrcode = new QRCode("qrcode");

    function makeCode () {    
    var elText = document.getElementById("text");
    
    if (!elText.value) {
        alert("Input a text");
        elText.focus();
        return;
    }
    
    qrcode.makeCode(elText.value);
    }

    makeCode();

    $("#text").
    on("blur", function () {
        makeCode();
    }).
    on("keydown", function (e) {
        if (e.keyCode == 13) {
        makeCode();
        }
    });


    // Toggle Password
    function toggle_password() {
        console.log('Yes');
        var x = document.getElementsByClassName("password");
        if (x.type == "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

      $('.password-toggle').click(toggle_password);

    


})

