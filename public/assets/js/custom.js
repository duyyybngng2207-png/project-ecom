(function ($) {
    "use strict";

    function showToast(message, type = 'success') {
        const toast = $('#liveToast');
        if (toast.length === 0) return;
        const colorMap = {
            success: 'bg-success text-white',
            danger: 'bg-danger text-white',
            warning: 'bg-warning text-dark',
            info: 'bg-info text-dark',
        };

        // Reset classes and apply new type
        toast.removeClass('bg-success bg-danger bg-warning bg-info text-white text-dark');
        toast.addClass(colorMap[type] || colorMap['info']);

        $('#toast-message').text(message);

        const bsToast = new bootstrap.Toast(toast[0], { delay: 3000 });
        bsToast.show();
    }



    $(document).ready(function () {

        let toast_message = sessionStorage.getItem('toast_message');
        let toast_type    = sessionStorage.getItem('toast_type');
        if (toast_message) {
            showToast(toast_message, toast_type);
            sessionStorage.removeItem('toast_message');
            sessionStorage.removeItem('toast_type');
        }

        
        $('#select-all').on('click', function () {
            $('input[name="input-wishlist"]').prop('checked', this.checked);
        });

        $('#save-wishlist').click(function (e) {
            e.preventDefault();
            
            let product_id = $(this).attr('data-id');
            $(this).find('.btn-wishlist').addClass('active-wishlist');

            $.ajax({
                url: 'ajax-save-wishlist',
                type: 'POST',
                dataType: 'json',          // Changed: expect JSON
                data: {
                    product_id
                }
            }).done(function (response) {
                showToast(response.message, response.status);
                $('.number-wishlist').text(response.count);
            }).fail(function () {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('.remove-all-wishlist, .remove-wishlist').click(function (e) {
            e.preventDefault();

            let list_product_id = $('.item-wishlist input[name="input-wishlist"]:checked').map(function () {
                return $(this).val();
            }).get();

            if (list_product_id.length === 0) {
                showToast('Please select at least one product.', 'danger');
                return;
            }

            $.ajax({
                url: 'ajax-remove-all-wishlist',
                type: 'POST',
                dataType: 'json',
                data: {
                    list_product_id: list_product_id 
                    }
            }).done(function (response) {
                if (response.status === 'success') {
                    list_product_id.forEach(function (product_id) {
                        $('[data-product="' + product_id + '"]').closest('.item-wishlist').fadeOut(300, function () {
                            $(this).remove();
                        });
                    });
                    $('.number-wishlist').text(response.count); 
                    showToast(response.message, response.status);
                } else {
                    showToast(response.message, response.status);
                }
            }).fail(function () {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $(document).off('click', '#quantity ~ .plus-cart').on('click', '#quantity ~ .plus-cart', function() {
                let $input = $(this).parent().find('input');
                let qty    = parseInt($input.val()) + 1;
                $input.val(qty);
            });

            $(document).off('click', '#quantity ~ .minus-cart').on('click', '#quantity ~ .minus-cart', function() {
                let $input = $(this).parent().find('input');
                let qty    = parseInt($input.val()) - 1;
                if (qty < 1) qty = 1;
                $input.val(qty);
            });

        $('#buy-product').click(function (e) {
            e.preventDefault();  

            let product_id = $(this).attr('data-id');
            let quantity = $('#quantity').val();

            $.ajax({
                url: 'ajax-save-shop-cart',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id,
                    quantity
                }
            }).done(function (response) {
                if (response.status === 'success') {
                    $('#header-dropdown-cart .item-cart').remove();
                    $('#header-dropdown-cart .border-bottom').before(response.htmlCartDropdown);
                    $('.cart-total').text('$' + response.total);
                    $('.number-cart').text(response.totalProducts);
                    $('.content-wishlist').html(response.htmlCartItems);
                    showToast(response.message, response.status);
                } else {
                    showToast(response.message, response.status);
                }
            }).fail(function () {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $(document).off('click', '#shop-cart .plus-cart').on('click', '#shop-cart .plus-cart', function() {
            let $input  = $(this).parent().find('input');
            let $item   = $(this).closest('.item-wishlist');
            let price   = parseFloat($item.find('.wishlist-price h4').text());
            let qty     = parseInt($input.val()) + 1;
            if (qty < 1) return ;
            
            $input.val(qty);

            updateCartTotal();

            $.ajax({
                url: 'ajax-update-cart-quantity',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: $input.data('product'),
                    quantity: qty
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    $item.find('.wishlist-action h4').text(response.subtotal);
                    $('.cart-total').text('$' + response.total);
                    $('.summary-cart .cart-total').text('$' + response.total);
                    $('.header-cart-total').text('$' + response.total);
                    $('.number-cart').text(response.count);
                    $('#header-dropdown-cart .item-cart').remove();
                    $('#header-dropdown-cart .border-bottom').before(response.htmlCartDropdown);
                    showToast(response.message, response.status);
                } else {
                    $input.val(parseInt($input.val()) - 1);
                    showToast(response.message, response.status);
                }
            });
        });

        $(document).off('click', '.minus-cart').on('click', '.minus-cart', function() {
            if ($(this).siblings('#quantity').length > 0) return;
            let $input  = $(this).parent().find('input');
            let $item   = $(this).closest('.item-wishlist');
            let price   = parseFloat($item.find('.wishlist-price h4').text());
            let qty     = parseInt($input.val()) - 1;
            if (qty < 1) return ;

            $input.val(qty);

            $.ajax({
                url: 'ajax-update-cart-quantity',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: $input.data('product'),
                    quantity: qty
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    $item.find('.wishlist-action h4').text(response.subtotal);
                    $('.cart-total').text('$' + response.total);
                    $('.summary-cart .cart-total').text('$' + response.total);
                    $('.header-cart-total').text('$' + response.total);
                    $('.number-cart').text(response.count);
                    $('#header-dropdown-cart .item-cart').remove();
                    $('#header-dropdown-cart .border-bottom').before(response.htmlCartDropdown);
                    showToast(response.message, response.status);
                } else {
                    $input.val(parseInt($input.val()) + 1);
                    showToast(response.message, response.status);
                }
            });
        });

        function updateCartTotal() {
            let total = 0;
            $('.wishlist-action h4').each(function() {
                total += parseFloat($(this).text()) || 0;
            });
            $('.cart-total').text('$' + total);
        }

        $('.btn-remove-cart').click(function(e) {
            e.preventDefault();
            let product_id = ($(this).data('product'));
            console.log('product_id:', product_id);
            console.log('tìm element:', $('a[data-product="' + product_id[0] + '"]').length);
            removeCartItems(product_id);
        });

        $('.remove-multi-cart').click(function(e) {
            e.preventDefault();

            let list_product_id = $('.item-wishlist input[name="input-cart"]:checked').map(function() {
                return $(this).val();
            }).get();

            if (list_product_id.length === 0) {
                showToast('Please select at least one product.', 'danger');
                return;
            }

            removeCartItems(list_product_id);
        });

        $('#btn-apply-coupon').click(function() {
            let code = $('#coupon-code').val();
            if(!code){
                showToast('Something went wrong. Please try again.', 'danger');
                return;
            }
            $.ajax({
                url: '/ajax-apply-coupon',
                type: 'POST',
                dataType: 'json',
                data: { code: code }
            }).done(function(response) {
                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    $('#coupon-message').html('<p class="text-success">-$' + response.discount + '</p>');
                    $('.cart-total').text('$' + response.total);
                    $('#btn-remove-coupon').removeClass('none');
                } else {
                    showToast(response.message, 'danger');
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#btn-remove-coupon').click(function() {
            $.ajax({
                url: '/ajax-remove-coupon',
                type: 'POST',
                dataType: 'json'
            }).done(function(response) {
                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    $('#coupon-message').html('');
                    $('#btn-remove-coupon').addClass('none');
                    $('#coupon-code').val('');
                    $('.cart-total').text('$' + response.total);
                }
            });
        });

        function removeCartItems(list_product_id) {
            if (!Array.isArray(list_product_id)) {
                list_product_id = [list_product_id];
            }
            $.ajax({
                url: 'ajax-remove-cart',
                type: 'POST',
                dataType: 'json',
                data: {
                    list_product_id: list_product_id 
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    list_product_id.forEach(function(product_id) {
                        $('[data-product="' + product_id + '"]')
                            .closest('.item-cart-product')
                            .fadeOut(300, function() {
                                $(this).remove();
                            });
                    });
                    $('.number-cart').text(response.count);
                    $('.cart-total').text('$'+response.total);
                    showToast(response.message, response.status);
                } else {
                    showToast(response.message, response.status);
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        }

        $(document).on('click', '.btn-add-to-cart', function(e) {
            e.preventDefault();

            let product_id = $(this).data('id');
            let quantity   = 1;

            $.ajax({
                url: '/ajax-save-shop-cart',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    quantity: quantity
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    $('.number-cart').text(response.totalProducts);
                    $('.cart-total').text('$' + Number(response.total).toLocaleString());
                    $('#header-dropdown-cart .item-cart').remove();
                    $('#header-dropdown-cart .border-bottom').before(response.htmlCartDropdown);
                    $('.content-wishlist').html(response.htmlCartItems);
                    showToast(response.message, response.status);
                } else {
                    showToast(response.message, response.status);
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#form-checkout').submit(function(e) {
            
            e.preventDefault();
            
            let firstname = $('input[name="firstname"]').val();
            let lastname  = $('input[name="lastname"]').val();
            let email     = $('input[name="email"]').val();
            let phone     = $('input[name="phone"]').val();
            let address1  = $('input[name="address1"]').val();
            let address2  = $('input[name="address2"]').val();
            let city      = $('input[name="city"]').val();
            let postcode  = $('input[name="postcode"]').val();

            $.ajax({
                url: '/shop-checkout',
                type: 'POST',
                dataType: 'json',
                data: {
                    firstname, lastname, email, phone, address1, address2, city, postcode 
                }
            }).done(function(response) {
                console.log('response:', response);
                console.log('status:', response.status);
                if (response.status === 'success') {
                    showToast(response.message, response.status);
                    sessionStorage.setItem('toast_message', response.message);
                    sessionStorage.setItem('toast_type', response.status);

                    setTimeout(function () {
                        window.location.href = '/';
                    }, 3000);
                } else {
                    showToast('Form is invalid!', 'danger');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    
                    // Duyệt qua các lỗi
                    const errors = response.message;
                    
                    $.each(errors, function(fieldName, errorMessages) {
                        const firstMessage = Object.values(errorMessages)[0];
                        
                        $(`[name="${fieldName}"]`)
                            .addClass('is-invalid')
                            .after(`<div class="invalid-feedback">${firstMessage}</div>`);
                    });
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#form-login').submit(function(e) {
            e.preventDefault();

            let email    = $('input[name="email"]').val();
            let password = $('input[name="password"]').val();

            $.ajax({
                url: '/page-login',
                type: 'POST',
                dataType: 'json',
                data: {
                    email, password 
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    sessionStorage.setItem('toast_message', response.message);
                    sessionStorage.setItem('toast_type', response.status);
                    window.location.href = '/shop-checkout';
                } else {
                    showToast('Login information does not match.', 'danger');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const errors = response.message;
                    
                    $.each(errors, function(fieldName, errorMessages) {
                    const firstMessage = Object.values(errorMessages)[0];
                    
                    $(`[name="${fieldName}"]`)
                        .addClass('is-invalid')
                        .after(`<div class="invalid-feedback">${firstMessage}</div>`);
                    });
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#form-register').submit(function(e) {
            e.preventDefault();

            let fullname         = $('input[name="fullname"]').val();
            let email            = $('input[name="email"]').val();
            let phone            = $('input[name="phone"]').val();
            let password         = $('input[name="password"]').val();
            let confirm_password = $('input[name="confirm_password"]').val();

            $.ajax({
                url: '/page-register',
                type: 'POST',
                dataType: 'json',
                data: {
                    fullname, email, password, phone, confirm_password
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    sessionStorage.setItem('toast_message', response.message);
                    sessionStorage.setItem('toast_type', response.status);
                    window.location.href = '/page-login';
                } else {
                    showToast('Registration information is incomplete.', 'danger');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const errors = response.message;
                    
                    $.each(errors, function(fieldName, errorMessages) {
                    const firstMessage = Object.values(errorMessages)[0];
                    
                    $(`[name="${fieldName}"]`)
                        .addClass('is-invalid')
                        .after(`<div class="invalid-feedback">${firstMessage}</div>`);
                    });
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#form-forgot').submit(function(e) {
            e.preventDefault();

            let email = $('input[name="email"]').val();

            $.ajax({
                url: '/page-forgot',
                type: 'POST',
                dataType: 'json',
                data: { email }
            }).done(function(response) {
                if (response.status === 'success') {
                    showToast(response.message, response.status);
                    sessionStorage.setItem('toast_message', response.message);
                    sessionStorage.setItem('toast_type', response.status);
                } else {
                    showToast('You have not entered your email yet', 'danger');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const errors = response.message;
                    
                    $.each(errors, function(fieldName, errorMessages) {
                    const firstMessage = Object.values(errorMessages)[0];
                    
                    $(`[name="${fieldName}"]`)
                        .addClass('is-invalid')
                        .after(`<div class="invalid-feedback">${firstMessage}</div>`);
                    });
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        $('#form-reset').submit(function(e) {
            e.preventDefault();

            let password         = $('input[name="password"]').val();
            let confirm_password = $('input[name="confirm_password"]').val();
            let token            = new URLSearchParams(window.location.search).get('token');

            $.ajax({
                url: '/page-reset?token=' + token,
                type: 'POST',
                dataType: 'json',
                data: { 
                    password, confirm_password 
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    showToast(response.message, response.status);
                    setTimeout(function() {
                        window.location.href = '/page-login';
                    }, 2000);
                } else {
                    showToast('Reset information is incomplete.', 'danger');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const errors = response.message;
                    
                    $.each(errors, function(fieldName, errorMessages) {
                    const firstMessage = Object.values(errorMessages)[0];
                    
                    $(`[name="${fieldName}"]`)
                        .addClass('is-invalid')
                        .after(`<div class="invalid-feedback">${firstMessage}</div>`);
                    });
                }
            }).fail(function() {
                showToast('Something went wrong. Please try again.', 'danger');
            });
        });

        let hoverTimer = null;
        let isLoading = false;
        let categoryCache = {};

        $('.list-nav-arrow li a').hover(
            function () {
                let category_id = $(this).data('id');
                let slug = $(this).data('slug');
                if (!category_id) return;

                clearTimeout(hoverTimer);

                hoverTimer = setTimeout(function () {

                    if (categoryCache[slug]) { //Check xem mình đã lấy data tab đó chưa
                        $('.product-tab').hide();
                        $(`[data-tab="${slug}"]`).show();
                        return;
                    }

                    if (isLoading) return;
                    isLoading = true;

                    $.ajax({
                        url: '/ajax-get-products-by-category',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            category_id: category_id,
                            slug: slug
                        }
                    }).done(function (response) {
                        if (response.status === 'success') {
                            $('#products-container').append(response.html);
                            categoryCache[slug] = true;
                            $('.product-tab').hide();

                            $(`[data-tab="${slug}"]`).show();
                        }
                    }).always(function () {
                        isLoading = false;
                    });

                }, 300); 
            },
            function () {
                clearTimeout(hoverTimer);
            }
        );

        // $('body').on('change', '.noUi-connect', function() {
        //     alert(1);
        //     let min_price = $('.min-value').val();
        //     let max_price = $('.max-value').val();
        //     console.log(min_price, max_price);
            
        //     $.ajax({
        //         url: '/products/filter-price',
        //         dataType: 'GET',
        //         data: {
        //             min_price, max_price 
        //         },
        //     }).done(function(response) {
        //         $('#product-grid').html(response);
        //     }).fail(function() {
        //         showToast('Something went wrong. Please try again.', 'danger');
        //     });
        // });

        $(document).ready(function () {
            $(".noUi-handle").on("click", function () {
                $(this).width(50);
            });

            var rangeSlider = document.getElementById("slider-range");
            var rangeSlider2 = $("#slider-range");

            if (rangeSlider2.length > 0) {
                var moneyFormat = wNumb({
                    decimals: 0,
                    thousand: ",",
                    prefix: "$"
                });

                if (!rangeSlider.noUiSlider) {
                    noUiSlider.create(rangeSlider, {
                        start: [16, 173],
                        step: 1,
                        range: {
                            min: [0],
                            max: [2000]
                        },
                        format: moneyFormat,
                        connect: true
                    });
                }

                let currentFilter = {
                    min_price: 0,
                    max_price: 2000,
                    sort: '',
                    limit: ''
                };

                function doFilter() {
                    $.ajax({
                        url: '/products/filter-price',
                        type: 'GET',
                        dataType: 'html',
                        data: currentFilter
                    }).done(function(response) {
                        $('#product-grid').html(response);
                    }).fail(function() {
                        showToast('Something went wrong. Please try again.', 'danger');
                    });
                }

                rangeSlider.noUiSlider.on("change", function(values) {
                    $(".min-value-money").html(values[0]);
                    $(".max-value-money").html(values[1]);

                    var min_price = moneyFormat.from(values[0]);
                    var max_price = moneyFormat.from(values[1]);

                    $(".min-value").val(min_price);
                    $(".max-value").val(max_price);

                    $('#price-checkbox input[type="checkbox"]').prop('checked', false);

                    currentFilter.min_price = moneyFormat.from(values[0]);
                    currentFilter.max_price = moneyFormat.from(values[1]);
                    doFilter();
                });

                $(document).on('click', '#price-checkbox input[type="checkbox"]', function() {
                    $('#price-checkbox input[type="checkbox"]').not(this).prop('checked', false);
                    rangeSlider.noUiSlider.set([0,0]);

                    $('.min-value-money').html('$0');
                    $('.max-value-money').html('$0');

                    let min_price = $(this).data('min');
                    let max_price = $(this).data('max');

                    currentFilter.min_price = $(this).data('min');
                    currentFilter.max_price = $(this).data('max');
                    doFilter();
                });

                $(document).on('click', '.dropdown-menu .dropdown-item', function(e) {
                e.preventDefault();
                let sort  = $(this).data('sort');
                let limit = $(this).data('limit');

                if (sort)  currentFilter.sort  = sort;
                if (limit) currentFilter.limit = limit;
                
                doFilter();
            });
            } 
        }); 
    });
})(jQuery);
