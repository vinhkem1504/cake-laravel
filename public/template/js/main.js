/*  ---------------------------------------------------
    Theme Name: Cake
    Description: Cake e-commerce tamplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';
function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}
function validateAddress(isRegister) {
    var address = document.getElementById('address').value;
    if (address == "") {
        document.getElementById('result_address').style.display = 'none';
        isRegister = true;
    }
}
function validatePhone(isRegister) {
    var phoneRGEX = /^\d{10}$/;
    var phone = document.getElementById('phone').value;
    //phone    
    if (!phoneRGEX.test(phone)) {
        document.getElementById('result_phone').style.display = 'block';
        document.getElementById('result_phone').innerHTML = "Please enter the phone number in the correct format consisting of 10 digits.";
        isRegister = false;
    } else {
        document.getElementById('result_phone').style.display = 'none';
        isRegister = true;
    }
    if (phone == "") {
        document.getElementById('result_phone').style.display = 'none';
        isRegister = true;
    }


}
function validateFirstName() {
    var nameRGEX = /^[a-zA-Z]+$/;
    var nameVN = /^[\p{L}\p{Mn}\p{Pd}\p{Zs}]+$/u;
    var firstName = document.getElementById('name').value;
    //first name    
    if (!nameRGEX.test(firstName) && !nameVN.test(firstName)) {
        document.getElementById('result_firstName').style.display = 'block';
        document.getElementById('result_firstName').innerHTML = "Please enter text only.";
        isRegister = false;
    } else {
        document.getElementById('result_firstName').style.display = 'none';
        isRegister = true;
    }
    if (firstName == "") {
        document.getElementById('result_firstName').style.display = 'none';
        isRegister = true;
    }
    return isRegister;

}
// function validateLastName(isRegister) {
//     var nameRGEX = /^[a-zA-Z]+$/;
//     var nameVN = /^[\p{L}\p{Mn}\p{Pd}\p{Zs}]+$/u;
//     var lastName = document.getElementById('last_name').value
//     //  last name
//     if (!nameRGEX.test(lastName) && !nameVN.test(lastName)) {
//         document.getElementById('result_lastName').style.display = 'block';
//         document.getElementById('result_lastName').innerHTML = "Please enter text only.";
//         isRegister = false;
//     }
//     else {
//         document.getElementById('result_lastName').style.display = 'none';
//         isRegister = true;
//     }
//     if (lastName == "") {
//         document.getElementById('result_lastName').style.display = 'none';
//         isRegister = true;
//     }
//     return isRegister
// }
function validateEmail(isRegister) {
    var emailRGEX = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var email = document.getElementById('email').value;
    //email
    if (!emailRGEX.test(email)) {
        document.getElementById('result_email').style.display = 'block';
        document.getElementById('result_email').innerHTML = "Please enter a valid email. Example: abcd@gmail.com";
        isRegister = false;
    }
    else {
        document.getElementById('result_email').style.display = 'none';
        isRegister = true;
    }
    if (email == "") {
        document.getElementById('result_email').style.display = 'none';
        isRegister = true;
    }
    return isRegister

}
function validatePassword(isRegister) {
    // password nhap 6 ki tu gom chu va so
    var passwordRGEX = /^(?=.*[a-zA-Z])(?=.*\d).+$/;
    var password = document.getElementById('password').value
    if (!passwordRGEX.test(password)) {
        document.getElementById('result_password').style.display = 'block';
        document.getElementById('result_password').innerHTML = "Please enter a password of 6 characters including letters and numbers.";
        isRegister = false;
    }
    else {
        document.getElementById('result_password').style.display = 'none';
        isRegister = true;
    }
    if (password == "") {
        document.getElementById('result_password').style.display = 'none';
        isRegister = true;
    }
    return isRegister
}

function checkPassword(isRegister){
    var confirm_password = document.getElementById('confirm_password').value
    var password = document.getElementById('password').value
    if(confirm_password != password) {
        document.getElementById('result_confirm_password').style.display = 'block';
        document.getElementById('result_confirm_password').innerHTML = 'Password does not match';
        isRegister = false;
    }
    else {
        document.getElementById('result_confirm_password').style.display = 'none';
        isRegister = true;
    }

    if (confirm_password == "") {
        document.getElementById('result_confirm_password').style.display = 'none';
        isRegister = true;
    }
    return isRegister

}

function checkEmptyInput(isRegister) {
    isRegister = true;
    var firstName = document.getElementById('name').value;
    var valFirstName = validateFirstName(isRegister);

    // var lastName = document.getElementById('last_name').value;
    // var valLastName = validateLastName(isRegister);

    var password = document.getElementById('password').value;
    var valPassword = validatePassword(isRegister);

    var confirm_password = document.getElementById('confirm_password').value;
    var valconfirm_password = checkPassword(isRegister);

    var email = document.getElementById('email').value;
    var valEmail = validateEmail(isRegister);
    if (firstName == '' || password == '' || email == '' || confirm_password == '') {
        isRegister = false;
    }
    if ((isRegister && valFirstName && valEmail && valPassword && valconfirm_password)) {
        document.getElementById('btn_register').classList.remove('btn_register');
        document.getElementById('btn_register').disabled = false;
    }
    else {
        document.getElementById('btn_register').classList.add('btn_register');
        document.getElementById('btn_register').disabled = true;

    }
}
function checkLogin(isLogIn) {
    isLogIn = true;
    var password = document.getElementById('password').value;
    var valPassword = validatePassword(isLogIn);

    var email = document.getElementById('email').value;
    var valEmail = validateEmail(isLogIn);
    if (password == '' || email == '') {
        isLogIn = false;
    }
    if ((isLogIn && valEmail && valPassword)) {
        document.getElementById('btn_register').classList.remove('btn_register');
        document.getElementById('btn_register').disabled = false;
    }
    else {
        document.getElementById('btn_register').classList.add('btn_register');
        document.getElementById('btn_register').disabled = true;

    }

}
function checkBill(isEmpty) {
    isEmpty = true;
    var firstName = document.getElementById('name').value;
    var valFirstName = validateFirstName(isRegister);

    // var lastName = document.getElementById('last_name').value;
    // var valLastName = validateLastName(isRegister);

    var email = document.getElementById('email').value;
    var valEmail = validateEmail(isRegister);

    var address = document.getElementById('address').value;
    var valAddress = validateAddress(isRegister);

    var phone = document.getElementById('phone').value;
    var valPhone = validatePhone(isRegister);
    if (firstName == '' || address == '' || email == '' || phone == '') {
        isEmpty = false;
    }
    if (isEmpty && valFirstName && valEmail && valPhone && valAddress) {
        document.getElementById('btn_register').classList.remove('btn_register');
        document.getElementById('btn_register').disabled = false;
    }
    else {
        document.getElementById('btn_register').classList.add('btn_register');
        document.getElementById('btn_register').disabled = true;

    }
}

function showInputChangePassword() {
    var checkbox = document.getElementById("diff-acc");
    if (checkbox.checked) {
        document.getElementById('new_password').classList.remove('hidden-input');
        document.getElementById('confirm_password').classList.remove('hidden-input');
    } else {
        document.getElementById('new_password').classList.add('hidden-input');
        document.getElementById('confirm_password').classList.add('hidden-input');
    }
}
const processChangeFirstName = debounce(() => validateFirstName());
// const processChangeLastName = debounce(() => validateLastName());
const processChangeEmail = debounce(() => validateEmail());
const processChangePassword = debounce(() => validatePassword());
const processChangePhone = debounce(() => validatePhone());
const processChangeAddress = debounce(() => validateAddress());
const processConfirmPassword = debounce(() => checkPassword());



(function ($) {

    // $('#register_form').on('submit', function (e) {
    //     e.preventDefault(); // Event.preventDefault sẽ đảm bảo rằng form không bao giờ được gửi
    // })

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    // show seller_info

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'><i/>", "<i class='fa fa-angle-right'><i/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*--------------------------
        Categories Slider
    ----------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 22,
        items: 5,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_carrot-left'><span/>", "<span class='arrow_carrot-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        responsive: {
            0: {
                items: 1,
                margin: 0
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });

    /*-----------------------------
        Testimonial Slider
    -------------------------------*/
    $(".testimonial__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 2,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            }
        }
    });

    /*---------------------------------
        Related Products Slider
    ----------------------------------*/
    $(".related__products__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_carrot-left'><span/>", "<span class='arrow_carrot-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
        }
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Magnific
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*------------------
        Barfiller
    --------------------*/
    $('#bar1').barfiller({
        barColor: '#111111',
        duration: 2000
    });
    $('#bar2').barfiller({
        barColor: '#111111',
        duration: 2000
    });
    $('#bar3').barfiller({
        barColor: '#111111',
        duration: 2000
    });


    /*------------------
        Single Product
    --------------------*/
    $('.product__details__thumb img').on('click', function () {
        $('.product__details__thumb .pt__item').removeClass('active');
        $(this).addClass('active');
        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.big_img').attr('src');
        if (imgurl != bigImg) {
            $('.big_img').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });



    $(".product__details__thumb").niceScroll({
        cursorborder: "",
        cursorcolor: "rgba(0, 0, 0, 0.5)",
        boxzoom: false
    });

})(jQuery);