var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-billing-address': {
                'Magenest_Movie/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'Magenest_Movie/js/action/set-shipping-information-mixin': true
            }
        }
    },
    map: {
        "*": {
            aureatelabsMethod: "Magenest_Movie/js/aureatelabsValidationRule"
        }
    }
};
