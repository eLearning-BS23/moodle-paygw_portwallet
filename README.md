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

![portwallet3](https://user-images.githubusercontent.com/97436713/153135098-3492f3d1-9dc6-401d-81b1-ad86f6f01494.png)
  
Enable Enrolment on payment by clicking the eye icon.

### Step: 3

Enable Portwallet to the payment gateways 

```
  Dashboard->Site Administration->Plugins->Enrolments->Manage Enrol Plugins
```
