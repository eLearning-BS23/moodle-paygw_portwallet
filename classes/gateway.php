<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contains class for portwallet payment gateway.
 *
 * @package    paygw_portwallet
 * @copyright  2021 Brain station 23 ltd.
 * @author     Brain station 23 ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace paygw_portwallet;

use core_payment\form\account_gateway;

/**
 * The gateway class for portwallet payment gateway.
 *
 * @package    paygw_portwallet
 * @copyright  2021 Brain station 23 ltd.
 * @author     Brain station 23 ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gateway extends \core_payment\gateway {
    /**
     * The full list of currencies supported by portwallet regardless of account origin country.
     * Only certain currencies are supported based on the users account, the plugin does not account for that
     * when giving the list of supported currencies.
     *
     *
     *
     * @return array[]
     */
    public static function get_supported_currencies(): array {
        return [
            'BDT', 'USD'
        ];
    }

    /**
     * The list of zero/non-decimal currencies in portwallet.
     *
     */
    public static function get_zero_decimal_currencies(): array {
        return []; // Does not support zero decimal currencies.
    }

    /**
     * Configuration form for the gateway instance
     *
     * Use $form->get_mform() to access the \MoodleQuickForm instance
     *
     * @param account_gateway $form
     */
    public static function add_configuration_to_gateway_form(account_gateway $form): void {
        $mform = $form->get_mform();

        $mform->addElement('text', 'apikey', get_string('apikey', 'paygw_portwallet'));
        $mform->setType('apikey', PARAM_TEXT);
        $mform->addHelpButton('apikey', 'apikey', 'paygw_portwallet');

        $mform->addElement('text', 'secretkey', get_string('secretkey', 'paygw_portwallet'));
        $mform->setType('secretkey', PARAM_TEXT);
        $mform->addHelpButton('secretkey', 'secretkey', 'paygw_portwallet');

        $paymentmodes = [
            'sandbox' => get_string('paymentmodes:sandbox', 'paygw_portwallet'),
            'live' => get_string('paymentmodes:live', 'paygw_portwallet'),
        ];
        $mform->addElement('select', 'paymentmodes', get_string('paymentmodes', 'paygw_portwallet'), $paymentmodes);
        $mform->setType('paymentmodes', PARAM_TEXT);
        $mform->setDefault('paymentmodes', 'sandbox');
    }

    /**
     * Validates the gateway configuration form.
     *
     * @param account_gateway $form
     * @param \stdClass $data
     * @param array $files
     * @param array $errors form errors (passed by reference)
     */
    public static function validate_gateway_form(
        account_gateway $form,
        \stdClass $data,
        array $files,
        array &$errors
    ): void {
        if ($data->enabled && (empty($data->apikey) || empty($data->secretkey)
            || empty($data->paymentmodes))) {
            $errors['enabled'] = get_string('gatewaycannotbeenabled', 'payment');
        }
    }
}
