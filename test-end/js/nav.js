$(function() {
    $(".navbar-toggler").click(function() {
    //    $(".navbar-toggler-icon").css({"display":"none"});
    //    $(".navbar-toggler-icon-X").css({"display":"block"});
        if($(".navbar-toggler").hasClass("collapsed")) {
            $(".navbar-toggler-icon").css({"display":"block"});
            $(".navbar-toggler-icon-X").css({"display":"none"});
            $(".container-fluid").css({"box-shadow":"none"});
            $("#drop").toggleClass("dropdownn dropdown-menu");
        }
        else{
            $(".navbar-toggler-icon").css({"display":"none"});
            $(".navbar-toggler-icon-X").css({"display":"block"});
            $(".container-fluid").css({"box-shadow":"0px 8px 0px rgba(0, 0, 0, 0.15)"});
            $("#drop").toggleClass("dropdown-menu dropdownn");
        }
    });
    
    
});
