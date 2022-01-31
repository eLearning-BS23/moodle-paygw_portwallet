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

/*
 * Various helper methods for interacting with the portwallet API
 *
 * @package    paygw_portwallet
 * @copyright  2021 Brain station 23 ltd.
 * @author     Brain station 23 ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
global $CFG, $USER, $DB;

require_login();
$status = required_param('status', PARAM_TEXT);
$courseid = required_param("id", PARAM_INT);
$component = required_param('component', PARAM_ALPHANUMEXT);
$paymentarea = required_param('paymentarea', PARAM_ALPHANUMEXT);
$itemid = required_param('itemid', PARAM_INT);

$paymentrecord = new stdClass();
$paymentrecord->courseid = $courseid;
$paymentrecord->itemid = $itemid;
$paymentrecord->userid = $USER->id;
$paymentrecord->currency = required_param('currency', PARAM_TEXT);
$paymentrecord->payment_status = $status;
$paymentrecord->txn_id = required_param('transaction_id', PARAM_TEXT);
$paymentrecord->timeupdated = time();
$DB->insert_record("paygw_portwallet", $paymentrecord);

if ($status == "ACCEPTED") {
    header("Location: " . $CFG->wwwroot . '/payment/gateway/portwallet/success.php?id=' . $courseid . '&component=' . $component . '&paymentarea=' . $paymentarea . '&itemid=' . $itemid);
    exit();
} else {
    header("Location: " . $CFG->wwwroot . '/payment/gateway/portwallet/cancel.php?id=' . $courseid);
    exit();
}
