$('.add-cart').on('click', function () {
    var cart = $('.br-icon');
    var imgtodrag = $(this).parent().parent().parent().parent().prev().find("img").eq(0);
    console.log(imgtodrag);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
            .offset({
            top: imgtodrag.offset().top,
            left: imgtodrag.offset().left
        })
            .css({
            'opacity': '0.5',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
        })
            .appendTo($('body'))
            .animate({
            'top': cart.offset().top + 10,
                'left': cart.offset().left + 10,
                'width': 75,
                'height': 75
        }, 1000, 'easeInOutExpo');

        setTimeout(function () {
            cart.effect("shake", {
                times: 2
            }, 300);
        }, 1500);

        imgclone.animate({
            'width': 0,
                'height': 0
        }, function () {
            $(this).detach()
        });
    }
});
$(document).ready(function() {
    $('#myPromotion').on('show.bs.modal', function(e) {
        var rowId = $(e.relatedTarget).data('row-id');
        var promotion_id = rowId.promotion_id;
        $(e.currentTarget).find('input[name="promotion_id"]').val(promotion_id);
        var promotion_name = rowId.promotion_name;
        var promotion_detail = rowId.promotion_detail;
        var promotion_img1 = rowId.promotion_img1;
        console.log(promotion_img1);
        document.getElementById("promotion_detail_text").innerHTML = promotion_detail;

        $('#my_image_promotion').attr('src', promotion_img1);

    });
    $('#my_modal').on('show.bs.modal', function(e) {
        var rowId = $(e.relatedTarget).data('row-id');
        console.log(rowId);
        var product_id = rowId.product_id;
        $(e.currentTarget).find('input[name="product_id"]').val(product_id);
        var product_name = rowId.product_name;
        var price = rowId.price;
        var product_unit_name = rowId.product_unit_name;
        var product_text = product_name + "\u00A0\u00A0ราคา " + price + " บาท / " + product_unit_name;
        var unit_text = "\u00A0\u00A0ราคา " + price + " บาท / " + product_unit_name;
        // document.getElementById("product_text").innerHTML = product_text;
        document.getElementById("unit_text").innerHTML = unit_text;
        document.getElementById("product_name").innerHTML = product_name;
        var product_img1 = rowId.product_img1;
        $('#my_image').attr('src', product_img1);

    });
    $('.add_cart').click(function(e) {
        var url = baseURL + "shop/addToCart";
        var product_id = $(this).data("productid");
        var product_name = $(this).data("productname");
        var segment = $(this).data("segment");
        var product_price = $(this).data("price");
        var parent = $(e.target).parents('.button-container')
        var quantity = parent.find('#' + product_id).val();
        if (quantity != '' && quantity > 0) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    product_id: product_id,
                    segment: segment,
                    qty: quantity
                },
                success: function(data) {
                    cart = JSON && JSON.parse(data) || $.parseJSON(data);
                    $(".cartcount").html(cart.num_of_items);
                    $(".total").html("ราคาทั้งหมด " + cart.total_price + " บาท");
                    $(".qty").val("1");
                }
            });
        } else {
            alert("Please Enter quantity");
        }
    });

});
var incrementQty;
var decrementQty;
var plusBtn = $(".cart-qty-plus");
var minusBtn = $(".cart-qty-minus");
var incrementQty = plusBtn.click(function() {
    var $n = $(this)
        .parent(".button-container")
        .find(".qty");
    $n.val(Number($n.val()) + 1);
});

var decrementQty = minusBtn.click(function() {
    var $n = $(this)
        .parent(".button-container")
        .find(".qty");
    var QtyVal = Number($n.val());
    if (QtyVal > 1) {
        $n.val(QtyVal - 1);
    }
});
function chkNumber(ele) {
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
    ele.onKeyPress = vchar;
}

