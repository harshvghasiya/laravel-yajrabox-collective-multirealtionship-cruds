$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('form.FromSubmit').submit(function (event) {

    var formId = $(this).attr('id');
   
    // return false;
    if ($('#'+formId).valid()) {

        var formAction = $(this).attr('action');
        var buttonText = $('#'+formId+' button[type="submit"]').text();
        var $btn = $('#'+formId+' button[type="submit"]').attr('disabled','disabled').html("Loading...");
        console.log($btn);
        var redirectURL = $(this).attr("redirect_url");
        
        $.ajax({
            type: "POST",
            url: formAction,
            data: new FormData(this),
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.status == 1 && response.msg !="") {
                    $('#'+formId+' button[type="submit"]').text(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                   
                    window.location=redirectURL;
                }
            },
            error: function (jqXhr) {

                var errors = $.parseJSON(jqXhr.responseText);
                showErrorMessages(formId, errors);
                $('#'+formId+' button[type="submit"]').text(buttonText);
                $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
            }
        });

        return false;

    }else{

        return false;
    }
   
});
function showErrorMessages(formId, errorResponse) {
    var msgs = "";
    console.log(errorResponse);
    $.each(errorResponse.errors, function(key, value) {
       // console.log(value);
        msgs += value + " <br>";
    });
    flashMessage('danger', msgs,formId);
}
function flashMessage($type,messages,formId) {
   
    $.bootstrapGrowl(messages, {
        ele:'body',
        type: $type,
        delay: 5000,
        position: {
            from: "top",
            align: "right"
        },
       

    });
   
    // $.growl.error({ message: messages });
}




