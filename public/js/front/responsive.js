$(document).ready(function(){
    navbarResponsive();
    $(window).resize(navbarResponsive);
});
function navbarResponsive(){
    var menu=$(".navbar-nav");
    var menuLista=menu.find(".nav-item");
    $(".nav-identificador").remove();
    if($(window).width()<975){
        menuLista.each(function(){
            var nombre= $(this).find(".nav-link i").attr("title");
            var text=$("<span>").addClass("nav-identificador").text(nombre);
            $(this).find(".nav-link").append(text);
        });
    }
}