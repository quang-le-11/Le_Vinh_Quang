define([
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function($){
    'use strict';
    return function() {
        $.validator.addMethod(
            "aureatelabsvalidationrule",
            function(value, element) {
                return /((^(\+84|84|0|0084){1})(3|5|7|8|9))+([0-9]{8})$/.test(value);
            },
            $.mage.__("Your validation message.")
        );
    }
});
