$(function(){

    $('.ajax_form').submit(function(event){
        event.preventDefault();
        send_form($(this));
    });

});


var dialogo = function( msg )
{
    var tpl_shadow = "<div id=\"shadow\" class=\"caixa-shadow\"><div class=\"shadow_container\" id=\"shadow_container\"></div></div>";
    $(tpl_shadow).hide().appendTo("body").fadeIn("fast");
    var tpl_cx_dialog = "<div class=\"dialogo cx-dialogo\" ><div class=\"dialogo-btn-close\">X</div><div class=\"dialogo-msg\" id=\"texto\" >" +
        msg + "</div><div class=\"dialogo-btn-wrapper\"><div class=\"dialogo-btn float-r dialogo-btn-ok\"   >ok</div></div></div>";
    $("body").css("cursor","wait").append(tpl_cx_dialog);
    $(".dialogo-btn-ok").click(function () { closeDialogo(); });
    $(".dialogo-btn-close").click(function () { closeDialogo(); });
};

var closeDialogo = function()
{
    $(".dialogo").remove();
    $("body").css("cursor","default");
    $(".caixa-shadow").fadeOut("fast", function() { $(".caixa-shadow").remove(); });
};


var send_form = function(obj){

    var param = $(obj).serialize();

    var path =  $(obj).attr('action');

    $.post(path, param, function (data) {
        if (data) {
            if (data.js) {
                eval(data.js);
            }
        }
    }, 'json');

};