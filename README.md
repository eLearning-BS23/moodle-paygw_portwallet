# Moodle Payment Gateway Portwallet plugin

PortWallet is a payment gateway that allows merchants to expand their businesses online. Your customers will be able to buy products online with ease and security. Payments can be made with local and international debit or credit cards.

PortWallet is the best and simplest way to accept payments online in Bangladesh. PortWallet aims to expand the infrastructure of internet commerce by making it easy to process transactions and manage an online business. For more detail about `SSLCOMMERZ` please visit https://www.portwallet.com/.

![visa-master-card-bkash-nexus-logo](https://user-images.githubusercontent.com/97436713/153133264-a3bc6cd4-d7f9-4cf2-a7ee-7522753c9c60.png)

## Features
- Supports Visa, MasterCard, bKash, DBBL Nexus, surecash, Mcash Islami Bank
- Easy Integration
- Personalised payment experience
- Secure OTP based access to save cards
- Bi-lingual Support
- Add vat or surcharge

## Configuration

You can install this plugin from [Moodle plugins directory](https://moodle.org/plugins) or can download from [Github](https://github.com/eLearning-BS23/moodle-paygw_portwallet).

You can download zip file and install or you can put file under payment gateway portwallet

## Plugin Global Settings
### Go to 
```
  Dashboard->Site Administration->Plugins->Payment Gateways->portwallet settings
```
In this page you can add surcharge for the payments. After installing the plugin you'll automatically redirected to this page.

![image_2022_02_09T06_29_33_937Z](https://user-images.githubusercontent.com/97436713/153134639-3852f97f-6a9b-451d-b997-242317bc5cab.png)

## Configuring the Portwallet Gateway:
### Step: 1

```
  Dashboard->Site Administration->Plugins->Payment Gateways->Portwallet settings
```
![portwallet2](https://user-images.githubusercontent.com/97436713/153134845-a0ea0273-0ad8-4afc-a70c-90d68db8766a.png)

- Insert the SSLCOMMERZ api v3 url https://sandbox.sslcommerz.com/gwprocess/v3/api.php
- Insert sslcommerz validetion url https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php
- Insert the Store id that provided by sslcommerz
- Insert Store Password provided by sslcommerz
- Insert production environment like sandbox or live server 
- Click the "save changes" button to save the information

### Step: 2 
- Go to the Manage Enrolment Plugins section from the site administration
```
Dashboard->Site Administration->Plugins->Enrolments->Manage Enrol Plugins
```

![portwallet3](https://user-images.githubusercontent.com/97436713/153135098-3492f3d1-9dc6-401d-81b1-ad86f6f01494.png)
  
Enable Enrolment on payment by clicking the eye icon.

### Step: 3

Enable Portwallet to the payment gateways:

```
  Dashboard->Site Administration->Plugins->Enrolments->Manage Enrol Plugins
```

![portwallet4](https://user-images.githubusercontent.com/97436713/153136738-9a7a6062-3339-4170-9907-018a6ba2f4e0.png)

## Enrolment Settings for Course: 

Now click on the course page and add an enrolment method Enrolment of Payment.

![image_2022_02_09T06_59_16_460Z](https://user-images.githubusercontent.com/97436713/153138641-93f67f96-9bc1-44bf-afbd-8641b0bd8821.png)

and fill up this form below to set the amount of money and currency for the course payment

![image_2022_02_09T07_00_11_382Z](https://user-images.githubusercontent.com/97436713/153138610-ff83dcde-ebc2-430f-a870-2b612203a576.png)

This is how it looks like from a student's perspective:

![portwallet5](https://user-images.githubusercontent.com/97436713/153136854-31f92d49-9161-4922-90ca-c5d4224228c8.png)

Select the Payment Type- SSLCommerz the surcharge is added with the course payment amount

![portwallet6](https://user-images.githubusercontent.com/97436713/153136966-83fd5e35-a62b-401b-96fa-926d83766c8d.png)

Select any payment method:

![portwallet7dsfdf](https://user-images.githubusercontent.com/97436713/153137454-00577764-8598-4ff9-987e-8eb441a449e7.png)

Give details of your card:

![portwallet8ds](https://user-images.githubusercontent.com/97436713/153137554-2227af1a-bad7-4cb0-9893-d91122eea711.png)

If you payment is successful then you'll be enrolled in the course:

![portwallet10](https://user-images.githubusercontent.com/97436713/153137634-d6de0826-814c-493b-9513-9eef9665c714.png)

## Author
- [Brain Station 23 Ltd.](https://brainstation-23.com)

## License
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see [GNU License](http://www.gnu.org/licenses/).
