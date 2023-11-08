// Delete data
$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Xóa dữ liệu này?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Đã xóa dữ liệu", "Thành công");
            }
        });
    });
});

// Confirmed Status Order
$(function () {
    $(document).on("click", "#confirmed", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Xác nhận đơn hàng?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Xác nhận đơn hàng", "Thành công");
            }
        });
    });
});

// Processing Status Order
$(function () {
    $(document).on("click", "#processing", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Xác nhận xử lý đơn hàng?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Xác nhận xử lý đơn hàng", "Thành công");
            }
        });
    });
});

// Delivered Status Order
$(function () {
    $(document).on("click", "#delivered", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Xác nhận giao đơn hàng?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Xác nhận giao đơn hàng", "Thành công");
            }
        });
    });
});

// Approve Request Return Order
$(function () {
    $(document).on("click", "#approve-return-request-order", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn",
            text: "Chấp nhận đơn hàng hoàn lại?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Chấp nhận đơn hàng hoàn lại", "Thành công");
            }
        });
    });
});

// Approve Review
$(function () {
    $(document).on("click", "#approve-review", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Bạn có chắc chắn",
            text: "Phê duyệt đánh giá?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Phê duyệt đánh giá", "Thành công");
            }
        });
    });
});
