/*  ---------------------------------------------------
    Theme Name: Cake
    Description: Cake e-commerce tamplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';



/*Handle addcart */

var port = 'http://127.0.0.1';

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}
function validateAddress(isRegister) {
    isRegister = true;
    var address = document.getElementById('address').value;
    if (address == "") {
        document.getElementById('result_address').style.display = 'none';
        isRegister = false;
    }
    return isRegister;
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
    return isRegister;

}
function validateFirstName(isRegister) {
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
    var passwordRGEX = /^(?=.*[a-zA-Z])(?=.*\d).{6,}$/;
    var password = document.getElementById('account_password').value
    var new_password;
    if (document.querySelector('div #newPassword')) {
        new_password = document.getElementById('new_password').value
        //new_password
        if (!passwordRGEX.test(new_password)) {
            document.getElementById('result_new_password').style.display = 'block';
            document.getElementById('result_new_password').innerHTML = "Please enter a password of 6 characters including letters and numbers.";
            isRegister = false;
        }
        else {
            document.getElementById('result_new_password').style.display = 'none';
            isRegister = true;
        }
        if (new_password == "") {
            document.getElementById('result_new_password').style.display = 'none';
            isRegister = true;
        }

    }
    // else {
    // account_password
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
    // }
    return isRegister
}

function checkPassword(isRegister) {
    var confirm_password = document.getElementById('confirm_password').value
    var password = document.getElementById('account_password').value
    var new_password;
    if (document.querySelector('div #newPassword')) {
        new_password = document.getElementById('new_password').value
        if (confirm_password != new_password) {
            document.getElementById('result_confirm_password').style.display = 'block';
            document.getElementById('result_confirm_password').innerHTML = 'Password does not match';
            isRegister = false;
        } else {
            document.getElementById('result_confirm_password').style.display = 'none';
            isRegister = true;
        }
        if (confirm_password == "") {
            document.getElementById('result_confirm_password').style.display = 'none';
            isRegister = true;
        }
        return isRegister;
    } else {
        if (confirm_password != password) {
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

}

function checkEmptyInput(isRegister) {
    isRegister = true;
    var firstName = document.getElementById('name').value;
    var valFirstName = validateFirstName(isRegister);

    var password = document.getElementById('account_password').value;
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
    var password = document.getElementById('account_password').value;
    var valPassword = validatePassword(isLogIn);

    var email = document.getElementById('email').value;
    var valEmail = validateEmail(isLogIn);
    if (password == '' || email == '') {
        isLogIn = false;
    }
    if ((isLogIn && valEmail && valPassword)) {
        document.getElementById('btn_login').classList.remove('btn_register');
        document.getElementById('btn_login').disabled = false;
    }
    else {
        document.getElementById('btn_login').classList.add('btn_register');
        document.getElementById('btn_login').disabled = true;
    }

}
function checkBill(isEmpty) {
    isEmpty = true;
    var firstName = document.getElementById('name').value;
    var valFirstName = validateFirstName(isEmpty);

    // var lastName = document.getElementById('last_name').value;
    // var valLastName = validateLastName(isEmpty);

    var email = document.getElementById('email').value;
    var valEmail = validateEmail(isEmpty);

    var address = document.getElementById('address').value;
    var valAddress = validateAddress(isEmpty);

    var phone = document.getElementById('phone').value;
    var valPhone = validatePhone(isEmpty);
    if (address == '' || email == '' || phone == '') {
        isEmpty = false;
    }
    if (isEmpty && valEmail && valPhone && valAddress) {
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
        document.getElementById('accountPassword').classList.remove('hidden-input');
        document.getElementById('newPassword').classList.remove('hidden-input');
        document.getElementById('confirmPassword').classList.remove('hidden-input');
    } else {
        document.getElementById('accountPassword').classList.add('hidden-input');
        document.getElementById('newPassword').classList.add('hidden-input');
        document.getElementById('confirmPassword').classList.add('hidden-input');
    }
}

function checkUpdateUser(isUser) {
    isUser = true;
    var firstName = document.getElementById('name').value;
    var valFirstName = validateFirstName(isUser);

    var password = document.getElementById('account_password').value;
    var valPassword = validatePassword(isUser);

    var confirm_password = document.getElementById('confirm_password').value;
    var valconfirm_password = checkPassword(isUser);

    var new_password = document.getElementById('new_password').value;
    var valnew_password = checkPassword(isUser);

    if (firstName == '' || password == '' || new_password == '' || confirm_password == '') {
        isUser = false;
    }
    if ((isUser && valFirstName && valnew_password && valPassword && valconfirm_password)) {
        document.getElementById('btn_update').classList.remove('btn_register');
        document.getElementById('btn_update').disabled = false;
    }
    else {
        document.getElementById('btn_update').classList.add('btn_register');
        document.getElementById('btn_update').disabled = true;

    }

}

const processChangeFirstName = debounce(() => validateFirstName());
// const processChangeLastName = debounce(() => validateLastName());
const processChangeEmail = debounce(() => validateEmail());
const processChangePassword = debounce(() => validatePassword());
const processChangePhone = debounce(() => validatePhone());
const processChangeAddress = debounce(() => validateAddress());
const processConfirmPassword = debounce(() => checkPassword());

// phan trang - Home page
function handlePaginate(url) {
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            var dataContainer = $('.pagination_page').find('span');
            let a = `<span href="#">Page ${response.current_page}/${response.last_page}</span>`;
            dataContainer.html(a);

            var products = $('.product.spad').find('.container').find('.row');
            var item = '';
            $.each(response.data, function (i, product) {
                item += `<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                    style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                        <div class="product__label">
                            <span>${product.category_name}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.productname}</a></h6>
                        <div class="product__item__price">$${product.price_default}</div>
                        <div class="cart_add">
                            <a href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>`
            })
            products.html(item);
            $('#next_page').off('click').on('click', function () {
                if (response.current_page < response.last_page) {
                    handlePaginate(response.next_page_url);
                }
            });
            $('#previous_page').off('click').on('click', function () {
                if (response.current_page > 1) {
                    handlePaginate(response.prev_page_url);
                }
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function handlePaginateFilter(url, name) {
    $.post(url, { category_name: name }, function (response) {
        var dataContainer = $('.pagination_page').find('span');
        let a = `<span href="#">Page ${response.current_page}/${response.last_page}</span>`;
        dataContainer.html(a);

        var products = $('.product.spad').find('.container').find('.row');
        var item = '';
        $.each(response.data, function (i, product) {
            item += `<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                    style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                        <div class="product__label">
                            <span>${product.category_name}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.productname}</a></h6>
                        <div class="product__item__price">$${product.price_default}</div>
                        <div class="cart_add">
                            <a href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>`
        })
        products.html(item);

        $('#next_page').off('click').on('click', function () {
            if (response.current_page < response.last_page) {
                handlePaginateFilter(response.next_page_url, name);
            }
        });
        $('#previous_page').off('click').on('click', function () {
            if (response.current_page > 1) {
                handlePaginateFilter(response.prev_page_url, name);
            }
        });
    }, 'json');
}

//filter categories
function handleFilter(name) {
    $.post(`${port}:8000/categories`, { category_name: name }, function (response) {
        var dataContainer = $('.pagination_page').find('span');
        let a = `<span href="#">Page ${response.current_page}/${response.last_page}</span>`;
        dataContainer.html(a);

        var products = $('.product.spad').find('.container').find('.row');
        var item = '';
        $.each(response.data, function (i, product) {
            item += `<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                    style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                        <div class="product__label">
                            <span>${product.category_name}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.productname}</a></h6>
                        <div class="product__item__price">$${product.price_default}</div>
                        <div class="cart_add">
                            <a href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>`
        })
        products.html(item);

        $('#next_page').off('click').on('click', function () {
            if (response.current_page < response.last_page) {
                handlePaginateFilter(response.next_page_url, name);
            }
        });
        $('#previous_page').off('click').on('click', function () {
            if (response.current_page > 1) {
                handlePaginateFilter(response.prev_page_url, name);
            }
        });
    }, 'json');

}

function getDetailProduct(size, flavour, product_id) {
    $.post(`${port}:8000/productDetails`, { size: size, flavour: flavour, product_id: product_id }, function (response) {
        if (response.error == false) {
            $('.product__details__option').find('.primary-btn').css({ "background": "#f08632", "pointer-events": "auto", "cursor": "pointer" });
            $("#error_message").css("display", "none");
            var img = `<img class="big_img" src="${response.data[0].image}" alt="">`;
            var price = `<h5>$${response.data[0].price}</h5>`;
            $('.product__details__big__img').html(img);
            $('.product__details__text').find('h5').html(price).css({ 'border-bottom': 'none', 'padding-bottom': '0px' });
        } else {
            $('.product__details__option').find('.primary-btn').css({ "background": "#999", "pointer-events": "none", "cursor": "default" });
            $("#error_message").css("display", "block");
            $('#error_message').find('p').html(`<p style="color: red">Product sold out!</p>`);
        }

    }, 'json');
}

function handleRegister(name, email, password) {
    $.post(`${port}:8000/register`, { name: name, email: email, password: password }, function (response) {
        if (response.success === false) {
            $('.checkout__input').find('#result_email').css('display', 'block');
            $('.checkout__input').find('#result_email').text(`${response.error}`);
        } else {
            $('.status_register').css('display', 'block');
            $('.status_register').text(`${response.error}`);
            setTimeout(function () {
                $('.status_register').hide();
            }, 5000);
            $('#email').val("");
            $('#name').val("");
            $('#account_password').val("");
            $('#confirm_password').val("");
            $('#btn_register').prop('disabled', 'true');
            $('#btn_register').addClass("btn_register");
        }
    }, 'json');
}

/*Handle changeimage */
function handleImageChange(input) {
    const previewImage = document.getElementById('preview-image');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//show cart guest
function showCartFromLocal() {
    var cart = JSON.parse(localStorage.getItem('guestCart'));
    var quantity = cart.length;
    if (cart.listProducts) {
        var str = '';
        var total = 0;
        cart.listProducts.forEach(function (item) {
            str +=
                `
            <tr>
                <td class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img class="check-out-product-image" src="${item.image}" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <h6>${item.productname}</h6>
                        <h5 id="product-details-id-${item.product_details_id}-price">${item.price}</h5>
                    </div>
                </td>
                <td class="quantity__item">
                    <div class="quantity">
                        <div class="pro-qty" id="${item.product_details_id}">
                            <input type="text" value="${item.quanlity}" id="product-details-id-${item.product_details_id}">
                        </div>
                    </div>
                </td>
                <td class="cart__price" id="product-details-id-${item.product_details_id}-total-price">
                    ${+item.price * +item.quanlity}
                </td>
                <td class="cart__close"><span class="icon_close" onclick="handleDeleteOneTypeProduct(${item.product_details_id})"></span></td>
            </tr>
            `
            total += +item.quanlity * +item.price;
        })
        document.getElementById('displayTable').innerHTML = str;
        document.getElementById('total-cart-price').innerHTML = total;

        updateHeaderCart(quantity, total);
    }
}

//add cart guest
function handleAddToCart() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy token CSRF
    var checkBoxsSize = document.querySelectorAll('input[name="optional_size"]');
    var checkBoxsFlavour = document.querySelectorAll('input[name="optional_flavour"]');
    var product_id = document.querySelector('input[name="product_id"]').value;
    var size_id;
    var flavour_id;
    var quantity = document.querySelector('input[name="quantity"]').value;

    checkBoxsSize.forEach(element => {
        if (element.checked == true) {
            size_id = element.value;
        }
    });
    checkBoxsFlavour.forEach(element => {
        if (element.checked == true) {
            flavour_id = element.value;
        }
    });

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${port}:8000/cart/add`,
        data: {
            productId: product_id,
            sizeId: size_id,
            flavourId: flavour_id,
            quantity: quantity,
            _token: csrfToken
        },
        success: function (response) {
            if (response.guest) {
                var product = {
                    product_details_id: response.product_details_id,
                    productname: response.productname,
                    price: response.price,
                    image: response.image,
                    quanlity: response.quanlity
                }
                var cart = JSON.parse(localStorage.getItem('guestCart'));

                if (cart) {
                    if (checkExistProduct(product.product_details_id)) {
                        var total = 0;
                        var newCart = cart.listProducts.map(function (item) {
                            if (item.product_details_id === product.product_details_id) {
                                item.quanlity = +item.quanlity + +product.quanlity;
                            }
                            total += +item.price * +item.quanlity;
                            return item;
                        });

                        //   console.log('new', newCart);
                        localStorage.setItem('guestCart', JSON.stringify({ listProducts: newCart }));
                        var quantity = newCart.length;
                        // console.log('total', total, quantity);
                        updateHeaderCart(quantity, total);
                    }
                    else {
                        var newCart = { ...cart, listProducts: [...cart.listProducts, product] }
                        var total = JSON.parse(localStorage.getItem('total'));
                        localStorage.setItem('guestCart', JSON.stringify(newCart));
                        updateHeaderCart(newCart.listProducts.length, +total + +product.price);
                    }
                }
                else {
                    var newCart = {
                        listProducts: [product]
                    }
                    localStorage.setItem('guestCart', JSON.stringify(newCart));
                    updateHeaderCart(1, +product.price * +product.quanlity);
                }
            }
            else {
                var total = 0;
                var quantity = response.length;
                response.forEach(function (item) {
                    total += item.quanlity * item.price;
                })
                updateHeaderCart(quantity, total);
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
    //update header


    //show modal
    $('#openAlertNotication').click();
    setTimeout(function () {
        $("#alertDialog").modal("hide");
    }, 2000);
}

//deleteONeTypeProduct
function handleDeleteOneTypeProduct(detailsId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy token CSRF
    $.ajax({
        type: 'DELETE',
        dataType: 'json',
        url: `${port}:8000/cart/deleteOneTypeProduct`,
        // headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            detailsId: detailsId,
            _token: csrfToken
        },
        success: function (response) {
            var str = ''
            var total = 0
            if (response === 'guest') {
                var cart = JSON.parse(localStorage.getItem('guestCart'));
                var newCart = cart.listProducts.filter(function (item) {
                    return item.product_details_id !== detailsId;
                });
                var quantity = newCart.length;
                newCart.forEach((item) => {
                    str +=
                        `
                    <tr>
                        <td class="product__cart__item">
                            <div class="product__cart__item__pic">
                                <img class="check-out-product-image" src="${item.image}" alt="">
                            </div>
                            <div class="product__cart__item__text">
                                <h6>${item.productname}</h6>
                                <h5 id="product-details-id-${item.product_details_id}-price">${item.price}</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="pro-qty" id="${item.product_details_id}">
                                    <span class="dec qtybtn">-</span>
                                    <input type="text" value="${item.quanlity}" id="product-details-id-${item.product_details_id}">
                                    <span class="inc qtybtn">+</span>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price" id="product-details-id-${item.product_details_id}-total-price">
                            ${+item.price * +item.quanlity}
                        </td>
                        <td class="cart__close"><span class="icon_close" onclick="handleDeleteOneTypeProduct(${item.product_details_id})"></span></td>
                    </tr>
                    `
                    total += +item.quanlity * +item.price;
                })
                localStorage.setItem('guestCart', JSON.stringify({ listProducts: newCart }));
                updateHeaderCart(quantity, total);
            }
            else {
                var quantity = response.length;
                response.forEach((item) => {
                    str +=
                        `
                    <tr>
                        <td class="product__cart__item">
                            <div class="product__cart__item__pic">
                                <img class="check-out-product-image" src="${item.image}" alt="">
                            </div>
                            <div class="product__cart__item__text">
                                <h6>${item.productname}</h6>
                                <h5 id="product-details-id-${item.product_details_id}-price">${item.price}</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="pro-qty" id="${item.product_details_id}">
                                    <span class="dec qtybtn">-</span>
                                    <input type="text" value="${item.quanlity}" id="product-details-id-${item.product_details_id}">
                                    <span class="inc qtybtn">+</span>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price" id="product-details-id-${item.product_details_id}-total-price">
                            ${item.price * item.quanlity}
                        </td>
                        <td class="cart__close"><span class="icon_close" onclick="handleDeleteOneTypeProduct(${item.product_details_id})"></span></td>
                    </tr>
                    `
                    total += +item.quanlity * +item.price;
                })
            }

            document.getElementById('displayTable').innerHTML = str;
            document.getElementById('total-cart-price').innerHTML = total;
            updateHeaderCart(quantity, total);
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function checkExistProduct(productId) {
    var cart = JSON.parse(localStorage.getItem('guestCart'));
    var isProductExist = false; // Biến theo dõi trạng thái sự tồn tại của sản phẩm

    if (cart.listProducts) {
        $(cart.listProducts).each(function (index, product) {
            if (product.product_details_id === productId) {
                isProductExist = true;
                return false; // Dừng vòng lặp ngay sau khi tìm thấy sản phẩm
            }
        });
    }
    return isProductExist;
}

//update number and total cart in header
function updateHeaderCart(quantity, total) {
    console.log('*******************', quantity, total);
    document.getElementById('quantityOfProduct').innerHTML = quantity;
    document.getElementById('totalCartPrice').innerHTML = '$ ' + total;
    localStorage.setItem('total', total);
}

function updateHeaderCartTotal(total) {
    document.getElementById('totalCartPrice').innerHTML = '$ ' + total;
    localStorage.setItem('total', total);
}

function handleRegister(name, email, password) {
    $.post(`${port}:8000/register`, { name: name, email: email, password: password }, function (response) {
        if (response.success === false) {
            $('.checkout__input').find('#result_email').css('display', 'block');
            $('.checkout__input').find('#result_email').text(`${response.error}`);
        } else {
            $('.status_register').css('display', 'block');
            $('.status_register').text(`${response.error}`);
            setTimeout(function () {
                $('.status_register').hide();
            }, 1000);
            $('#email').val("");
            $('#name').val("");
            $('#account_password').val("");
            $('#confirm_password').val("");
            $('#btn_register').prop('disabled', 'true');
            $('#btn_register').addClass("btn_register");
        }
    }, 'json');
}

//hanld show Bill details
function showBillDetails(billId) {
    console.log(billId);

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: `${port}:8000/user/bills/${billId}`,
        success: function (response) {
            console.log('res', response)
            var str = '';
            var total = 0;
            response.forEach((product) => {
                str +=
                    `
                    <li><samp>${product.quanlity}</samp> ${product.productname + ' - ' + product.flavourValue + ' - ' + product.sizeValue} <span>$ ${+product.price * +product.quanlity}</span></li>
                `
                total += +product.price * +product.quanlity;
            })

            document.getElementById('current-bill-id').innerHTML = 'ID ' + billId;
            document.getElementById('bill-details-products').innerHTML = str;
            document.getElementById('bill-total').innerHTML = '$' + total;
        },
        error: function (err) {
            console.log(err)
        }
    })
}
function handleCancel(billId) {
    $(`#alertDialog-${billId}`).modal("show");

    $(`#confirmDialogButton-${billId}`).off("click");

    $(`#confirmDialogButton-${billId}`).click(function () {
        cancelBill(billId);
        $(`#alertDialog-${billId}`).modal("hide");
    })
    $("#closeDialogButton").click(function () {
        $(`#alertDialog-${billId}`).modal("hide");
    })
}

//handle cancel pending bill
function cancelBill(billId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'PUT',
        dataType: 'json',
        url: `${port}:8000/user/bills/cancel`,
        data: {
            billId: billId,
            _token: csrfToken
        },
        success: function (response) {
            if (response == 1) {
                document.getElementById(`status-bill-${billId}`).innerHTML = 'Cancel';
                document.getElementById(`status-bill-${billId}`).classList.remove('alert-warning');
                document.getElementById(`status-bill-${billId}`).classList.add('alert-danger');
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function handleRating(content, star) {
    var product_id = $('.product__details__text').find('.product__label').attr('id');
    $.post(`${port}:8000/createRate`, { description: content, value: star, product_id: product_id }, function (response) {
        if (response.success == true) {
            $('textarea').val("");
            $('input[name="rating"][type="radio"]').prop('checked', false);
            var count = $('#count_cmt').text();
            var number = parseInt(count) + 1;
            $('#count_cmt').text(number);
            showComment(product_id);
        } else {
            $('textarea').val(`${response.message}`);
            $('input[name="rating"][type="radio"]').prop('checked', false);
        }
    }, 'json');
}

function showComment(product_id) {
    $.ajax({
        url: `${port}:8000/ratingOf_${product_id}`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var dataContainer = $('.comment-list');
            var cmt = '';
            var sum = 0;
            if (response.data.length > 0) {
                $.each(response.data, function (i, item) {
                    sum += parseFloat(item.value);
                    console.log(sum);
                    cmt += `<li style="background-color: #c6c3c363; margin-top: 15px; padding-top: 10px; padding-bottom: 10px;">
                    <div class="col-lg-12">
                        <img src="${item.avatar_image ? item.avatar_image : '/template/img/user.png'}" width="30px" height="30px" style="border-radius: 100%; position:absolute; top: 0px"/>
                        <p id="user_cmt" style="margin-top: 20px; padding-left: 45px">${item.name}</p>
                        <p>${item.value} <img src="/template/img/shop/details/detail_options/star.png"/> | ${item.description}</p>
                        <p style="font-size: 12px">${item.created_at}</p>
                    </div>
                </li>`
                })
                dataContainer.html(cmt);
                $('#sum_star').text(`${(1.0 * sum) / response.data.length}`);
            }
            else {
                cmt = `<li style="background-color: #c6c3c363; margin-top: 15px; padding-top: 10px; padding-bottom: 10px;">
                    <div class="col-lg-12">
                    No comments yet
                    </div>
                </li>`;
                dataContainer.html(cmt);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    })
}


// phan trang - Page Shope
function handlePaginateShop(url) {
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            var dataContainer = $('.page_shop_pagination');
            let a = `<span href="#">Showing ${response.products.from}-${response.products.to} of ${response.count} results</span>`;
            dataContainer.html(a);

            var products = $('.shop.spad').find('.container').find('.products_list');
            var item = '';
            $.each(response.products.data, function (i, product) {
                item += `<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                    style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                        <div class="product__label">
                            <span>${product.category_name}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.productname}</a></h6>
                        <div class="product__item__price">$${product.price_default}</div>
                        <div class="cart_add">
                            <a href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>`
            })
            products.html(item);
            $('#next_page_shop').off('click').on('click', function () {
                if (response.products.current_page < response.products.last_page) {
                    handlePaginateShop(response.products.next_page_url);
                }
            });
            $('#previous_page_shop').off('click').on('click', function () {
                if (response.products.current_page > 1) {
                    handlePaginateShop(response.products.prev_page_url);
                }
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

(function ($) {

    // phan trang all products ở trang Home
    $(document).ready(function () {
        $.ajax({
            url: `${port}:8000/products`,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                var dataContainer = $('.pagination_page');
                let a = `<span href="#">Page ${response.current_page}/${response.last_page}</span>`;
                dataContainer.append(a);

                $('#next_page').on('click', function () {
                    if (response.current_page < response.last_page) {
                        handlePaginate(response.next_page_url);
                    }
                });
                $('#previous_page').on('click', function () {
                    if (response.current_page > 1) {
                        handlePaginate(response.prev_page_url);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    });

    $(document).ready(function () {
        $.ajax({
            url: `${port}:8000/paginationShop`,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log('current page: ' + response.products.current_page)
                var dataContainer = $('.page_shop_pagination');
                let a = `<span href="#">Showing ${response.products.from}-${response.products.to} of ${response.count} results</span>`;
                dataContainer.append(a);

                $('#next_page_shop').off('click').on('click', function () {
                    if (response.products.current_page < response.products.last_page) {
                        handlePaginateShop(response.products.next_page_url);
                    }
                });
                $('#previous_page_shop').off('click').on('click', function () {
                    if (response.products.current_page > 1) {
                        handlePaginateShop(response.products.prev_page_url);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });


    //filter categories
    $(document).ready(function () {
        $('.categories').find('h5').on('click', function () {
            var category_name = $(this).text();
            handleFilter(category_name);
        });
    });

    $(document).ready(function () {
        $('.categories').find('h5#all_products').on('click', function () {
            $.ajax({
                url: `${port}:8000/products`,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    var dataContainer = $('.pagination_page');
                    let a = `<span href="#">Page ${response.current_page}/${response.last_page}</span>`;
                    dataContainer.html(a);

                    var products = $('.product.spad').find('.container').find('.row');
                    var item = '';
                    $.each(response.data, function (i, product) {
                        item += `<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                    style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                        <div class="product__label">
                            <span>${product.category_name}</span>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">${product.productname}</a></h6>
                        <div class="product__item__price">$${product.price_default}</div>
                        <div class="cart_add">
                            <a href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>`
                    })
                    products.html(item);

                    $('#next_page').on('click', function () {
                        if (response.current_page < response.last_page) {
                            handlePaginate(response.next_page_url);
                        }
                    });
                    $('#previous_page').on('click', function () {
                        if (response.current_page > 1) {
                            handlePaginate(response.prev_page_url);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })
        });
    });

    $('.checkout__input__checkbox').find('input[type="radio"]').on('change', function () {
        var count = $('.checkout__input__checkbox').find('input[type="radio"]:checked').length;
        var size = $('.checkout__input__checkbox').find('input[name="optional_size"]:checked').val();
        var flavour = $('.checkout__input__checkbox').find('input[name="optional_flavour"]:checked').val();
        var product_id = $('.product__details__text').find('.product__label').attr('id');
        if (count === 2) {
            getDetailProduct(size, flavour, product_id);
        }
        if (size && flavour) {
            $('#cart').removeAttr("disabled");
            $('#cart').removeClass('btn_register');
        }
    })


    $(document).ready(function () {
        $('#btn_register').click(function () {
            var email = $('#email').val();
            var name = $('#name').val();
            var password = $('#account_password').val();
            handleRegister(name, email, password);
        });
    })

    // rating - cmt
    $(document).ready(function () {
        var product_id = $('.product__details__text').find('.product__label').attr('id');
        showComment(product_id);
        // $('#reload').on('click', function () {
        //     showComment(product_id);
        // })
    })

    //btn send comment
    $(document).ready(function () {
        $('#send_cmt').on('click', function () {
            var content = $('textarea').val();
            var star = $('input[name="rating"][type="radio"]:checked').val();
            if (content == "" || star == null) {
                $('textarea').val(`Please fill your comment or rating. Thank you!`);
                $('input[name="rating"][type="radio"]').prop('checked', false);
            } else {
                handleRating(content, star);
            }

        })
    })


    // search - Shop Page
    $(document).ready(function () {
        $('.shop__option__search').find('button').click(function () {
            var category_name = $('#title_select').val();
            var product_name = $('#search_shop').val();

            $.post(`${port}:8000/search_filter_shop`, { category_name: category_name, product_name: product_name }, function (response) {
                var dataContainer = $('.page_shop_pagination');
                // let a = `<span href="#">Showing ${response.products.from}-${response.products.to} of ${response.count} results</span>`;
                dataContainer.html("");
                var products = $('.shop.spad').find('.container').find('.products_list');
                if (response.data.length == 0) {
                    products.html('No products!')
                } else {
                    var item = '';
                    $.each(response.data, function (i, product) {
                        item += `<div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="${product.product_avt_iamge}"
                        style="background-image: url(&quot;${product.product_avt_iamge}&quot;);">
                            <div class="product__label">
                                <span>${product.category_name}</span>
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">${product.productname}</a></h6>
                            <div class="product__item__price">$${product.price_default}</div>
                            <div class="cart_add">
                                <a href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>`
                    })
                    products.html(item);
                }
            }, 'json');
        });
    })

    //active header
    $(document).ready(function () {
        var menuLinks = $('.header__menu.mobile-menu').find('li');

        menuLinks.each(function (event) {
            var hrefValue = $(this).find('a').attr('href');
            if (window.location.href === hrefValue) {
                menuLinks.removeClass('active');
                $(this).addClass('active');
            }
        });
    })


    $('#btn_login').click(function () {
        var email = $('#email').val();
        var password = $('#account_password').val();
        $.post(`${port}:8000/login`, { email: email, password: password }, function (response) {
            if (response.error == true) {
                console.log('failed to login');
                $('#check_login').css('display', 'block');
            } else {
                console.log('success to login');
                window.location.href = `${port}:8000/`
            }
        }, 'json');
    })

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

    function handleDec(id, csrfToken) {

        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            url: `${port}:8000/cart/deleteOneProduct`,
            // headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                detailsId: id,
                _token: csrfToken
            },
            success: function (response) {
                if (response === 'guest') {
                    var cart = JSON.parse(localStorage.getItem('guestCart'));

                    var newCart = cart.listProducts.map(function (item) {
                        // console.log('itemId',item.product_details_id)
                        if (item.product_details_id === +id) {
                            item.quanlity = +item.quanlity - 1;
                            //   console.log(item.quanlity)
                        }
                        return item;
                    });

                    // console.log('new', newCart);
                    localStorage.setItem('guestCart', JSON.stringify({ listProducts: newCart }));
                }
                var price = +parseFloat(document.getElementById(`product-details-id-${id}-price`).textContent).toFixed(1);
                var totalPrice = +parseFloat(document.getElementById(`product-details-id-${id}-total-price`).textContent).toFixed(1);
                var totalCart = +parseFloat(document.getElementById(`total-cart-price`).textContent).toFixed(1);
                document.getElementById(`product-details-id-${id}-total-price`).innerHTML = (totalPrice - price).toFixed(1);
                document.getElementById(`total-cart-price`).innerHTML = (totalCart - price).toFixed(1);
                updateHeaderCartTotal((totalCart - price).toFixed(1));
            },
            error: function (err) {
                console.log(err)
            }
        })
    }
    function handleInc(id, csrfToken) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: `${port}:8000/cart/addOneProduct`,
            // headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                detailsId: id,
                _token: csrfToken
            },
            success: function (response) {
                if (response === 'guest') {
                    var cart = JSON.parse(localStorage.getItem('guestCart'));

                    var newCart = cart.listProducts.map(function (item) {
                        // console.log('itemId',item.product_details_id)
                        if (item.product_details_id === +id) {
                            item.quanlity = +item.quanlity + 1;
                            //   console.log(item.quanlity)
                        }
                        return item;
                    });

                    // console.log('new', newCart);
                    localStorage.setItem('guestCart', JSON.stringify({ listProducts: newCart }));
                }
                var price = +parseFloat(document.getElementById(`product-details-id-${id}-price`).textContent).toFixed(1);
                var totalPrice = +parseFloat(document.getElementById(`product-details-id-${id}-total-price`).textContent).toFixed(1);
                var totalCart = +parseFloat(document.getElementById(`total-cart-price`).textContent).toFixed(1);
                // console.log(typeof price, typeof totalPrice, typeof totalCart);
                document.getElementById(`product-details-id-${id}-total-price`).innerHTML = (totalPrice + price).toFixed(1);
                document.getElementById(`total-cart-price`).innerHTML = (totalCart + price).toFixed(1);
                updateHeaderCartTotal((totalCart + price).toFixed(1));
            },
            error: function (err) {
                console.log(err)
            }
        })
    }
    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var $proQty = $button.closest('.pro-qty');
        var proQtyId = $proQty.attr('id');
        var oldValue = $button.parent().find('input').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
            handleInc(proQtyId, csrfToken)
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
                handleDec(proQtyId, csrfToken);
            } else {
                newVal = 1;
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