/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

define([
    'jquery',
    'domReady'
], function ($, domReady) {
    'use strict';

    var globalOptions = {
        config: {}
    };

    $.widget('mage.productOptionsPreselect', {
        options: globalOptions,

        _create: function createProductOptionsPreselect() {
        },

        _init: function initProductOptionsPreselect() {
            var self = this;

            domReady(function() {
                $.each(self.options.config, function (key, optionData) {
                    var optionId = optionData.option_id;
                    var type = optionData.type;
                    var optionValueId = optionData.option_type_id;

                    if (type === 'drop_down') {
                        var select = $('#product-options-wrapper #select_' + optionId);

                        if (select.length > 0) {
                            var option = select.find('option[value="' + optionValueId + '"]');

                            if (option.length > 0) {
                                select.val(optionValueId);
                                select.change();
                            }
                        }
                    }
                });
            });
        },
    });

    return $.mage.productOptionsPreselect;
});
