function initValik() {
    "use strict";
    //   loader ------------------
    firstLoad();
    function firstLoad() {
        var counter = 0;
        var count = 0;
        var i = setInterval(function () {
            $(".loader_count").html(count);
            counter++;
            count++;
            if (counter == 101) {
                clearInterval(i);
            }
        }, 14);
        TweenMax.to($(".loading-text-container"), 1.0, {
            force3D: true,
            scale: "0.9",
            opacity: 0,

            ease: Expo.easeInOut,
            delay: 1.3,
            onComplete: function () {
                $(".main-loader-wrap").fadeOut(800);
            }
        });
    }
    var cholder = $('.content-holder'),
        chbg = $(".content-bg"),
        pbw = $(".progress-bar-wrap"),
        mh = $(".main-header"),
        sbw = $(".sidebar-wrap");
    if (cholder.hasClass("hide-dec")) {
        chbg.addClass("hide_cb");
        pbw.addClass("hide_pw");
        mh.removeClass("top-header");
        sbw.removeClass("top-sb");
    } else {
        chbg.removeClass("hide_cb");
        pbw.removeClass("hide_pw");
        mh.addClass("top-header");
        sbw.addClass("top-sb");
    }
    if (cholder.hasClass("vis-pb")) {
        pbw.addClass("show_pw");
    } else {
        pbw.removeClass("show_pw");
    }
    //   Background image ------------------
    var a = $(".bg");
    a.each(function (a) {
        if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
    });
    //  scrollToFixed------------------
    $(".fix-column_init ").scrollToFixed({
        minWidth: 1068,
        zIndex: 112,
        marginTop: 160,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".fix-column_init").outerHeight(true);
            return a;
        }
    });
    //   Isotope------------------
    function n() {
        if ($(".gallery-items").length) {
            var a = $(".gallery-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                singleMode: true,
                transformsEnabled: true,
                transitionDuration: "900ms"
            });
            a.imagesLoaded(function () {
                a.isotope("layout");
            });
            $(".gallery-filters").on("click  ", "a.gallery-filter", function (b) {
                b.preventDefault();
                var c = $(this).attr("data-filter"),
                    d = $(this).text();
                a.isotope({
                    filter: c
                });
                $(".gallery-filters a").removeClass("gallery-filter-active");
                $(this).addClass("gallery-filter-active");


            });
        }
        $(".gallery-items").isotope("on", "layoutComplete", function (a, b) {
            var b = a.length;
            $(".num-album").html(b);
        });
        var b = $(".gallery-item").length;
        $(".all-album , .num-album").html(b);

        $(".load-more").on("click", function (e) {
            e.preventDefault();
            var $this = $(this);
            setTimeout(function () {
                $this.addClass("compload");
                $(".portfolio-msg").addClass("vismsg");
            }, 700);
            a.infinitescroll({
                navSelector: "#infiniti_nav",
                nextSelector: "#infiniti_nav a",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three"
            }, function (b) {
                a.isotope("appended", $(b));
                a.imagesLoaded(function () {
                    a.isotope("layout");
                });
                var b = $(".gallery-item").length;
                $(".all-album").html(b);

                $("a").on({
                    mouseenter: function () {
                        $(".element-item").addClass("elem_hover");
                    },
                    mouseleave: function () {
                        $(".element-item").removeClass("elem_hover");
                    }
                });
            });
        });
    }
    n();
    // $(window).on("load", function () {
    //     setTimeout(function(){
    //         n();
    //     },300);
        
    // });
    // isotope------------------
    function postGrid() {
        if ($(".post-items").length) {
            var $grid2 = $(".post-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".post-item",
            });
            $grid2.imagesLoaded(function () {
                $grid2.isotope("layout");
            });
        }
    }
    postGrid();
    //   Blog filter ------------------
    $(".blog-btn").on("click", function () {
        $(this).parent(".blog-btn-filter").find(".blog-filter-wrap").slideToggle(500);
        return false;
    });
    $(".blog-filter-wrap_item").on({
        mouseenter: function () {
            var textAnim2 = $(this).data("bfgt");
            $(".blog-filter-wrap_title").text(textAnim2);
        },
        mouseleave: function () {
            $(".blog-filter-wrap_title").text("");
        }
    });
    function csselem() {
        $(".fw-carousel .swiper-container").css({
            height: $(".fw-carousel").outerHeight(true)
        });
        $(".fs-slider-item").css({
            height: $(".fs-slider").outerHeight(true)
        });

        $(".ms-item_fs").css({
            height: $(".slideshow-container_wrap").outerHeight(true)
        });
    }
    $(window).on("resize", function () {
        csselem();
    });
    csselem();
    var fst = true;
    //   sliders ------------------
    function setUpCarouselSlider() {
        $('.fw-carousel .swiper-wrapper').addClass('no-horizontal-slider');
        if ($(".fw-carousel").length > 0) {
            if ($(window).width() >= 768 && j2 == undefined) {
                var totalSlides2 = $(".fw-carousel .swiper-slide:not(.swiper-slide-duplicate) img").length;
                var j2 = new Swiper(".fw-carousel .swiper-container", {
                    preloadImages: false,
                    loop: false,
                    freeMode: false,
                    slidesPerView: "auto",
                    spaceBetween: 10,
                    grabCursor: true,
                    mousewheel: false,
                    speed: 1400,
                    scrollbar: {
                        el: '.hs_init',
                        draggable: true,
                    },
                    pagination: {
                        el: '.hs_counter .current',
                        type: 'fraction',
                        renderFraction: function (currentClass) {
                            return '<span class="' + currentClass + '"></span>' + '<span class="csep">of</span>' + '<span class="j2total">' + totalSlides2 + '</span>';
                        }
                    },
                    centeredSlides: false,
                    effect: "slide",
                    navigation: {
                        nextEl: '.fw-carousel-button-next',
                        prevEl: '.fw-carousel-button-prev',
                    }

                });
            }
            if ($(window).width() < 768 && j2 !== undefined) {
                j2.destroy();
                j2 = undefined;
                $('.fw-carousel .swiper-wrapper').removeAttr('style').addClass('no-horizontal-slider');
                $('.swiper-slide').removeAttr('style');
            }
        }
        setTimeout(function () {
            if(fst){
                fst = false;
                setUpCarouselSlider();
                $(".fw-carousel.thumb-contr .swiper-slide:not(.swiper-slide-duplicate) img").each(function () {
                    var ccasdc = $(this).attr("src");
                    $("<div class='thumb-img'><img src='" + ccasdc + "'></div>").appendTo(".thumbnail-wrap");
                });
                $(".thumb-img").on('click', function () {
                    j2.slideTo($(this).index(), 500);
                    hideThumbnails();
                });
            }
            
           
        }, 1000);
       
    }
    setUpCarouselSlider();
    var thumbcont = $(".thumbnail-container"),
        thumbItrm = $(".thumb-img"),
        stbtn = $(".show_thumbnails");
    function showThumbnails() {
        TweenMax.to(thumbcont, 1.0, {
            force3D: true,
            bottom: 0,
            ease: Expo.easeInOut,
            onComplete: function () {
                thumbItrm.addClass("visthumbnails");
                thumbcont.addClass("visthumbnails");
            }
        });
        stbtn.removeClass("unvisthum");
        $(".fw_cb").addClass("un_visbtn");
    }
    function hideThumbnails() {
        thumbItrm.removeClass("visthumbnails");
        TweenMax.to(thumbcont, 1.0, {
            force3D: true,
            delay: 0.2,
            bottom: "100%",
            ease: Expo.easeInOut,
            onComplete: function () {
                thumbcont.removeClass("visthumbnails");
                $(".fw_cb").removeClass("un_visbtn");
            }
        });
        stbtn.addClass("unvisthum");
    }
    stbtn.on("click", function () {
        if ($(this).hasClass("unvisthum")) showThumbnails();
        else hideThumbnails();
    });
    if ($(".single-slider").length > 0) {
        var j3 = new Swiper(".single-slider .swiper-container", {
            preloadImages: false,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoHeight: true,
            grabCursor: false,
            mousewheel: false,
            pagination: {
                el: '.ss-slider-pagination',
                clickable: true,

            },
            navigation: {
                nextEl: '.fw-slider-button-next',
                prevEl: '.fw-slider-button-prev',
            },
        });
        var totalSlides = $(".single-slider .swiper-slide:not(.swiper-slide-duplicate) img").length;
        $('.total').html('0' + totalSlides);
        j3.on('slideChange', function () {
            var csli = j3.realIndex + 1,
                curnum = $('.current'),
                curnumanm = $('.hs_counter .current');
            TweenMax.to(curnumanm, 0.2, {
                force3D: true,
                y: -10,
                opacity: 0,
                ease: Power2.easeOut,
                onComplete: function () {
                    TweenMax.to(curnumanm, 0.1, {
                        force3D: true,
                        y: 10
                    });
                    curnum.html('0' + csli);
                }
            });
            TweenMax.to(curnumanm, 0.2, {
                force3D: true,
                y: 0,
                delay: 0.3,
                opacity: 1,
                ease: Power2.easeOut
            });
        });
    }
    if ($(".testilider").length > 0) {
        var j2 = new Swiper(".testilider .swiper-container", {
            preloadImages: false,
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            grabCursor: true,
            mousewheel: false,
            centeredSlides: true,
            pagination: {
                el: '.tc-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.ts-button-next',
                prevEl: '.ts-button-prev',
            },
            breakpoints: {
                1064: {
                    slidesPerView: 2,
                },
                640: {
                    slidesPerView: 1,
                },
            }
        });
    }
    if ($(".hero-carousel").length > 0) {
        var hcarosel = new Swiper(".hero-carousel .swiper-container", {
            preloadImages: false,
            slidesPerView: 2,
            spaceBetween: 10,
            loop: true,
            grabCursor: true,
            mousewheel: true,
            centeredSlides: false,
            parallax: true,
            speed: 1400,
            pagination: {
                el: '.hc-pag',
                clickable: true,
            },
            navigation: {
                nextEl: '.hc_btn_next',
                prevEl: '.hc_btn_prev',
            },
            breakpoints: {
                1064: {
                    slidesPerView: 1,
                },
            }
        });
        hcarosel.on("slideChangeTransitionStart", function () {
            $(".hero-blur-container").addClass("hideblur");
        });
        hcarosel.on("slideChangeTransitionEnd", function () {
            var actslidec = $(".hero-carousel .swiper-slide.swiper-slide-active .hero-carousel_item .bg").attr('data-bg');
            $('.hero-blur-container .bg').css("background-image", "url(" + actslidec + ")");
            $(".hero-blur-container").removeClass("hideblur");
        });
        var actslidec = $(".hero-carousel .swiper-slide.swiper-slide-active .hero-carousel_item .bg").attr('data-bg');
        $('.hero-blur-container .bg').css("background-image", "url(" + actslidec + ")");		
        var totalSlides2 = $(".hero-carousel .swiper-slide:not(.swiper-slide-duplicate)").length;
        $('.total_c').html(totalSlides2);
        hcarosel.on('slideChange', function () {
            var csli2 = hcarosel.realIndex + 1,
                curnum2 = $('.current_c'),
                curnumanm2 = $('.hc_counter .current_c');
            TweenMax.to(curnumanm2, 0.2, {
                force3D: true,
                y: -10,
                opacity: 0,
                ease: Power2.easeOut,
                onComplete: function () {
                    TweenMax.to(curnumanm2, 0.1, {
                        force3D: true,
                        y: 10
                    });
                    curnum2.html(csli2);
                }
            });
            TweenMax.to(curnumanm2, 0.2, {
                force3D: true,
                y: 0,
                delay: 0.3,
                opacity: 1,
                ease: Power2.easeOut
            });
        });
    }
    if ($(".fs-slider").length > 0) {
        var mouseContr2 = $(".fs-slider").data("mousecontrol2");
        var fss = new Swiper(".fs-slider .swiper-container", {
            preloadImages: false,
            loop: true,
            grabCursor: true,
            speed: 2400,
            spaceBetween: 0,
            effect: "slide",
            mousewheel: true,
            parallax: true,
            pagination: {
                el: '.hc-pag',
                clickable: true,

            },
            navigation: {
                nextEl: '.fs-slider-button-next',
                prevEl: '.fs-slider-button-prev',
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false
            }
        });
        var autobtn2 = $(".play-pause_slider2");
        function autoEnd2() {
            autobtn2.removeClass("auto_actslider2");
            fss.autoplay.stop();
        }
        function autoStart2() {
            autobtn2.addClass("auto_actslider2");
            fss.autoplay.start();
        }
        autobtn2.on("click", function () {
            if (autobtn2.hasClass("auto_actslider2")) autoEnd2();
            else autoStart2();
            return false;
        });
        var totalSlides3 = $(".fs-slider .swiper-slide:not(.swiper-slide-duplicate)").length;
        $('.total_c').html(totalSlides3);
        fss.on('slideChange', function () {
            var csli3 = fss.realIndex + 1,
                curnum3 = $('.current_c'),
                curnumanm3 = $('.hc_counter .current_c');
            TweenMax.to(curnumanm3, 0.2, {
                force3D: true,
                y: -10,
                opacity: 0,
                ease: Power2.easeOut,
                onComplete: function () {
                    TweenMax.to(curnumanm3, 0.1, {
                        force3D: true,
                        y: 10
                    });
                    curnum3.html(csli3);
                }
            });
            TweenMax.to(curnumanm3, 0.2, {
                force3D: true,
                y: 0,
                delay: 0.3,
                opacity: 1,
                ease: Power2.easeOut
            });
        });
    }
    if ($(".slideshow-container_wrap").length > 0) {
        var ms1 = new Swiper(".slideshow-container_wrap .swiper-container", {
            preloadImages: false,
            loop: true,
            speed: 2400,
            spaceBetween: 0,
            effect: "fade",
            init: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false
            }

        });
        kpsc();
        ms1.on("slideChangeTransitionStart", function () {
            eqwe();
        });
        ms1.on("slideChangeTransitionEnd", function () {
            kpsc();
        });
        function kpsc() {
            $(".slide-progress").css({
                width: "100%",
                transition: "width 4000ms"
            });
        }
        function eqwe() {
            $(".slide-progress").css({
                width: 0,
                transition: "width 0s"
            });
        }
    }
    //   lightGallery------------------
    $(".image-popup , .single-popup-image").lightGallery({
        selector: "this",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        counter: false
    });
    var o = $(".lightgallery"),
        p = o.data("looped");
    o.lightGallery({
        selector: ".lightgallery a.popup-image , .lightgallery  a.popgal",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        loop: p,
        counter: false
    });
    $('#html5-videos').lightGallery({
        selector: 'this',
        counter: false,
        download: false,
        zoom: false
    });
    $(".filter-button").on("click  ", function () {
        $(".hid-filter").slideToggle(500);
    });

    $(".gallery-filters a").on("click", function () {
        if ($(window).width() < 768) {
            $(".hid-filter").delay(1000).slideUp(300);
        }
    });
    $(".mob-filter_btn").on("click  ", function () {
        $(".gfm").slideToggle(500);
    });
    var textTitle = $(".hero-title h2").text();
    $(".dec-title span").text(textTitle);
    $(".content-nav li a ").on({
        mouseenter: function () {
            var textAnim = $(this).find("strong").text();
            $(".dec-title span").text(textAnim);
        },
        mouseleave: function () {
            $(".dec-title span").text(textTitle);
        }
    });
    // Share   ------------------
    $(".share-container").share({
        networks: ['facebook', 'pinterest', 'twitter', 'tumblr']
    });
    //   Video------------------	
    if ($(".video-holder-wrap").length > 0) {
        function videoint() {

            var w = $(".background-vimeo").data("vim"),
                bvc = $(".background-vimeo"),
                bvmc = $(".media-container"),
                bvfc = $(".background-vimeo iframe "),
                vch = $(".video-container");
            bvc.append('<iframe src="//player.vimeo.com/video/' + w + '?background=1"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
            $(".video-holder").height(bvmc.height());
            if ($(window).width() > 1024) {
                if ($(".video-holder").length > 0)
                    if (bvmc.height() / 9 * 16 > bvmc.width()) {
                        bvfc.height(bvmc.height()).width(bvmc.height() / 9 * 16);
                        bvfc.css({
                            "margin-left": -1 * $("iframe").width() / 2 + "px",
                            top: "-75px",
                            "margin-top": "0px"
                        });
                    } else {
                        bvfc.width($(window).width()).height($(window).width() / 16 * 9);
                        bvfc.css({
                            "margin-left": -1 * $("iframe").width() / 2 + "px",
                            "margin-top": -1 * $("iframe").height() / 2 + "px",
                            top: "50%"
                        });
                    }
            } else if ($(window).width() < 760) {
                $(".video-holder").height(bvmc.height());
                bvfc.height(bvmc.height());
            } else {
                $(".video-holder").height(bvmc.height());
                bvfc.height(bvmc.height());
            }
            vch.css("width", $(window).width() + "px");
            vch.css("height", Number(720 / 1280 * $(window).width()) + "px");
            if (vch.height() < $(window).height()) {
                vch.css("height", $(window).height() + "px");
                vch.css("width", Number(1280 / 720 * $(window).height()) + "px");
            }
        }
        videoint();
    }
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        var a = 70;
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $(window).on("scroll", function () {
        var a = $(document).height();
        var b = $(window).height();
        var c = $(window).scrollTop();
        var d = c / (a - b) * 100;
        $(".progress-bar").css({
            width: d + "%"
        });
    });
    //   Contact form------------------
    $("#contactform").submit(function () {
        var a = $(this).attr("action");
        $("#message").slideUp(750, function () {
            $("#message").hide();
            $("#submit").attr("disabled", "disabled");
            $.post(a, {
                name: $("#name").val(),
                email: $("#email").val(),
                comments: $("#comments").val()
            }, function (a) {
                document.getElementById("message").innerHTML = a;
                $("#message").slideDown("slow");
                $("#submit").removeAttr("disabled");
                if (null != a.match("success")) $("#contactform").slideDown("slow");
            });
        });
        return false;
    });
    $("#contactform input, #contactform textarea").keyup(function () {
        $("#message").slideUp(1500);
    });
    //  Map------------------
    if ($("#map-single").length > 0) {
        var latlog = $('#map-single').data('latlog'),
            popupTextit = $('#map-single').data('popuptext'),
            map = L.map('map-single').setView(latlog, 11);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png').addTo(map);
        if ($(window).width() > 1064) {
            var offset = map.getSize().x * 0.15;
            map.panBy(new L.Point(-offset, 0), {
                animate: false
            });
        } else {
            var offset = map.getSize().x * 0;
            map.panBy(new L.Point(-offset, 0), {
                animate: false
            });
        }
        var greenIcon = L.icon({
            iconUrl: 'images/marker.png',
            iconSize: [40, 40],
            popupAnchor: [0, -26]
        });
        L.marker(latlog, {
            icon: greenIcon
        }).addTo(map).bindPopup(popupTextit);
    }
    $(".show_contact-form").on("click", function (e) {
        e.preventDefault();
        $(".content-inner").addClass("vis-con-form");
    });
    $(".close-contact_form").on("click", function () {
        $(".content-inner").removeClass("vis-con-form");
        $("#message").slideUp(500);
        $(".custom-form").find("input[type=text], textarea").val("");
    });
//  cursor  ------------------
    $("a , .btn ,   textarea,   input  , .leaflet-control-zoom , .sb-button , .close-contact_form , .hc-single_btn  , .tumbnail-button , .swiper-pagination-bullets , .to-top-btn  , .gc-slider-cont  , .hp_popup , button  , .fw_cb , .promo-video-btn , .hc-controls , .sb-overlay , .play-pause_slider2").on({
        mouseenter: function () {
            $(".element-item").addClass("elem_hover");
        },
        mouseleave: function () {
            $(".element-item").removeClass("elem_hover");
        }
    });
    $(".swiper-slide").on({
        mouseenter: function () {
            $(".element-item").addClass("slider_hover");
        },
        mouseleave: function () {
            $(".element-item").removeClass("slider_hover");
        }
    });
    $(".swiper-slide a.box-media-zoom , .hero-carousel_project-title , .fs-slider_align_title h2 a , .hero-btn ").on({
        mouseenter: function () {
            $(".element-item").removeClass("slider_hover");
        },
        mouseleave: function () {
            $(".element-item").addClass("slider_hover");
        }
    });
    $("#footer-twiit").on({
        mouseenter: function () {
            $(".element").addClass("unvis_elem");
        },
        mouseleave: function () {
            $(".element").removeClass("unvis_elem");
        }
    });
    $(".sb-overlay").on({
        mouseenter: function () {
            $(".element-item").addClass("close-icon");
        },
        mouseleave: function () {
            $(".element-item").removeClass("close-icon");
        }
    });
    $("p , h1 , h2 , h3 , h4 , h5 , .policy-box , .gfc_title , .swiper-counter , .share-title , .dec-title , .inline-facts-holder , .serv-list , .team-item-title , .post-opt , .caption-wrap ul li span").on({
        mouseenter: function () {
            $(".element-item").addClass("elem_text");
        },
        mouseleave: function () {
            $(".element-item").removeClass("elem_text");
        }
    });
}
if ($(".element-item").length > 0) {
    var mouse = {
        x: 0,
        y: 0
    };
    var pos = {
        x: 0,
        y: 0
    };
    var ratio = 0.15;
    var active = false;
    var ball = document.querySelector('.element-item');
    TweenLite.set(ball, {
        xPercent: -50,
        yPercent: -50
    });
    document.addEventListener("mousemove", mouseMove);
    function mouseMove(e) {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        mouse.x = e.pageX;
        mouse.y = e.pageY - scrollTop;
    }
    TweenMax.ticker.addEventListener("tick", updatePosition);
    function updatePosition() {
        if (!active) {
            pos.x += (mouse.x - pos.x) * ratio;
            pos.y += (mouse.y - pos.y) * ratio;
            TweenMax.set(ball, {
                x: pos.x,
                y: pos.y
            });
        }
    }
}
//  menu  ------------------
$(".nav-button-wrap").on("click", function () {
    $(".main-menu").toggleClass("vismobmenu");
});
function mobMenuInit() {
    var ww = $(window).width();
    if (ww < 1064) {
        $(".menusb").remove();
        $(".main-menu").removeClass("nav-holder");
        $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
        $(".menusb").menu();
    } else {
        $(".menusb").remove();
        $(".main-menu").addClass("nav-holder");
    }
}
mobMenuInit();
$("#menu2").menu();
$(".sliding-menu li a.nav").parent("li").addClass("submen-dec");
var $window = $(window);
$window.on("resize", function () {
    mobMenuInit();
});
//   load animation------------------
function contentAnimShow() {
    $('.main-header nav li').addClass("parlink");
    $('.main-header nav li > ul li ,.main-header nav li   ul li > ul li ').removeClass("parlink");
    $('.main-header  nav  a').removeClass('act-link');
    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    $("a.ajax").each(function () {
        if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
            $(this).addClass("act-link");
    });
    if ($(".main-header nav li > a").hasClass("act-link")) {
        $(".main-header nav li ul li > a.act-link").parents(".main-header nav li.parlink").find("a").addClass("act-link");
    }
    $(".content-holder").addClass("hid-conh");
    $(".pl-spinner").addClass("act-loader");
    hideSb();
    $(".main-menu").removeClass("vismobmenu");
}

function contentAnimHide() {
    setTimeout(function () {
        $(".content-holder").removeClass("hid-conh");
    }, 500);
    setTimeout(function () {
        $("html, body").animate({
            scrollTop: 0
        }, {
            queue: true,
            duration: 10,
        });
        $(".progress-bar").css({
            width: 0 + "%"
        });
    }, 120);
    setTimeout(function () {
        $(".pl-spinner").removeClass("act-loader");
    }, 800);
}
$('a.ajax').on('click', function () {
    $('nav li a').removeClass('act-link');
    $(this).addClass('act-link');
});
//   mailchimp------------------
$("#subscribe").ajaxChimp({
    language: "eng",
    url: "https://gmail.us1.list-manage.com/subscribe/post?u=1fe818378d5c129b210719d80&amp;id=a2792f681b"
});
$.ajaxChimp.translations.eng = {
    submit: "Submitting...",
    0: '<i class="fal fa-check"></i> We will be in touch soon!',
    1: '<i class="fal fa-exclamation-circle"></i> You must enter a valid e-mail address.',
    2: '<i class="fal fa-exclamation-circle"></i> E-mail address is not valid.',
    3: '<i class="fal fa-exclamation-circle"></i> E-mail address is not valid.',
    4: '<i class="fal fa-exclamation-circle"></i> E-mail address is not valid.',
    5: '<i class="fal fa-exclamation-circle"></i> E-mail address is not valid.'
};
// twitter ------------------
if ($("#footer-twiit").length > 0) {
    var config1 = {
        "profile": {
            "screenName": 'Machooos_wed'
        },
        "domId": 'footer-twiit',
        "maxTweets": 2,
        "enableLinks": true,
        "showImages": false
    };
    twitterFetcher.fetch(config1);
}
var sbo = $(".sb-overlay"),
    sb = $(".sidebar-wrap"),
    sbb = $(".sb-button"),
    sbw = $(".sb-widget-wrap"),
    rrq = $(".r_sbb");
    sbr = $("#closeSidebar");
    
function showSb() {
    // alert("1");
    sbo.fadeIn(500);
    sb.addClass("vis-sb");
    sbb.removeClass("c_sb").addClass("r_sbb");
    setTimeout(function () {
        sbw.each(function (ab) {
            var bp3 = $(this);
            setTimeout(function () {
                TweenMax.to(bp3, 0.9, {
                    force3D: true,
                    y: "0",
                    opacity: "1",
                    ease: Power2.easeOut
                });
            }, 110 * ab);
        });
    }, 500);
}
function hideSb() {
    // alert("2");
    sb.removeClass("vis-sb");
    sbb.addClass("c_sb").removeClass("r_sbb");
    setTimeout(function () {
        TweenMax.to(sbw, 0.9, {
            force3D: true,
            y: "50px",
            opacity: "0",
            ease: Power2.easeOut
        });
    }, 300);
    sbo.fadeOut(500);
}
sbb.on("click", function () {
    // console.log($(this));
    // if ($(this).hasClass("c_sb")) showSb() ;
    if ($(this).hasClass("c_sb")) showSb();
    // else hideSb();
});
rrq.on("click", function () {
    sbb.removeClass("r_sbb");
    hideSb();
});
sbo.on("click", function () {
    hideSb();
});
sbr.on("click", function () {
    sbb.removeClass("r_sbb");
    hideSb();
});
$('head').append('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">');
document.addEventListener('gesturestart', function (e) {
    e.preventDefault();
});
//   Init Ajax------------------
$(function () {
    $.coretemp({
        reloadbox: "#wrapper",
        outDuration: 850,
        inDuration: 1
    });
    readyFunctions();
    $(document).on({
        ksctbCallback: function () {
            readyFunctions();
        }
    });
});
//   Init All Functions------------------
function readyFunctions() {
    initValik();
}

function getUserProjectlList(uId){

    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    var userId = $("#lsignatureAlbumUserId").val();
    // var userId = 13;
    // alert(userId);
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
    //   var imageList = "";
    
      var projList = resp["data"];
      var tabsTitle = "";
      var tabContents = "";
      var count = 0; 
    //   console.log(projList);
        if(projList != ""){
            // $("#signatureAlbumEmptyDataForUser").addClass("d-none");
            var htmlList = '';
            $.each(projList, function(key,value) {
               $("#eventCoverImage").attr("src","admin/"+value.image_path)
                var active = "";
                var tabTactive = "";
                var folder_name_str = "'"+value.folder_name+"'";
                var folder_name_str = "'"+value.file_folder+"'";
                // if(count == 0){
                //     active = "show active";
                //     tabTactive = "show active";
                //     getAlbumFiles(value.folder_name, value.user_id, value.id);
                // }
                // console.log("11111", value.user_id);
                var jjj = value.folder_name;

                var currentdate = Base64.encode(Date.now()+"_"+value.id );   
                                    // <!-- post-item-->
                htmlList += '<div class="col-sm-3" >';
                htmlList += '<div class="post-item_wrap fl-wrap">';
                htmlList += '<div class="post-item_media fl-wrap">';
                htmlList += '';
                htmlList += '<img src="admin/'+value.cover_img_path
                +'" alt="" width="100%"></div>';
                htmlList += '<div class="post-item_content fl-wrap">';
                // htmlList += '<div class="post-header fl-wrap"> <a href="#">Nature</a> <a href="#">Trip</a> </div>';
                
                
                htmlList += '<h3>'+value.project_name+'</h3>';
                htmlList += '<div class="post-opt fl-wrap">';
                htmlList += '<ul>';
                htmlList += '<li><i class="fal fa-comments-alt"></i> '+value.commentCount+' comments</li>';
                htmlList += '<li><span><i class="fal fa-eye"></i> '+value.viewCounts+' view</span></li>';
                htmlList += '<li><span><i class="fal fa-share"></i> '+value.shareCounts+' shares</span></li>';
                htmlList += '</ul>';
                htmlList += '</div>';


               

                    var date = new Date(value.planExpDate);
                    var CurrentDate = new Date();
                    


                    // Get year, month, and day part from the date
                    var year = date.toLocaleString("default", { year: "numeric" });
                    var month = date.toLocaleString("default", { month: "numeric" });
                    var day = date.toLocaleString("default", { day: "2-digit" });

                    var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;

                    var state = Base64.encode(Date.now()+"_"+1 ); 


                    if(date > CurrentDate){
                        htmlList += '<h4><i class="fal fa-hourglass-half text-success"></i> Your album will expire on '+formattedDate+' <a href="subscription_plans.php?id='+ currentdate +'&state='+ state +'" style="margin-left: 5px;" class="text-primary">EXTEND</a> </h4>';

                        htmlList += '<a href="signature_album_sa.php?pId='+currentdate+'" class="single-btn fl-wrap"><span>View Album</span></a>';
                    }else{
                        htmlList += '<h4 class="text-danger" ><i class="fal fa-hourglass-half text-danger"></i> Your album expired on '+formattedDate+' </h4>';

                        htmlList += '<a href="subscription_plans.php?id='+ currentdate +'&state='+ state +'" class="single-btn fl-wrap bg-success text-white"><span>Activate</span></a>';
                    }

             


                
                htmlList += '</div></div></div>';
                // var ddd = "'"+jjj.toString()+"'";
                // var name = jjj.trim().toString();
                // tabsTitle += '<li class="nav-item" role="presentation"><button class="nav-link '+active+'" id="'+value.folder_name+'-tab" data-bs-toggle="tab" data-bs-target="#'+value.folder_name+'" type="button" role="tab" aria-controls="'+value.folder_name+'" aria-selected="true" onclick="getAlbumFiles(\''+jjj+'\', '+value.user_id+', '+value.id+')" style="font-size: 20px;">'+value.folder_name+'</button></li>';
                // var images = getFilesFromFolder(value.file_folder, active, value.folder_name);
                // console.log(images);

                // tabContents += '<div class="tab-pane '+tabTactive+'" id="'+value.folder_name+'" role="tabpanel" aria-labelledby="'+value.folder_name+'-tab"> Upload photos/Drag Here ====== <div class="row mt-3">';
                // tabContents += '<div class="tab-pane fade '+tabTactive+'" role="tabpanel" id="'+value.folder_name+'"></div>';
                // tabContents += '</div></div>';
                count++;

            });

        }else{
            $("#userProjectListDivData").removeClass("d-none");
        }
    //   alert("#"+selectId);

      $("#userProjectListDiv").html(htmlList);
        // }, 2000);
      

    }
    data = { "function": 'SignatureAlbum',"method": "getSignatureAlbumsProjects", 'userId': userId };
    
    apiCall(data,successFn);
}

function getuSignatureAlbums(id) {
    var projIdString = Base64.decode(id);
    var arr = projIdString.split('_');
    var projId = arr[1];
    if(projId != ""){
        $("#signatureAlbumEmptyData").addClass("d-none");
        $("#signatureAlbumTabContent").removeClass("d-none");
        $("#projId").val(projId);
        $("#viewProjId").val(projId);
        getProjectComments(projId);
    }

    var userIdVal = $("#userIdVal").val();     

    successFn = function(resp)  {
    
      var users = resp["data"];
      var tabsTitle = "";
      var tabContents = "";
      var count = 0; 
      console.log(users);
        if(users != ""){

            var ValufolderName = "";
            var user = "";
            var albumId = "";

            $("#signatureAlbumEmptyDataForUser").addClass("d-none");
            $.each(users, function(key,value) {
               $("#eventCoverImage").attr("src","admin/"+value.cover_image_path);
            //   $("meta[property='og:image']").attr("content", "https://"+window.location.hostname +"/admin/"+value.cover_image_path);
            //   $("meta[property='og:url']").attr("content", window.location.href);

                // if(value.user_id == userIdVal){
                //     $("#BtoP").removeClass("d-none");
                // }else{
                //     $("#BtoP").addClass("d-none");
                // }

                var active = "";
                var tabTactive = "";
                var folder_name_str = "'"+value.folder_name+"'";
                var folder_name_str = "'"+value.file_folder+"'";
                if(count == 0){
                    active = "show active";
                    tabTactive = "show active";
                    // getAlbumFiles(value.folder_name, value.user_id, value.id);
                }
                console.log("11111", value.user_id);
                var jjj = value.folder_name;

                var valuefolder_name = value.folder_name.replace(/\s/g,'');

                // var ddd = "'"+jjj.toString()+"'";
                // var name = jjj.trim().toString();
                tabsTitle += '<li class="nav-item" role="presentation"><button class="nav-link '+active+'" id="b-'+value.id+'-tab" data-bs-toggle="tab" data-bs-target="#b-'+value.id+'" type="button" role="tab" aria-controls="b-'+value.id+'" aria-selected="true" onclick="getAlbumFiles(\''+jjj+'\', '+value.user_id+', '+value.id+')" style="font-size: 20px;">'+value.folder_name+'</button></li>';
                // var images = getFilesFromFolder(value.file_folder, active, value.folder_name);
                // console.log(images);
                var folder_name = value.folder_name+"_"+value.id;
                // tabContents += '<div class="tab-pane '+tabTactive+'" id="'+value.folder_name+'" role="tabpanel" aria-labelledby="'+value.folder_name+'-tab"> Upload photos/Drag Here ====== <div class="row mt-3">';
                tabContents += '<div class="tab-pane fade '+tabTactive+'" role="tabpanel" id="b-'+value.id+'"></div>';
                // tabContents += '</div></div>';
                if(count == 0){
                    ValufolderName = valuefolder_name;
                    user = value.user_id;
                    albumId = value.id;
                }
              
                count++;
            });
            
            $("#signatureAlbumTabContent").html(tabContents);
            
            getAlbumFiles(ValufolderName, user, albumId);
            
        }else{
            $("#signatureAlbumEmptyDataForUser").removeClass("d-none");
        }
    //   alert("#"+selectId);

      $("#signatureAlbumTabs").html(tabsTitle);
    //   setTimeout(function(){
      
        // }, 2000);
      

    }
   
    // data = { "function": 'SignatureAlbum',"method": "getSignatureAlbums", 'userId': userId };
    data = { "function": 'SignatureAlbum',"method": "getProjectEvents", 'projId': projId , 'addview':1 ,"userIdVal":userIdVal};
    // data = { "function": 'SignatureAlbum',"method": "getSignatureAlbumsProjects", 'userId': userId };
    
    apiCall(data,successFn);
}

function getAlbumFiles (folder, userId, albumId, startVal=1){

    var userIdVal = $("#userIdVal").val();
    var lsignatureAlbumUserId = $("#lsignatureAlbumUserId").val();
    
    var start = startVal;
    
    var tabContentsDiv = '<div id="masonryGallery'+albumId+'"></div>';
    
    $("#b-"+albumId).html(tabContentsDiv);
    
    // var file_folder = userId+"_"+folder;
    var img_folder = userId+"_"+folder;
    console.log("LogedUser id =======", img_folder);
    var file_folder = folder;
   
    if(userIdVal == userId){
        var data = { "function": 'SignatureAlbum',"method": "getFilesFromFolder", "folderName": img_folder, "albumId": albumId, "isHide":1, "start": start};
    }else{
        var data = { "function": 'SignatureAlbum',"method": "getFilesFromFolder", "folderName": img_folder, "albumId": albumId, "isHide":0, "isHide":1, "start": start};
    }

    


        $.ajax({
            url: "admin/ajaxHandler.php",
            type:"POST",
            data : data,
            async: true,
            success: function(result){
                
                result=JSON.parse(result);
                // console.log(result.data);
                var images = result.data;
                // var tabContents = '<div>'+file_folder+'</div>';
                
                // var tabContentsDiv = '';

                
                // tabContents += '<div class="grid-sizer"></div>';
                
                // tabContents += '<div class="gallery-items big-padding four-column fl-wrap">';
                // tabContents += '<div class="grid-wrapper" id="masonry">';
                
                
                // tabContents += '<div class="gallery-items big-padding four-column fl-wrap lightgallery">';
                // tabContents += '<div class="masonry" style="display: grid; gap: 10px; grid-template-columns: repeat(4, 1fr); grid-template-rows: masonry;">';
                
                var gdggd = 0;
                $.each(images, function(key1,value1) {
                    // console.log(value1);
                    var file_name = value1.file_name;
                    var file_path = value1.file_path;
                    var thumb_image_path = value1.thumb_image_path;
                    var thumb_img = "admin/"+thumb_image_path;
                    var img = "admin/"+file_path;
                    var tabContents = '';

                    if(value1.hide == 1){
                       
                        	
                       
                            tabContents += '<div class="grid-item">';
                            tabContents += '<a class="nav-link nav-profile d-flex align-items-center btPpop" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>';
                            tabContents += '<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">';

                            tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="'+img+'" target="_blank"><i class="bi bi-box-arrow-down"></i><span style="font-size: 12px; margin-left: 5px;">Download</span></a></li>';
                            tabContents += '<li><hr class="dropdown-divider"></li>';
        
                            tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="showPhoto('+value1.id+')"><i class="bi bi-eye"></i><span style="font-size: 12px; margin-left: 5px;">Show Photo</span></a></li>';
                            tabContents += '</ul>';
                            tabContents += '<a style="pointer-events: none; opacity: 0.4;" class="elem image" href="'+img+'" title="image 1" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="'+img+'"><img src="'+thumb_img+'" class=""></img></a>';
                            tabContents += '</div>';

                        // tabContents += '<div class="" >';
                        // tabContents += '<div class="">';

                        // tabContents += '<a class="nav-link nav-profile d-flex align-items-center btPpop" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>';

                        // tabContents += '<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">';

                        // tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="'+img+'" target="_blank"><i class="bi bi-box-arrow-down"></i><span style="font-size: 12px; margin-left: 5px;">Download</span></a></li>';
                        // tabContents += '<li><hr class="dropdown-divider"></li>';
        
                        // tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="showPhoto('+value1.id+')"><i class="bi bi-eye"></i><span style="font-size: 12px; margin-left: 5px;">Show Photo</span></a></li>';
                        // tabContents += '</ul>';
        
                        // tabContents += '<a style=" pointer-events: none; opacity: 0.4;" class="elem" href="'+img+'" title="image 1" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="'+img+'"><img src="'+thumb_img+'"></img></a>';
                        // tabContents += '</div>';
                        // tabContents += '</div>';



                    }else{
                        
                        
                            tabContents += '<div class="grid-item">';
                            tabContents += '<a class="nav-link nav-profile d-flex align-items-center btPpop" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>';
                            tabContents += '<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">';

                            tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="'+img+'" target="_blank"><i class="bi bi-box-arrow-down"></i><span style="font-size: 12px; margin-left: 5px;">Download</span></a></li>';
                            tabContents += '<li><hr class="dropdown-divider"></li>';
        
                            tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="hidePhoto('+value1.id+')"><i class="bi bi-eye-slash"></i><span style="font-size: 12px; margin-left: 5px;">Hide Photo</span></a></li>';
                            tabContents += '</ul>';
                            tabContents += '<a class="elem" href="'+img+'" title="image 1" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="'+img+'"><img src="'+thumb_img+'" class="image"></img></a>';
                            tabContents += '</div>';
                        
                    
                        // tabContents += '<div class="gallery-item outdoor">';
                        // tabContents += '<div class="grid-item-holder">';
                        // tabContents += '<a class="nav-link nav-profile d-flex align-items-center btPpop" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>';
                        // tabContents += '<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">';

                        // tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="'+img+'" target="_blank"><i class="bi bi-box-arrow-down"></i><span style="font-size: 12px; margin-left: 5px;">Download</span></a></li>';
                        // tabContents += '<li><hr class="dropdown-divider"></li>';
        
                        // tabContents += '<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="hidePhoto('+value1.id+')"><i class="bi bi-eye-slash"></i><span style="font-size: 12px; margin-left: 5px;">Hide Photo</span></a></li>';
                        // tabContents += '</ul>';
        
                        // tabContents += '<a class="elem" href="'+img+'" title="image 1" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="'+img+'"><img src="'+thumb_img+'"></img></a>';
                        // tabContents += '</div>';
                        // tabContents += '</div>';
                    }
                    
                    $("#masonryGallery"+albumId).append(tabContents);
                    
                    gdggd++;
                });
                // tabContents += '</ul>';
                
                // tabContents += '</div>';
                // tabContents += '</div>';
                // tabContents += '</div>';
                //  $("#masonryGallery"+albumId).justifiedGallery('norewind');
                 $("#masonryGallery"+albumId).justifiedGallery({ margins:0, lastRow : 'nojustify', rowHeight : 250});
                // setTimeout(function(){
                    // masonryInitialize();
                    // initValik();
                    // $("#b-"+albumId).html(tabContents);
                    // $("#masonryGallery"+albumId).justifiedGallery('norewind');
                    
                    // fecthMasonry("masonryGallery"+albumId, 'image', 4);
                    // var $grid = $("#masonryGallery"+albumId).imagesLoaded( function() {
                    //   $grid.masonry({
                    //     // columnWidth: 150,
                    //     itemSelector: '.grid-item',
                    //     percentPosition: true,
                    //     columnWidth: '.grid-sizer',
                    //   }); 
                    // });
                // },images.length*100)
                
                // console.log(tabContents)
               
            },
            error: function(result) {
                alert("Failed to list files");
            }
          });
          
}

function fecthMasonry(container, items, columns) {
    var CONTAINER_EL = document.querySelector("#" + container);
    var WRAPPER_CONTAINER_EL = CONTAINER_EL.parentNode;
    var ITEMS_ELS = document.querySelectorAll("." + items);
    CONTAINER_EL.parentNode.removeChild(CONTAINER_EL);
    var NEW_CONTAINER_EL = document.createElement('div');
    NEW_CONTAINER_EL.setAttribute('id', container);
    NEW_CONTAINER_EL.classList.add('masonry-layout', "columns-" + columns);
    WRAPPER_CONTAINER_EL.appendChild(NEW_CONTAINER_EL);
    for (var i = 1; i <= columns; i++) {
        var COLUMN = document.createElement('div');
        COLUMN.classList.add("masonry-column-" + i);
        NEW_CONTAINER_EL.appendChild(COLUMN);
    }
    var countColumn = 1;
    ITEMS_ELS.forEach(function (item) {
        var col = document.querySelector("#" + container + " > .masonry-column-" + countColumn);
        col.appendChild(item);
        countColumn = countColumn < columns ? countColumn + 1 : 1;
    });
}

function showPhoto(photoId){
    
    var projectId = getUrlParameter('pId');

    var projIdString = Base64.decode(projectId);
    var arr = projIdString.split('_');
    var projId = arr[1];

    Swal.fire({
        title: 'Please enter token',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Validate',
       
      }).then((result) => {
        if (result.isConfirmed) {
            if(result.value == ""){ 

                Swal.fire({
                    title: 'Please enter token',
                    confirmButtonText: 'Ok',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        showPhoto(photoId)
                    }
                  })

            } 
            else{

                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        // getWaitingApprovalComments();
                        // getProjectComments(viewProjId);
                        getuSignatureAlbums(projectId);
                        swal.fire({
                            icon: 'success',
                            title: "Successfully show image",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // $("#commentUserName").val("");
                        // $("#commentUserEmail").val("");
                        // $("#commentUserPhone").val("");
                        // $("#imogiText").val("")
                        // $('#commentReplayModal').modal('hide');

                    }else{
                        Swal.fire({
                            title: resp.data,
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            showPhoto(photoId)
                        }
                        })
                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }

                data = { "function": 'SignatureAlbum',"method": "showPhoto", 'photoId': photoId , 'token':result.value ,'projectId':projId};
    
                apiCall(data,successFn);

            }
        }
      })

    return false;


}





function hidePhoto(photoId){
    
    var projectId = getUrlParameter('pId');

    var projIdString = Base64.decode(projectId);
    var arr = projIdString.split('_');
    var projId = arr[1];

    Swal.fire({
        title: 'Please enter token',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Validate',
       
      }).then((result) => {
        if (result.isConfirmed) {
            if(result.value == ""){ 

                Swal.fire({
                    title: 'Please enter token',
                    confirmButtonText: 'Ok',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        hidePhoto(photoId)
                    }
                  })

            } 
            else{

                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        // getWaitingApprovalComments();
                        // getProjectComments(viewProjId);
                        getuSignatureAlbums(projectId);
                        swal.fire({
                            icon: 'success',
                            title: "Successfully hide image",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // $("#commentUserName").val("");
                        // $("#commentUserEmail").val("");
                        // $("#commentUserPhone").val("");
                        // $("#imogiText").val("")
                        // $('#commentReplayModal').modal('hide');

                    }else{
                        Swal.fire({
                            title: resp.data,
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            hidePhoto(photoId)
                        }
                        })
                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }

                data = { "function": 'SignatureAlbum',"method": "hidePhoto", 'photoId': photoId , 'token':result.value ,'projectId':projId};
    
                apiCall(data,successFn);

            }
        }
      })

    return false;


}
function downloadIage(img){
    // e.preventDefault();  //stop the browser from following
    window.location.href = img;
}
function masonryInitialize(){
    $('.rem-masonry').masonry({
        width: "160px",
        padding: "10px"
    });
}

var Base64 = {


    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

function viewcomments(){
    $('html, body').animate({
        scrollTop: eval($("#comentsDiv").offset().top - 90)
    }, 100);
}

function saveComments(){
   
    var viewProjId = $("#viewProjId").val();
    var commentId = $("#commentId").val();
    var commentUserName = $("#commentUserName").val();
    var commentUserEmail = $("#commentUserEmail").val();
    var commentUserPhone = $("#commentUserPhone").val();
    var imogiText = $("#imogiText").val();
    var confmMsg = "You want to save this comment";
    var successMsg = "Successfully saved comment";
    if(commentId !=""){
        confmMsg = "You want to update this comment";
        successMsg = "Successfully updated comment";
    }
    if(commentUserName == ""){
        $("#message").html("Name could not be empty !");
        $("#commentUserName").focus();
        return false;
    }else{
        $("#message").html("");
    }

    if(commentUserEmail == ""){
        $("#message").html("Email could not be empty !");
        $("#commentUserEmail").focus();
        return false;
    }else if(!IsEmail(commentUserEmail)){
        $("#message").html("Please enter a valid email !");
        $("#commentUserEmail").focus();
        return false;
    }else{
        $("#message").html("");
    }

    if(commentUserPhone == ""){
        $("#message").html("Phone number could not be empty !");
        $("#commentUserPhone").focus();
        return false;
    }else if(!validatePhone(commentUserPhone)){
        $("#message").html("Please enter a valid phone number !");
        $("#commentUserPhone").focus();
        return false;
    }else{
        $("#message").html("");
    }

    if(imogiText == ""){
        $("#message").html("Comment could not be empty !");
        $("#imogiText").focus();
        return false;
    }else{
        $("#message").html("");
    }

    var form = $("#addComment");
    var formData = new FormData(form[0]);
    console.log(formData);
    formData.append('function', 'Comments');
    formData.append('method', 'saveComments');
    formData.append('save', "add");

    return new swal({
        title: "Are you sure?",
        text: confmMsg,
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getProjectComments(viewProjId);
                        // getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: successMsg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(commentId !=""){
                            $("#commentId").val("");
                            // $("#saveCommentsButton").removeClass("d-none");
                            // $("#updateCommentsButton").addClass("d-none");
                        }
                        
                        // $("#commentUserName").val("");
                        // $("#commentUserEmail").val("");
                        // $("#commentUserPhone").val("");
                        $("#imogiText").val("")
                        $("#imogiText").val("")
                        
                        // $('#commentReplayModal').modal('hide');

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }
    
                apiCallForm(formData,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
    

    // alert(imogiText);
}

function updateComment(commentId, viewProjId){
    
    var commentId = commentId;
    
    confmMsg = "You want to update this comment";
    successMsg = "Successfully updated comment";
    
    var imogiText = $("#commentsEditText_"+commentId).val();
  
    if(imogiText == ""){
        $("#message").html("Comment could not be empty !");
        $("#commentsEditText_"+commentId).focus();
        return false;
    }else{
        $("#message").html("");
    }

    

    return new swal({
        title: "Are you sure?",
        text: confmMsg,
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getProjectComments(viewProjId);
                        // getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: successMsg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(commentId !=""){
                            $("#commentDisplayDiv_"+commentId).removeClass("d-none");
                            $("#commentActions_"+commentId).removeClass("d-none");
                            $("#commentEditDiv_"+commentId).addClass("d-none");
                        }

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }
    
                data = { "function": 'Comments',"method": "updateMainComment", 'commentId': commentId, 'imogiText': imogiText };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function getProjectComments(projId){
    var loggedUserId = $("#loggedUserId").val();
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            $.each(data, function(key,value) {
                html += '<li class="comment" style="width: 100%;">';
                html += '<div class="comment-body" style="padding: 10px;">';
                html += '<div class="comment-author">';
                html += '<i class="bi bi-person-bounding-box" style="font-size: 40px;"></i>';
                html += '<cite class="fn" style="display: inline-block; margin-left: 20px;"><a>'+value.name+'</a><br><a style="font-family: \'Mukta\', sans-serif; font-style: normal; font-size: 12px;">'+dateFormat(value.created_in)+'</a></cite></div>';
                //html += '<div class="comment-meta"></div>';
                
                html += '<p id="commentDisplayDiv_'+value.id+'" style="font-size: 16px; padding-bottom: 0px; word-wrap: break-word;">'+value.comment+'</p>';
                
                html += '<div id="commentEditDiv_'+value.id+'" class="d-none" style="position: relative;">';
                html += '<textarea style="height: 100px; text-align: left;" name="commentsEditText_'+value.id+'" id="commentsEditText_'+value.id+'" rows="2" placeholder="Your reply:" data-emojiable="true">'+value.comment+'</textarea>';
                
                html += '<div style="text-align: right;"><button type="button" onclick="cancelCommentsUpdate('+value.id+');" class="btn" id="saveCommentsButton"><span>Cancel</span></button><button type="button" onclick="updateComment('+value.id+', '+value.project_id+');" class="btn" id="saveCommentsButton"><span>Update</span></button></div>';
                html += '</div>';
                
                // html += '<div class="comment-num">01.</div>';
                
                html += '<div class="row" id="commentActions_'+value.id+'">';
                html += '<div class="col-sm-12" style="text-align: right;" id="replyCommentbtnDiv_'+value.id+'">';
                if(loggedUserId !=""){
                    html += '<a href="javascript:void(0)" onclick="editMainComment('+value.id+');" style="margin-right: 15px;">Edit</a>';
                    html += '<a href="javascript:void(0)" onclick="deleteMainComment('+value.id+');" style="margin-right: 15px;">Delete</a>';
                }
                html += '<a href="javascript:void(0)" onclick="replyComment('+value.id+');">Reply</a>';
                html += '</div></div>';
                
                html += '<div class="row d-none" id="commentEditTextArea" >';
                html += '<div class="col-sm-12" id="replyCommentbtnDiv_'+value.id+'">';
                // html += '<textarea style="height: 100px;" name="commentsEditText_'+value.id+'" id="commentsEditText_'+value.id+'" rows="2" placeholder="Your reply:" data-emojiable="true" class="commentUpdate">'+value.comment+'</textarea>';
                
                html += '</div></div>';
                
                html += '<div id="replyCommentDiv_'+value.id+'" ></div>';

                html += '<div class="" id="commentReplyDiv_'+value.id+'">';
                html += '<ul class="commentlist clearafix" id=commentReplyUl_'+value.id+'></ul>';
                html += '</div>';
                html += '</div>';
                html += '</li>';
                getCommentReplys(value.id);
                
            });
        }else{
            html += '<li><div class="alert alert-danger" role="alert">No comments for view </div></li>';
        }
        $("#approvedCommentListUl").html(html);
        setTimeout(function () {
            window.emojiPicker = new EmojiPicker({
              emojiable_selector: '[data-emojiable=true]',
              assetsPath: './img/',
              popupButtonClasses: 'fa fa-smile-o'
            });
            window.emojiPicker.discover();
        },500);
        
    }
    data = { "function": 'Comments',"method": "getProjectComments", 'projId': projId };
    
    apiCall(data,successFn);
}

function cancelCommentsUpdate(commentId){
    $("#commentDisplayDiv_"+commentId).removeClass("d-none");
    $("#commentActions_"+commentId).removeClass("d-none");
    $("#commentEditDiv_"+commentId).addClass("d-none");
}

function deleteMainComment(commentId){
    var viewProjId = $("#viewProjId").val();
    return new swal({
        title: "Are you sure?",
        text: "Do you wish to delete this comment.",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getProjectComments(viewProjId);
                        // getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: "Successfully deleted the comment.",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                    
                }
                data = { "function": 'Comments',"method": "deleteProjectComment", 'commentId': commentId };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function editMainComment(commentId){
    successFn = function(resp)  {
        // console.log(resp.data);
        var data = resp.data;
        // var html = "";
        if(data != "" && data != null){
            console.log(data[0]);
            $("#commentDisplayDiv_"+commentId).addClass("d-none");
            $("#commentEditDiv_"+commentId).removeClass("d-none");
            $("#commentActions_"+commentId).addClass("d-none");
            // $('html, body').animate({
            //     scrollTop: eval($("#respond").offset().top - 90)
            // }, 100);
            // $("#commentId").val(commentId);
            // $("#commentUserName").val(data[0].name);
            // $("#commentUserEmail").val(data[0].email);
            // $("#commentUserPhone").val(data[0].phone);
            // $("#imogiText").val(data[0].comment);
        }
        // else{
        //     html += '<li><div class="alert alert-danger" role="alert">No comments for view </div></li>';
        // }
        // $("#commentReplyUl_"+commentId).html(html);
    }
    data = { "function": 'Comments',"method": "editComments", 'commentId': commentId };
    
    apiCall(data,successFn);
}

function getCommentReplys(commentId){
    var loggedUserId = $("#loggedUserId").val();
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            $.each(data, function(key,value) {
                html += '<li class="" style="width: 100%;">';
                html += '<div class="comment-body" style="padding: 5px 30px; background: #fff;">';
                html += '<div class="comment-author" style="top: 15px;">';
                html += '<i class="bi bi-person-circle" style="font-size: 30px;"></i>';
                html += '<cite class="fn" style="display: inline-block; margin-left: 20px;"><a>'+value.created_by+'</a></cite></div>';
                // html += '<div class="comment-meta"><h6><a>'+dateFormat(value.created_in)+'</a></h6></div>';
                html += '<p style="font-size: 16px; padding-bottom: 0px; word-wrap: break-word;">'+value.comment_reply+'</p>';
                if(loggedUserId !=""){
                    html += '<div class="row" id="commentReplayActions" style="text-align: right;" >';
                    html += '<div class="col-sm-12" id="replyCommentbtnDiv_'+value.id+'">';
                    // html += '<a href="javascript:void(0)" onclick="editMainComment('+value.id+');" style="margin-right: 15px;">Edit</a>';
                    html += '<a href="javascript:void(0)" onclick="deleteCommentReply('+value.id+', '+commentId+');">Delete</a>';
                    // html += '<a href="javascript:void(0)" onclick="replyComment('+value.id+');">Reply</a>';
                    html += '</div></div>';
                }
                // html += '<div class="comment-num">01.</div>';
                // html += '<div class="" style="text-align: left;"><a href="javascript:void(0)" onclick="replyComment('+value.id+');">Reply</a></div>';
                html += '</div>';
                html += '</li>';
                // getCommentReplys(value.id+);
            });
        }
        // else{
        //     html += '<li><div class="alert alert-danger" role="alert">No comments for view </div></li>';
        // }
        $("#commentReplyUl_"+commentId).html(html);
    }
    data = { "function": 'Comments',"method": "getCommentsReply", 'commentId': commentId };
    
    apiCall(data,successFn);
}

function deleteCommentReply(commentId, mainCommentId){
    var viewProjId = $("#viewProjId").val();
    return new swal({
        title: "Are you sure?",
        text: "Do you wish to delete this reply.",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getCommentReplys(mainCommentId);
                        // getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: "Successfully deleted the reply.",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                    
                }
                data = { "function": 'Comments',"method": "deleteCommentReply", 'commentId': commentId };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function replyComment(commentId){
   
    var logginUserName = $('#logginUserName').val();
    var userphonenumber = $('#userphonenumber').val();
    var useremail = $('#useremail').val();
    var loggedUserId = $('#loggedUserId').val();
    

    // alert(logginUserName);
    // $('#commentReplayModal').modal('show');
    // $("#commentHiddenId").val(commentId);
    $("#replyCommentbtnDiv_"+commentId).addClass('d-none');

    html = '<input type="hidden" value="'+commentId+'" id="commentHiddenId_'+commentId+'">';
    html += '<div class="single-post-comm">';
    html += '<div class="clearfix"></div>';
    html += '<div >';
    html += '<div class="pr-subtitle"> Reply to comment</div>';
    html += '<div class="section-separator fl-wrap sp2"><span></span></div>';
    html += '<div class="comment-reply-form clearfix">';
    html += '<div id="replyCommentErrormessage_'+commentId+'" class="text-danger" style="text-align: left;"></div>';
    html += '<form  class="custom-form" style="margin-top: 15px;">';
    html += '<fieldset>';
    html += '<div class="row">';
    if(loggedUserId ==""){
        html += ' <div class="col-md-4">';
        html += '   <input name="commentReplyUser_'+commentId+'" id="commentReplyUser_'+commentId+'" type="text" placeholder="Your Name*" value="'+logginUserName+'"/>';
        html += ' </div>';
        html += ' <div class="col-md-4">';
        html += '    <input name="commentReplyPhonenumber_'+commentId+'" id="commentReplyPhonenumber_'+commentId+'" type="text" placeholder="Phone*" value="'+userphonenumber+'"/>';
        html += ' </div>';
        html += ' <div class="col-md-4">';
        html += '    <input name="commentReplyEmail_'+commentId+'" id="commentReplyEmail_'+commentId+'" type="text" placeholder="Email Address*" value="'+useremail+'"/>';
        html += ' </div>';
    }
    html += '<div class="col-md-12 mainCommentFormTextarea">';
    html += '<textarea style="height: 100px; text-align: left;" name="commentsReplay_'+commentId+'" id="commentsReplay_'+commentId+'" rows="2" placeholder="Your reply:" data-emojiable="true"></textarea>';
    // html += ' <textarea name="commentsReplay_'+commentId+'" id="commentsReplay_'+commentId+'" placeholder="Your reply:" data-emojiable="true"></textarea>';
    html += ' </div>';
    html += '<div class="col-md-6">';
    html += '  <button type="button" onclick="cancelCommentReplyCopy('+commentId+');" class="btn"><span>cancel</span></button>';
    html += '  </div>';
    html += '<div class="col-md-6">';
    html += '  <button type="button" onclick="saveCommentReplyCopy('+commentId+');" class="btn"><span>Submit Comment</span></button>';
    html += '  </div>';
    html += '</div>';
    html += '  </fieldset>';               
    html += ' </form>';
    html += ' </div>';
    html += '</div>';
    html += ' </div>';

    $("#replyCommentDiv_"+commentId).html(html);
    setTimeout(function () {
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: './img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
    },200);
        
    
}

function cancelCommentReplyCopy(commentId){
    $("#commentsReplay_"+commentId).val("");
    $("#commentReplyUser_"+commentId).val("");
    $("#commentReplyEmail_"+commentId).val("");
    $("#commentReplyPhonenumber_"+commentId).val("");
    $("#replyCommentbtnDiv_"+commentId).removeClass('d-none');
    $("#replyCommentDiv_"+commentId).html("");
}

function saveCommentReplyCopy(commentId){
    var commentsReply = $("#commentsReplay_"+commentId).val();
    var commentReplyUser = $("#commentReplyUser_"+commentId).val();

    var commentReplyEmail = $("#commentReplyEmail_"+commentId).val();
    var commentReplyPhonenumber = $("#commentReplyPhonenumber_"+commentId).val();
  
    if(commentReplyUser == ""){
        $("#replyCommentErrormessage_"+commentId).html("Name could not be empty !");
        $("#commentReplyUser_"+commentId).focus();
        return false;
    }else{
        $("#replyCommentErrormessage_"+commentId).html("");
    }
    if(commentReplyPhonenumber == ""){
        $("#replyCommentErrormessage_"+commentId).html("Phone number could not be empty !");
        $("#commentReplyPhonenumber_"+commentId).focus();
        return false;
    }else{
        $("#replyCommentErrormessage_"+commentId).html("");
    }

    if(commentReplyEmail == ""){
        $("#replyCommentErrormessage_"+commentId).html("Email could not be empty !");
        $("#commentReplyEmail_"+commentId).focus();
        return false;
    }else{
        $("#replyCommentErrormessage_"+commentId).html("");
    }

    if(commentsReply == ""){
        $("#replyCommentErrormessage_"+commentId).html("Reply comment could not be empty !");
        $("#commentsReplay_"+commentId).focus();
        return false;
    }else{
        $("#replyCommentErrormessage_"+commentId).html("");
    }

    return new swal({
        title: "Are you sure?",
        text: "You want to post this comment",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        // getWaitingApprovalComments();
                        // getProjectComments(viewProjId);
                        getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: "Successfully posted comment",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#commentsReply_"+commentId).val("");
                        $("#commentReplyUser_"+commentId).val("");
                        $("#commentHiddenId_"+commentId).val("");
                        $("#commentReplyEmail_"+commentId).val("");
                        $("#commentReplyPhonenumber_"+commentId).val("");
                       // $('#commentReplayModal').modal('hide');
                       $("#replyCommentbtnDiv_"+commentId).removeClass('d-none');
                       $("#replyCommentDiv_"+commentId).html("");
                       getCommentReplys(commentId);

                    }
                }
                data = { "function": 'Comments',"method": "saveCommentsReply", 'commentId': commentId, "commentsReply": commentsReply, "created_by": commentReplyUser, "email": commentReplyEmail, "Phno": commentReplyPhonenumber};
    
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
    
}


function saveCommentReply(){
    var commentId = $("#commentHiddenId").val();
    var commentsReply = $("#commentsReply").val();
    var commentReplyUser = $("#commentReplyUser").val();

    if(commentReplyUser == ""){
        $("#replyCommentErrormessage").html("Name could not be empty !");
        $("#commentReplyUser").focus();
        return false;
    }else{
        $("#replyCommentErrormessage").html("");
    }

    if(commentsReply == ""){
        $("#replyCommentErrormessage").html("Reply comment could not be empty !");
        $("#commentsReplay").focus();
        return false;
    }else{
        $("#replyCommentErrormessage").html("");
    }

    return new swal({
        title: "Are you sure?",
        text: "You want to save this reply",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        // getWaitingApprovalComments();
                        // getProjectComments(viewProjId);
                        getCommentReplys(commentId)
                        swal.fire({
                            icon: 'success',
                            title: "Successfully saved reply",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#commentsReply").val("");
                        $("#commentReplyUser").val("");
                        $("#commentHiddenId").val("");
                        $('#commentReplayModal').modal('hide');

                    }
                }
                data = { "function": 'Comments',"method": "saveCommentsReply", 'commentId': commentId, "commentsReply": commentsReply, "created_by": commentReplyUser };
    
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
    
}

function dateFormat(d) {
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September","October", "November", "December"];
    var t = new Date(d);
    return monthNames[t.getMonth()] + ' ' +  t.getDate() + ', ' + t.getFullYear();
  }
  
function waitingforAprovalModal(){
    getWaitingApprovalComments();
    $('#viewCommentsModal').modal('toggle');
    
}

function getWaitingApprovalComments(){
    var viewProjId = $("#viewProjId").val();
    
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            
            $.each(data, function(key,value) {
                // console.log(value.id);
                html += '<li class="comment" style="width: 100%;">';
                html += '<div class="comment-body" style="margin: 0px; padding: 10px;">';
                html += '<cite class="fn"><a href="javascript:void(0)">'+value.name+'</a></cite>';
                html += '<div class="comment-meta"><h6><a href="#">'+dateFormat(value.created_in)+' </a></h6></div>';
                html += '<p style="font-size: 16px;">'+value.comment+'</p>';
                html += '<div style="text-align: right;">';
                html += '<button type="button" class="btn btn-danger" onclick="deleteComment('+value.id+')">Delete</button>';
                html += '<button type="button" class="btn btn-success" style="margin-left: 5px;" onclick="approveComment('+value.id+')">Approve</button>';
                html += '</div></div></li>';
            });

            
        }else{
            html += '<li><div class="alert alert-danger" role="alert">No comments for approval </div></li>';
            // $("#commentListUl").html(html);
        }
        $("#commentListUl").html(html);

    }
    errorFn = function(resp){
        console.log(resp);
    }
    data = { "function": 'Comments',"method": "getPendingComments", "projId" : viewProjId };
    apiCall(data,successFn,errorFn);
}

function approveComment(commentId){
    // alert(commentId);
    var viewProjId = $("#viewProjId").val();
    return new swal({
        title: "Are you sure?",
        text: "You want to approve this comment",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getProjectComments(viewProjId);
                        swal.fire({
                            icon: 'success',
                            title: resp.data,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                    }
                }
                data = { "function": 'Comments',"method": "approveComments", "commentId" : commentId };
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
}

function deleteComment(commentId){
    var viewProjId = $("#viewProjId").val();
    return new swal({
        title: "Are you sure?",
        text: "You want to delete this comment",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    console.log("rrerere");
                    if(resp.status == 1){
                        getWaitingApprovalComments();
                        getProjectComments(viewProjId);
                        swal.fire({
                            icon: 'success',
                            title: resp.data,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                    }
                }
                data = { "function": 'Comments',"method": "deleteComments", "commentId" : commentId };
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
}

function validatePhone(PhoneNo) {
    var a = PhoneNo;
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}

function showEnquiryform(){
    $('#enquiryModal').modal('show');
}

function copyUrl(){
    text = window.location.href;
    var dummy = document.createElement('input'),
    text = window.location.href;

    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    $('.toast').toast('show');
    // alert("Url coppied to clipboard. ")
}

function sendEnquiry(){
    // alert("sdsds");
    var eventUser = $("#eventUser").val();
    var eventUserEmail = $("#eventUserEmail").val();
    var eventType = $("#eventType").val();
    var eventDate = $("#eventDate").val();
    var eventWhere = $("#eventWhere").val();
    var guestsCount = $("#guestsCount").val();
    var comments = $("#comments").val();
    // var occasionType = [];
    // $('.occasionType:checked').each(function(i){
    //     occasionType[i] = $(this).val();
    // });

    if(eventUser == ""){
        $("#enquireErrmessage").html("Your name could not be empty !");
        $("#eventUser").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    if(eventUserEmail == ""){
        $("#enquireErrmessage").html("Email could not be empty !");
        $("#eventUserEmail").focus();
        return false;
    }else if(!IsEmail(eventUserEmail)){
        $("#enquireErrmessage").html("Please enter a valid email !");
        $("#eventUserEmail").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    if(eventType == ""){
        $("#enquireErrmessage").html("Plese select the event !");
        $("#eventType").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    if(eventDate == ""){
        $("#enquireErrmessage").html("Plese select the event date !");
        $("#eventDate").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    if(eventWhere == ""){
        $("#enquireErrmessage").html("Plese enter the event place !");
        $("#eventWhere").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    if(guestsCount == ""){
        $("#enquireErrmessage").html("Plese enter the guest count !");
        $("#guestsCount").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    // if(occasionType.length == 0){
    //     $("#enquireErrmessage").html("Plese select the occasion you want us to cover !");
    //     // $("#guestsCount").focus();
    //     return false;
    // }else{
    //     $("#enquireErrmessage").html("");
    // }

    if(comments == ""){
        $("#enquireErrmessage").html("Plese enter more about the event !");
        $("#comments").focus();
        return false;
    }else{
        $("#enquireErrmessage").html("");
    }

    var formData = new FormData();
     formData.append('function', 'Comments');
     formData.append('method', 'sendEnqiryMail');
     formData.append('save', "add");
     formData.append('eventUser', eventUser);
     formData.append('eventUserEmail', eventUserEmail);
     formData.append('eventType', eventType);
    //  formData.append('occasionType', occasionType);
     formData.append('eventDate', eventDate);
     formData.append('eventWhere', eventWhere);
     formData.append('guestsCount', guestsCount);
     formData.append('comments', comments);

    return new swal({
        title: "Are you sure?",
        text: "You want to approve this comment",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        // getWaitingApprovalComments();
                        // getProjectComments(viewProjId);
                        swal.fire({
                            icon: 'success',
                            title: resp.data,
                        });
                        
                    }

                    $("#enquiryModal").modal('hide');
                }
                // data = { "function": 'Comments',"method": "approveComments", "commentId" : commentId };
                // apiCall(data,successFn);
                apiCallForm(formData,successFn);
            }else{
                console.log("sdsds");
            }
    });
    // console.log(occasionType);
}
    
// var encode = document.getElementById('encode'),
//     decode = document.getElementById('decode'),
//     output = document.getElementById('output'),
//     input = document.getElementById('input');


// encode.onclick = function() {
//     output.innerHTML = Base64.encode(input.value);
// }
    
// decode.onclick = function() {
//     var $str = output.innerHTML;
//     output.innerHTML = Base64.decode($str);
// } 

