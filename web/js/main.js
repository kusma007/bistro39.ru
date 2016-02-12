//$(document).ready(function(){
//    $( "#ss-submit" ).click(function() {
//        alert( "Handler for .click() called." );
//    });
//});
function sendAjax(elem,controller,action,id) {
    //console.log($(elem).val());
    if($(elem).val()!=='on') {
        $.ajax({
            method: "POST",
            url: "/"+controller+"/"+action+'?id='+id
        }).done(function(data) {
            $('.btn-on').html('off').removeClass('btn-on').addClass('btn-off').val('off');
            $(elem).html(data).removeAttr('class').addClass('btn-'+data).val(data);
        });
    }
}