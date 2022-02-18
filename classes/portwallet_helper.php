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

namespace paygw_portwallet;


use PortWallet\PortWallet;
use InvalidArgumentException;
use PortWallet\PortWalletClient;
use PortWallet\Exceptions\PortWalletException;
use PortWallet\Exceptions\PortWalletClientException;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../.extlib/vendor/autoload.php');

class portwallet_helper
{
    /**
     * @var string API key
     */
    private $apikey;

    /**
     * @var string secret key
     */
    private $secretkey;

    /**
     * @var string payment mode
     * live or sandbox
     */
    private $paymentmode;

    /**
     * Initialise the portwallet API client.
     *
     */
    public function __construct(string $apikey, string $secretkey, string $mode)
    {
        $this->apikey = $apikey;
        $this->secretkey = $secretkey;
        $this->paymentmode = $mode;
    }

    /**
     * Create a payment intent and return with the checkout session id.
     *
     * @return string
     *
     * @throws PortWalletException
     */
    public function generate_payment(
        string $currency,
        float $cost,
        string $component,
        string $paymentarea,
        string $itemid
    ): void {
        global $CFG, $USER, $DB;
        $unitamount = $cost;

        $courseid = $DB->get_field('enrol', 'courseid', ['enrol' => 'fee', 'id' => $itemid]);
        $sql = "SELECT fullname FROM {course} where id={$courseid}";
        $coursename = $DB->get_record_sql($sql);

        $cusname = $USER->firstname . ' ' . $USER->lastname;
        $cusemail = $USER->email;
        $cusadd1 = $USER->address;
        $cuscity = $USER->city;
        $cuscountry = $USER->country;
        $cusphone = $USER->phone1;

        // Mode switching default "sandbox".
        PortWallet::setApiMode($this->paymentmode);

        // N.B.: API mode should be set first before
        // creating an instance of PortWalletClient.

        // Initiate the PortWallet client.
        $portwallet = new PortWalletClient($this->apikey, $this->secretkey);

        // Your data.
        $data = array(
            'order' => array(
                'amount' => $unitamount,
                'currency' => $currency,
                'redirect_url' => $CFG->wwwroot . '/payment/gateway/portwallet/process.php?component=' . $component .
                    '&paymentarea=' . $paymentarea . '&itemid=' . $itemid,
                'validity' => 900,
            ),
            'product' => array(
                'name' => $coursename->fullname,
                'description' => 'Course enrollment',
            ),
            'billing' => array(
                'customer' => array(
                    'name' => $cusname,
                    'email' => $cusemail,
                    'phone' => !empty($cusphone) ? $cusphone : '01700000000',
                    'address' => array(
                        'street' => !empty($cusadd1) ? $cusadd1 : 'No Address',
                        'city' => $cuscity,
                        'state' => $cuscity,
                        'zipcode' => $cuscity,
                        'country' => $cuscountry,
                    ),
                ),
            ),
        );
        try {
            $invoice = $portwallet->invoice->create($data);
            $paymenturl = $invoice->getPaymentUrl();
        } catch (InvalidArgumentException $ex) {
            echo $ex->getMessage();
        } catch (PortWalletException $ex) {
            echo $ex->getMessage();
        }

        header("location: {$paymenturl}");
    }
}
