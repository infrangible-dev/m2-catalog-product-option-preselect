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

    const globalOptions = {
        config: {}
    };

    $.widget('mage.productOptionsPreselect', {
        options: globalOptions,

        _create: function createProductOptionsPreselect() {
        },

        _init: function initProductOptionsPreselect() {
            const self = this;

            domReady(function() {
                $.each(self.options.config, function (key, optionData) {
                    const optionId = optionData.option_id;
                    const type = optionData.type;
                    const optionValueId = optionData.option_type_id;

                    if (type === 'drop_down' || type === 'select2') {
                        const select = self.element.find('#select_' + optionId);

                        if (select.length > 0) {
                            const option = select.find('option[value="' + optionValueId + '"]');

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
