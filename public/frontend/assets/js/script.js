const site_url = "http://127.0.0.1:8000/";

$("body").on("keyup", "#search", function () {
    let text = $("#search").val(); //#search is id of the search in header
    // console.log(text);

    // search with words length > 0
    if (text.length > 0) {
        $.ajax({
            data: {
                search_advanced: text,
            },
            url: site_url + "search-product",
            method: "POST",

            beforSend: function (request) {
                return request.setRequestHeader(
                    "X-CSRF-TOKEN",
                    'meta[name="csrf_token"]'
                );
            },

            success: function (result) {
                $("#search_products").html(result);
            },
        });
    }

    // search with words length < 1
    if (text.length < 1) $("#search_products").html("");
});

