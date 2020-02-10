


function submitForm(){
    // Initiate Variables With Form Content
     var f_name = $("#f_name").val();
     var b_name = $("#b_name").val();
     var email = $("#email").val();
     var b_country = $("country").val();
     var postcode = $("#p_code").val();
     var s_name = $("#l_name").val();
     var message = $("#message").val();

var jData = {f_name: f_name, b_name: b_name, email: email, b_country: b_country, s_name: s_name, message: message, postcode: postcode};
          
                $.ajax({
                    method: "post",
                    url: "https://danderdee.com/Save",
                    data: jData,
                    success: function (data) {
                        if (data.indexOf("was been saved") > -1) {
                            new PNotify({
                                title: 'Success!',
                                text: 'Successfully submitted.',
                                type: 'success'
                            });
                        } else {
                            new PNotify({
                                title: 'Warning!',
                                text: 'Something is wrong !' + data,
                                type: 'warning'
                            });
                        }
                    },
                    error: function (err) {
                        new PNotify({
                            title: 'Error!',
                            text: 'Internal server error or connection timeout.',
                            type: 'error'
                        });
                    }
                })

         
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}