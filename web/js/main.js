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
            $('.menu-on').html('off').removeClass('menu-on').addClass('menu-off').val('off');
            $(elem).html(data).removeAttr('class').addClass('menu-'+data).val(data);
        });
    }
}