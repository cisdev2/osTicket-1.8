$(document).ready(function () {
    $(window).resize(function () {
        $("#loading").css({
            top  : ($(window).height() / 3),
            left : ($(window).width() / 2 - 160)
        });
    });
});
