function checkAll(check_all) {
	$(check_all).change(function() {
	    var checkboxes = $(this).closest('table').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));
	});
}
// tự động thêm . số tiền

function formatNumber(value) {

    return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function unformatNumber(value) {

    return value.replace(/,/g, '');
}

document.getElementById('price').addEventListener('input', function(event) {
    this.value = formatNumber(this.value);
});


document.querySelector('form').addEventListener('submit', function(event) {
    var priceInput = document.getElementById('price');
    priceInput.value = unformatNumber(priceInput.value);
});

//validate xóa tất cả
$(document).ready(function() {


    // Gán sự kiện cho các nút "Xác nhận"
    $('.confirm-order-btn').on('click', function() {
        const orderId = $(this).data('order-id');
        confirmOrder(orderId);
    });

    // validate
    $('form#deleteForm').on('submit', function(e) {
        if ($('input[name="ids[]"]:checked').length === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất một mục để xóa.');
        }
    });
});


function confirmOrder(orderId) {
    if (confirm('Bạn có chắc chắn muốn xác nhận đơn hàng này?')) {
        $.ajax({
            url: '/admin/order/' + orderId + '/confirm',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Gửi token CSRF
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    location.reload(); // Tải lại trang sau khi xác nhận thành công
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            }
        });
    }
}
