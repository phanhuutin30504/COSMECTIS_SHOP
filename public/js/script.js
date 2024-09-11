function openMenuMobile() {
    $(".menu-mb").width("250px");
    $(".btn-menu-mb").hide("slow");
}

function closeMenuMobile() {
    $(".menu-mb").width(0);
    $(".btn-menu-mb").show("slow");
}

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
//search

$(document).ready(function () {
    $("#search").on("keyup", function () {
        var query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: "/search",
                method: "GET",
                data: { query: query },
                success: function (data) {
                    $(".search-result").html(""); // Xóa kết quả cũ

                    if (data.length > 0) {
                        $(".search-result").addClass("show"); // Hiển thị khi có dữ liệu tìm kiếm

                        // Tạo một đối tượng NumberFormat cho định dạng tiền tệ
                        var currencyFormatter = new Intl.NumberFormat("vi-VN", {
                            style: "currency",
                            currency: "VND",
                            minimumFractionDigits: 0,
                        });

                        $.each(data, function (index, product) {
                            var itemHTML = `

                                <div class="search-item">
                                <a href="/product-detail/${product.id}" class="search-link">
                                    <img src="${window.location.origin}/${product.featured_image}" alt="${product.name}" class="product-image-search"/>
                                    <div class="product-info-search">
                                        <span>${product.name}</span>
                                    </div>
                                    <p class="product-price-search">Giá: ${currencyFormatter.format(product.price)}</p>
                                </a>
                            </div>

                            `;
                            $(".search-result").append(itemHTML);
                        });
                    } else {
                        $(".search-result").removeClass("show"); // Ẩn khi không có dữ liệu
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        } else {
            $(".search-result").removeClass("show"); // Ẩn khi chuỗi tìm kiếm quá ngắn
        }
    });

    $(document).mouseup(function (e) {
        var container = $(".search-result");

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass("show");
        }
    });
});

//end search
$(document).ready(function () {
    $("#province").change(function () {
        var provinceId = $(this).val();

        $("#district")
            .empty()
            .append('<option value="">Chọn quận/huyện</option>');
        $("#ward").empty().append('<option value="">Chọn phường/xã</option>');

        if (provinceId) {
            $.ajax({
                url: "/get-districts/" + provinceId,
                type: "GET",
                success: function (response) {
                    $.each(response, function (index, district) {
                        $("#district").append(
                            '<option value="' +
                                district.id +
                                '">' +
                                district.name +
                                "</option>"
                        );
                    });
                },
            });
        }
    });

    $("#district").change(function () {
        var districtId = $(this).val();

        $("#ward").empty().append('<option value="">Chọn phường/xã</option>');

        if (districtId) {
            $.ajax({
                url: "/get-wards/" + districtId,
                type: "GET",
                success: function (response) {
                    // Thêm các phường vào danh sách
                    $.each(response, function (index, ward) {
                        $("#ward").append(
                            '<option value="' +
                                ward.id +
                                '">' +
                                ward.name +
                                "</option>"
                        );
                    });
                },
            });
        }
    });
});
/// phí vận chuyển
$(document).ready(function () {
    $("#province").change(function () {
        var provinceId = $(this).val();

        $.ajax({
            url: "/get-shipping-fee", // Đặt route để lấy phí vận chuyển
            method: "GET",
            data: { province_id: provinceId },
            success: function (response) {
                var shippingFee = parseFloat(response.price);
                var totalPriceText = $("#total-price").text();

                // In ra nội dung của total-price để kiểm tra
                console.log("Total Price Text:", totalPriceText);

                // Xử lý để lấy số từ chuỗi
                var totalPrice = parseFloat(
                    totalPriceText.replace(/[₫.,]/g, "").replace(/[^0-9.]/g, "")
                );

                // In ra giá trị đã xử lý
                console.log("Processed Total Price:", totalPrice);
                // Cập nhật phí vận chuyển trên trang
                $("#shipping-fee-value").text(
                    response.price.toLocaleString("vi-VN")
                );
                var finalTotal = totalPrice + shippingFee;

                $("#final-total").text(
                    finalTotal.toLocaleString("vi-VN") + "₫"
                );
            },

            error: function (xhr) {
                console.error("Lỗi:", xhr.responseText);
            },
        });
    });
});

$(function () {
    //Validate register form
    $(".form-register, .reset-password").validate({
        rules: {
            // simple rule, converted to {required:true}
            fullname: {
                required: true,
                maxlength: 50,
                regex: /^[a-zAZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
            },
            mobile: {
                required: true,
                regex: /^0([0-9]{9,9})$/,
            },

            email: {
                required: true,
                maxlength: 50,
                email: true,
                // server trả về false là lỗi, true là không lỗi
                remote: "?c=customer&a=notExistingEmail",
            },

            password: {
                required: true,
                regex: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/,
            },

            password_confirmation: {
                required: true,
                equalTo: "[name=password]",
            },

            hiddenRecaptcha: {
                //true: lỗi
                //false: passed
                required: function () {
                    if (grecaptcha.getResponse() == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
        },

        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                maxlength: "Vui lòng nhập không quá 50 ký tự",
                regex: "Vui lòng nhập số và ký tự đặc biệt",
            },
            mobile: {
                required: "Vui lòng nhập số điện thoại",
                regex: "Vui lòng nhập 10 con số bắt đầu là 0",
            },
            email: {
                required: "Vui lòng nhập email",
                maxlength: "Vui lòng nhập không quá 50 ký tự",
                email: "Vui lòng nhập đúng định dạng email. vd: mailto:a@gmail.com",
                remote: "Email đã được đăng ký. Vui lòng nhập lại.",
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
                regex: "Mật khẩu ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt",
            },

            password_confirmation: {
                required: "Vui lòng nhập lại mật khẩu",
                equalTo: "Nhập lại mật khẩu phải trùng khớp",
            },
            hiddenRecaptcha: {
                required: "Vui lòng xác nhận Google reCAPTCHA",
            },
        },
    });
    // cập nhật
    $(".info-account").validate({
        rules: {
            // simple rule, converted to {required:true}
            fullname: {
                required: true,
                maxlength: 50,
                regex: /^[a-zAZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
            },
            mobile: {
                required: true,
                regex: /^0([0-9]{9,9})$/,
            },
            password: {
                regex: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/,
            },
            password_confirmation: {
                equalTo: "[name=password]",
            },
        },

        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                maxlength: "Vui lòng nhập không quá 50 ký tự",
                regex: "Vui lòng nhập đúng họ và tên",
            },
            // compound rule
            mobile: {
                required: "Vui lòng nhập số điện thoại",
                regex: "Vui lòng nhập đúng định dạng số điện thoại.vd: 0932538468",
            },
            password: {
                regex: "Mật khẩu phải ít nhất 8 ký tự bao gồm chữ hoa, chữ thường, số và ký tự đặt biệt. vd: 123456aA@",
            },
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp",
            },
        },
    });
    // đăng nhập
    $(".form-login").validate({
        rules: {
            // simple rule, converted to {required:true}
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Vui lòng nhập email",
                email: "Vui lòng nhập đúng định dạng email. vd: abc@gmail.com",
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
            },
        },
    });

    // comment
    $(".form-comment").validate({
        rules: {
            // simple rule, converted to {required:true}
            fullname: {
                required: true,
                maxlength: 50,
                regex: /^[a-zAZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
            },
            // compound rule
            email: {
                required: true,
                email: true,
            },

            description: {
                required: true,
            },
        },

        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                maxlength: "Vui lòng nhập không quá 50 ký tự",
                regex: "Vui lòng nhập đúng họ và tên",
            },

            email: {
                required: "Vui lòng nhập email",
                email: "Vui lòng nhập đúng định dạng email. vd: abc@gmail.com",
            },
            description: {
                required: "Vui lòng nhập nội dung",
            },
        },
        // submitHandler: function (form) {
        //     // alert($(form).serialize());
        //     $('.message').html('<i class="fas fa-spinner fa-spin"></i> Hệ thống đang gởi đán giá, vui lòng chờ ...');
        //     $('.message').show();//display:block
        //     $.ajax({
        //         type: "POST",
        //         url: "?c=product&a=storeComment",
        //         data: $(form).serialize(),
        //         success: function (response) {
        //             $('.comment-list').html(response);
        //             $('.message').empty();
        //             $('.message').hide();
        //             //reset form
        //             // form.reset();
        //             //chuyển input có value là 4 thành 4 sao
        //             $('main .product-detail .product-description .answered-rating-input').rating({
        //                 min: 0,
        //                 max: 5,
        //                 step: 1,
        //                 size: 'md',
        //                 stars: "5",
        //                 showClear: false,
        //                 showCaption: false,
        //                 displayOnly: false,
        //                 hoverEnabled: true
        //             });
        //         }
        //     });
        // }
    });

    //contact
    $(".form-contact").validate({
        rules: {
            // simple rule, converted to {required:true}
            fullname: {
                required: true,
                maxlength: 50,

                regex: /^[a-zAZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
            },
            // compound rule
            email: {
                required: true,
                email: true,
            },
            mobile: {
                required: true,
                regex: /^0([0-9]{9,9})$/,
            },
            content: {
                required: true,
            },
        },

        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                maxlength: "Vui lòng nhập không quá 50 ký tự",
                regex: "Vui lòng nhập đúng họ và tên",
            },
            // compound rule
            mobile: {
                required: "Vui lòng nhập số điện thoại",
                regex: "Vui lòng nhập đúng định dạng số điện thoại.vd: 0932538468",
            },
            email: {
                required: "Vui lòng nhập email",
                email: "Vui lòng nhập đúng định dạng email. vd: abc@gmail.com",
            },
            content: {
                required: "Vui lòng nhập nội dung",
            },
        },
        // submitHandler: function (form) {
        //     // alert($(form).serialize());
        //     $('.message').html('<i class="fas fa-spinner fa-spin"></i> Hệ thống đang gởi mail, vui lòng chờ ...');
        //     $('.message').show();//display:block
        //     $.ajax({
        //         type: "POST",
        //         url: "?c=contact&a=sendEmail",
        //         data: $(form).serialize(),
        //         success: function (response) {
        //             $('.message').html(response);
        //             //reset form
        //             // form.reset();
        //         }
        //     });
        // }
    });

    //Kiểm tra dữ liệu thỏa mãn mẫu hay không
    //Nếu không thì chuỗi Please check your input hiện ra
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );

    // Tìm kiếm theo range
    // $('main .price-range input').click(function (event) {
    //     / Act on the event /
    //     var price_range = $(this).val();
    //     // window.location.href = 'https://vnexpress.net';
    //     window.location.href = `?c=product&price-range=${price_range}`;
    //     //header("location: index.php?c=product&price-range=100000-200000")
    // });

    // Tìm kiếm và sắp xếp sản phẩm
    $("#sort-select").change(function (event) {
        var fullURL = getUpdatedParam("sort", $(this).val());
        window.location.href = fullURL;
    });

    $(".product-container").hover(function () {
        $(this).children(".button-product-action").toggle(400);
    });

    // Display or hidden button back to top
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $(".back-to-top").fadeIn();
        } else {
            $(".back-to-top").fadeOut();
        }
    });

    // Khi click vào button back to top, sẽ cuộn lên đầu trang web trong vòng 0.8s
    $(".back-to-top").click(function () {
        $("html").animate({ scrollTop: 0 }, 800);
    });

    // Hiển thị form đăng ký
    $(".btn-register").click(function () {
        $("#modal-login").modal("hide");
        $("#modal-register").modal("show");
    });

    // Hiển thị form forgot password
    $(".btn-forgot-password").click(function () {
        $("#modal-login").modal("hide");
        $("#modal-forgot-password").modal("show");
    });

    // Hiển thị form đăng nhập
    $(".btn-login").click(function () {
        $("#modal-login").modal("show");
    });

    // Fix add padding-right 17px to body after close modal
    // Don't rememeber also attach with fix css
    $(".modal").on("hide.bs.modal", function (e) {
        e.stopPropagation();
        $("body").css("padding-right", 0);
    });

    // Hiển thị cart dialog
    $(".btn-cart-detail").click(function () {
        $("#modal-cart-detail").modal("show");
    });

    // Hiển thị aside menu mobile
    $(".btn-aside-mobile").click(function () {
        $("main aside .inner-aside").toggle();
    });

    // Hiển thị carousel for product thumnail
    $(
        "main .product-detail .product-detail-carousel-slider .owl-carousel"
    ).owlCarousel({
        margin: 10,
        nav: true,
    });
    // Bị lỗi hover ở bộ lọc (mobile) & tạo thanh cuộn ngang
    // Khởi tạo zoom khi di chuyển chuột lên hình ở trang chi tiết
    // $('main .product-detail .main-image-thumbnail').ezPlus({
    //     zoomType: 'inner',
    //     cursor: 'crosshair',
    //     responsive: true
    // });

    // Cập nhật hình chính khi click vào thumbnail hình ở slider
    $("main .product-detail .product-detail-carousel-slider img").click(
        function (event) {
            /* Act on the event */
            $("main .product-detail .main-image-thumbnail").attr(
                "src",
                $(this).attr("src")
            );
            var image_path = $(
                "main .product-detail .main-image-thumbnail"
            ).attr("src");
            $(".zoomWindow").css(
                "background-image",
                "url('" + image_path + "')"
            );
        }
    );

    $("main .product-detail .product-description .rating-input").rating({
        min: 0,
        max: 5,
        step: 1,
        size: "md",
        stars: "5",
        showClear: false,
        showCaption: false,
    });

    $(
        "main .product-detail .product-description .answered-rating-input"
    ).rating({
        min: 0,
        max: 5,
        step: 1,
        size: "md",
        stars: "5",
        showClear: false,
        showCaption: false,
        displayOnly: false,
        hoverEnabled: true,
    });

    $("main .ship-checkout[name=payment_method]").click(function (event) {
        /* Act on the event */
    });

    $("input[name=checkout]").click(function (event) {
        /* Act on the event */
        window.location.href = "?c=payment&a=checkout";
    });

    $("input[name=back-shopping]").click(function (event) {
        /* Act on the event */
        window.location.href = "?c=product";
    });

    // Hiển thị carousel for relative products
    $("main .product-detail .product-related .owl-carousel").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 4,
            },
            1000: {
                items: 5,
            },
        },
    });
});

// Login in google
function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://study.com/register/google/backend/process.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        console.log("Signed in as: " + xhr.responseText);
    };
    xhr.send("idtoken=" + id_token);
}
// Cập nhật giá trị của 1 param cụ thể
function getUpdatedParam(k, v) {
    //sort, price-asc
    const fullUrl = window.location.href;
    const objUrl = new URL(fullUrl);
    objUrl.searchParams.set(k, v);
    return objUrl.toString();
}

// chuyển trang
function goToPage(page) {
    // ngăn không cho chạy href mặc định của thẻ a
    // event.preventDefault();
    const newURL = getUpdatedParam("page", page);
    window.location.href = newURL;
}

// Hiển thị cart

// function displayCart(data) {

//     //chuyển chuỗi dạng object thành object
//     var cart = JSON.parse(data);

//     var total_product_number = cart.total_product_number;
//     $(".btn-cart-detail .number-total-product").html(total_product_number);

//     var total_price = cart.total_price;
//     $("#modal-cart-detail .price-total").html(number_format(total_price) + "₫");
//     var items = cart.items;
//     console.log(items);
//     var rows = "";
//     for (let i in items) {
//         let item = items[i];
//         var row =
//             '<hr>' +
//             '<div class="clearfix text-left">' +
//             '<div class="row">' +
//             '<div class="col-sm-6 col-md-1">' +
//             '<div>' +
//             '<img class="img-responsive" src="../upload/' + item.img + '" alt="' + item.name + ' ">' +
//             '</div>' +
//             '</div>' +
//             '<div class="col-sm-6 col-md-3">' +
//             '<a class="product-name" href="index.php?c=product&a=detail&id=' + item.product_id + '">' + item.name + '</a>' +
//             '</div>' +
//             '<div class="col-sm-6 col-md-2">' +
//             '<span class="product-item-discount">' + number_format(Math.round(item.unit_price)) + '₫</span>' +
//             '</div>' +
//             '<div class="col-sm-6 col-md-3">' +
//             '<input type="hidden" value="1">' +
//             '<input type="number" onchange="updateProductInCart(this,' + item.product_id + ')" min="1" value="' + item.qty + '">' +
//             '</div>' +
//             '<div class="col-sm-6 col-md-2">' +
//             '<span>' + number_format(Math.round(item.total_price)) + '₫</span>' +
//             '</div>' +
//             '<div class="col-sm-6 col-md-1">' +
//             '<a class="remove-product" href="javascript:void(0)" onclick="deleteProductInCart(' + item.product_id + ')">' +
//             '<span class="glyphicon glyphicon-trash"></span>' +
//             '</a>' +
//             '</div>' +
//             '</div>' +
//             '</div>';
//         rows += row;
//     }
//     $("#modal-cart-detail .cart-product").html(rows);
// }

// function deleteProductInCart(product_id) {
//     $.ajax({
//         url: 'index.php?c=cart&a=delete',
//         type: 'GET',
//         data: { product_id: product_id }
//     })
//         .done(function (data) {
//             displayCart(data);

//         });
// }

// function deleteProductInCart(product_id) {
//     $.ajax({
//         url: '{{ route("cart.remove", ":product_id") }}'.replace(':product_id', product_id), // Cập nhật URL
//         type: 'POST', // Thay đổi từ GET thành POST
//         data: {
//             _token: '{{ csrf_token() }}', // Thêm CSRF token
//             product_id: product_id
//         },
//         success: function(data) {
//             displayCart(data); // Hiển thị lại giỏ hàng
//         },
//         error: function(xhr) {
//             console.error(xhr.responseText); // In lỗi ra console
//             alert('Có lỗi xảy ra khi xóa sản phẩm.');
//         }
//     });
// }

// Thay đổi số lượng sản phẩm trong giỏ hàng
// function updateProductInCart(self, product_id) {
//     var qty = $(self).val();
//     $.ajax({
//         url: 'index.php?c=cart&a=update',
//         type: 'GET',
//         data: { product_id: product_id, qty: qty }
//     })
//         .done(function (data) {
//             displayCart(data);

//         });
// }

// Cập nhật các option cho thẻ select
// function updateSelectBox(data, selector) {
//     var items = JSON.parse(data);
//     $(selector).find('option').not(':first').remove();
//     if (!data) return;
//     for (let i = 0; i < items.length; i++) {
//         let item = items[i];
//         let option = '<option value="' + item.id + '"> ' + item.name + '</option>';
//         $(selector).append(option);
//     }

// }
