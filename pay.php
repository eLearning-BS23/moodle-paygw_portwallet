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
 * Redirects to the portwallet checkout for payment
 *
 * @package    paygw_portwallet
 * @copyright  2021 Brain station 23 ltd.
 * @author     Brain station 23 ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_payment\helper;
use paygw_portwallet\portwallet_helper;

require_once(__DIR__ . '/../../../config.php');

require_login();
global $DB;

$component   = required_param('component', PARAM_ALPHANUMEXT);
$paymentarea = required_param('paymentarea', PARAM_ALPHANUMEXT);
$itemid      = required_param('itemid', PARAM_INT);
$description = required_param('description', PARAM_TEXT);

$courseid   = $DB->get_field('enrol', 'courseid', ['enrol' => 'fee', 'id' => $itemid]);
$config     = (object) helper::get_gateway_configuration($component, $paymentarea, $itemid, 'portwallet');
$payable    = helper::get_payable($component, $paymentarea, $itemid);
$surcharge  = helper::get_gateway_surcharge('portwallet');
$cost       = helper::get_rounded_cost($payable->get_amount(), $payable->get_currency(), $surcharge);

$portwallet_helper = new portwallet_helper(
    $config->apikey,
    $config->secretkey,
    $config->paymentmodes
);
$portwallet_helper->generate_payment(
    $payable->get_currency(),
    $cost,
    $component,
    $paymentarea,
    $itemid,
    $courseid
);
