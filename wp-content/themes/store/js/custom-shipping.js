jQuery(document).ready(function($) {
    function updateShippingMethods() {
        $.ajax({
            type: 'POST',
            url: custom_shipping.ajax_url,
            data: {
                action: 'update_shipping_methods'
            },
            success: function(response) {
                $(document.body).trigger('update_checkout');
                setTimeout(function() {
                    var shippingCountry = $('#shipping_country').val();
                    if (shippingCountry === 'IN') {
                        var freeShippingMethod = $('input[name="shipping_method[0]"][value="free_shipping:free_shipping"]');
                        if (freeShippingMethod.length) {
                            $('input[name="shipping_method[0]"]').prop('checked', false);
                            freeShippingMethod.prop('checked', true).change();
                        }
                    }
                }, 100);
            }
        });
    }

    updateShippingMethods();
    $(document.body).on('updated_cart_totals', updateShippingMethods);
    $(document.body).on('change', 'input.qty', function() {
        setTimeout(updateShippingMethods, 500);
    });
    $(document.body).on('updated_checkout', function() {
        updateShippingMethods();
    });
});
