$(window).on('load', function () {
    $('.flexslider').flexslider({
        animation: "slide",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });
});
jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });

    var navoffeset = $(".agileits_header").offset().top;
    $(window).scroll(function () {
        var scrollpos = $(window).scrollTop();
        if (scrollpos >= navoffeset) {
            $(".agileits_header").addClass("fixed");
        } else {
            $(".agileits_header").removeClass("fixed");
        }
    });

    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this).stop(true, true).slideDown("fast");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this).stop(true, true).slideUp("fast");
            $(this).toggleClass('open');
        }
    );
    $().UItoTop({easingType: 'easeOutQuart'});

    paypal.minicart.render();

    paypal.minicart.cart.on('checkout', function (evt) {
        var items = this.items(),
            len = items.length,
            total = 0,
            i;

        // Count the number of each item in the cart
        for (i = 0; i < len; i++) {
            total += items[i].get('quantity');
        }

        if (total < 3) {
            alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
            evt.preventDefault();
        }
    });

    $(document).on('click','.add-to-cart', function () {
        var pr = $(this).attr('data-id');
        var qty = 1;

        if ($('.input-qty').length > 0) {
            qty = $('.input-qty').val();
        }

        $.ajax({
            'url': '/en/cart/add-to-cart',
            'method': 'POST',
            data: {
                'id': pr,
                'qty': qty
            },
            success: function (data) {
                if (data) {
                    $('.popup').html('<div>' + 'Product successfully added to cart.' + '</div>' + '<div>' + '<a href="/cart/checkout">View your cart</a>' + '</div>').show();

                    setTimeout(function () {
                        $('.popup').hide();
                    }, 5000);

                }

            }
        });
    });

    $('.close').click(function () {

        var id = $(this).closest('tr').attr('data-id');
        $.ajax({
            'url': '/en/cart/remove',
            'method': 'post',
            data: {
                'id': id
            },
            success: function (data) {
                if (data) {
                    $('tr[data-id=' + id + ']').remove();
                    $('.checkout-left-basket ul li[data-id=' + id + ']').remove();
                }
            }
        })
    });

    $('.value-minus').click(function () {
        var id = $(this).closest('tr').attr('data-id');
        $.ajax({
            'url': '/en/cart/change-product-count',
            'method': 'POST',
            data: {
                'id': id,
                'action': 'minus'
            },
            success: function (data) {
                if (data) {
                    var result = JSON.parse(data);
                    if (result.qty == 0) {
                        $('tr[data-id=' + id + ']').remove();
                        $('.checkout-left-basket ul li[data-id=' + id + ']').remove();
                    } else {
                        $('tr[data-id=' + id + '] .quantity-select .value input').val(result.qty);
                        $('.checkout-left-basket ul li[data-id=' + id + '] > span').text('$' + result.sub_total.toFixed(2));
                        $('.total-price span').text('$' + result.total.toFixed(2));
                    }
                }
            }
        })
    })
    $('.value-plus').click(function () {
        var id = $(this).closest('tr').attr('data-id');

        $.ajax({
            'url': '/en/cart/change-product-count',
            'method': 'POST',
            data: {
                'id': id,
                'action': 'plus'
            },
            success: function (data) {
                if (data) {

                    var result = JSON.parse(data);
                    $('tr[data-id=' + id + '] .quantity-select .value input').val(result.qty);
                    $('.checkout-left-basket ul li[data-id=' + id + '] > span').text('$' + result.sub_total.toFixed(2));
                    $('.total-price span').text('$' + result.total.toFixed(2));

                }
            }
        })
    });

    $(document).on('change', '.pr-quantity', function () {
        var $this = $(this);
        var id = $(this).closest('tr').attr('data-id');
        $.ajax({
            'url': '/en/cart/change-product-count',
            'method': 'POST',
            data: {
                'id': id,
                'action': 'change',
                'qty': $this.val()
            },
            dataType: 'json',
            success: function (data) {

                if (data) {
                    $this.val(data.qty);
                    // console.log(data.sub_total);
                    $('.checkout-left-basket ul li[data-id=' + id + '] > span').text('$' + data.sub_total.toFixed(2));
                    if (!data.qty) {
                        $this.closest('tr').remove();
                        $('.checkout-left-basket ul li[data-id=' + id + ']').remove();
                    }
                    $('.total-price span').text('$' + data.total.toFixed(2));
                }
            }
        })
    });
    $(document).on('submit', '#blog-search-form form', function (ev) {
        ev.preventDefault();
        var $this = $(this);
        var textarea = $this.find('textarea');
        $.ajax({
            url: '/en/blog/add-comment',
            method: 'POST',
            data: $this.serialize(),
            dataType: 'json'
        }).done(function (data) {
            if (data.status = 'ok') {
                $('.comment-table').prepend('<p class="b-one">' + '@' + data.user_name + '</p>' + '<p>' + textarea.val() + '</p>' + '<p class="b-one">' + data.date + '</p>');
                textarea.val('');
            } else {
                console.warn(data.message)
            }
        }).fail(function (er) {
            console.warn(er.responseText)
        })
    });

    $('#collapseOne').fadeOut(0);

    $(document).on('click', '.panel-heading', function (ev) {

        $('#collapseOne').fadeToggle();

    })


});


