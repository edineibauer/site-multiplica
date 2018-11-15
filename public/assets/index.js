/*!
 * Start Bootstrap - New Age v5.0.0 (https://startbootstrap.com/template-overviews/new-age)
 * Copyright 2013-2018 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-new-age/blob/master/LICENSE)
 */

$(function () {
    if($(document).width() > 768) {
        setTimeout(function () {
            $("#smart-img").css("transform", "translateX(0)");
        }, 100);
    }
});

!function (e) {
    "use strict";
    e('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var a = e(this.hash);
            if ((a = a.length ? a : e("[name=" + this.hash.slice(1) + "]")).length) return e("html, body").animate({scrollTop: a.offset().top - 48}, 1e3, "easeInOutExpo"), !1
        }
    }), e(".js-scroll-trigger").click(function () {
        e(".navbar-collapse").collapse("hide")
    });
}(jQuery);