/*price range*/

$('#sl2').slider();

var RGBChange = function() {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function() {
    $(function() {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

$('#copyAddress').click(function() {
    if (this.checked) {
        $('#shipping_name').val($('#billing_name').val());
        $('[name="shipping_address"]').val($('[name="billing_address"]').val());
        $('[name="shipping_city"]').val($('[name="billing_city"]').val());
        $('[name="shipping_state"]').val($('[name="billing_state"]').val());
        $('[name="shipping_country"]').val($('[name="billing_country"]').val());
        $('[name="shipping_pincode"]').val($('[name="billing_pincode"]').val());
        $('[name="shipping_mobile"]').val($('[name="billing_mobile"]').val());
        $('[name="shipping_email"]').val($('[name="billing_email"]').val());
    } else {
        $('#shipping_name').val('');
        $('[name="shipping_address"]').val('');
        $('[name="shipping_city"]').val('');
        $('[name="shipping_state"]').val('');
        $('[name="shipping_country"]').val(0);
        $('[name="shipping_pincode"]').val('');
        $('[name="shipping_mobile"]').val('');
        $('[name="shipping_email"]').val('');
    }
});

$('#checkout').click(function() {
    alert('Cart is empty plz add any product for checkout!!');
    return false;
});

function selectPaymentMethod() {
    if ($('#Paypal').is(':checked') || $('#COD').is(':checked')) {
        return true;
    } else {
        alert('Select any one Payment Method');
        return false;
    }
}

$(document).ready(function() {
    var table = $('#example').DataTable({
        responsive: true
    });

    new $.fn.dataTable.FixedHeader(table);
});