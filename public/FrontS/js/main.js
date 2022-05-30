// category nice select

function myFunction() {
    var x = document.getElementById("MyInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


jQuery(document).ready(function() {
    jQuery(document).ready(function() {
        jQuery('.titleWrapper').click(function() {
            var toggle = jQuery(this).next('div#descwrapper');
            jQuery(toggle).slideToggle("slow");
        });
        jQuery('.inactive').click(function() {
            jQuery(this).toggleClass('inactive active');
        });
    });

    // slider of home
    jQuery(".contant-application").slick({

        // normal options...
        infinite: false,
        slidesToShow: 5,
        slidesToscroll: 1,
        dots: false,
        autoplay: true,
        arrows: false,
        rtl: (document.querySelector("html").getAttribute('lang') == 'ar') ? true : false,
        // the magic
        responsive: [{

                breakpoint: 1425,
                settings: {
                    slidesToShow: 3,
                    infinite: true,
                }

            },

            {

                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    dots: false
                }

            }, {

                breakpoint: 300,
                settings: "unslick" // destroys slick

            }
        ]
    });
    // slider of home
    jQuery(".cont-banner").slick({

        // normal options...
        infinite: false,
        slidesToShow: 1,
        slidesToscroll: 1,
        dots: false,
        autoplay: true,
        arrows: true,
        rtl: (document.querySelector("html").getAttribute('lang') == 'ar') ? true : false,
        // the magic
        responsive: [{

                breakpoint: 1425,
                settings: {
                    slidesToShow: 3,
                    infinite: true,
                }

            },

            {

                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    dots: false
                }

            }, {

                breakpoint: 300,
                settings: "unslick" // destroys slick

            }
        ]
    });





    jQuery('select.nice-select').niceSelect();
});

// sidebar menu toggle

if (jQuery(window).width() < 992) {
    jQuery('.footer_menu').slideUp();
    jQuery(".heading-list").on('click', function() {
        jQuery(this).siblings(".footer_menu").slideToggle();


    });
}
// scroll top button
jQuery(function() {

    var scrollButton = jQuery('.go-top');

    jQuery(window).scroll(function() {

        if (jQuery(window).scrollTop() >= 500) {
            scrollButton.show();
        } else {
            scrollButton.hide();
        }
    });

    scrollButton.click(function() {
        jQuery('html, body').animate({ scrollTop: 0 });
    })
});



setTimeout(function() {
    jQuery('.loader-container').fadeOut('slow');
}, 4000);

//cart  plus and minus
var numberSpinner = (function() {
    jQuery('.number-spinner>.ns-btn>a').click(function() {
        var btn = jQuery(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') === 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });

    jQuery(".icon-dark-cont i").click(function() {
        jQuery(".icon-dark-cont i").toggleClass("color")
        jQuery(".icon-dark-cont ").toggleClass("color-bl")
        jQuery("body").toggleClass("theme-white")
        jQuery("p").toggleClass("p-w")
        jQuery(".copyrights").toggleClass("theme-white")
        jQuery(".cont-ser").toggleClass("theme-white")

    })
})();