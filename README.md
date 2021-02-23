![GitHub all releases](https://img.shields.io/github/downloads/spiritdigitalagency/magento2-skroutz/total?style=for-the-badge)
![GitHub Release Date](https://img.shields.io/github/release-date/spiritdigitalagency/magento2-skroutz?style=for-the-badge)
![Packagist Version](https://img.shields.io/packagist/v/spiritdigitalagency/module-skroutz?style=for-the-badge)
![GitHub](https://img.shields.io/github/license/spiritdigitalagency/magento2-skroutz?style=for-the-badge)

# Skroutz Analytics Integration Magento 2 Module

Integrate skroutz analytics to your Magento 2 store.

This module provides the integration between [Skroutz Analytics](http://developer.skroutz.gr/analytics/) and
the [Magento 2](https://magento.com/) store.

* Integrates the analytics tracking script to all your frontend pages.
* Integrates the ecommerce data (transactions and revenue) generated during an order.
* Integrates the skroutz partner embedded badge as a widget for the store’s pages.
* Integrates the skroutz product reviews as a tab to all your product pages.
* Select any of your Magento Product attributes or custom attributes to match your skroutz XML feed
* Compatible with Magento 2.3.x and Magento 2.4.x

The module is available from
the [Github repo]((https://github.com/spiritdigitalagency/module-skroutz/archive/master.zip)).

## Installation

### Install via composer (recommended)

We recommend you to install Spirit_Skroutz module via composer. It is easy to install, update and maintain.

Run the following command in Magento 2 root folder.

#### Install

```
composer require spiritdigitalagency/module-skroutz
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

#### Upgrade

```
composer update spiritdigitalagency/module-skroutz
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

### Manual

If you don't want to install via composer, you can use this way.

- Download [the latest version here](https://github.com/spiritdigitalagency/module-skroutz/archive/master.zip)
- Extract `master.zip` file to `app/code/Spirit/Skroutz`. You should create a folder path `app/code/Spirit/Skroutz` if
  not exist.
- Go to Magento root folder and run upgrade command line to install `Spirit_Skroutz`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

## Setup

There are several configuration options for this extension which can be found
at `Stores > Configuration > Spirit > Skroutz`.

### Skroutz Analytics

1. Navigate to `Stores > Configuration > Spirit > Skroutz > Skroutz Analytics`
2. Set the `Enabled` to `yes`
3. Set the `Shop Account ID` to the one provided by Skroutz
4. Set the `Unique ID` to the product Unique ID you are using in your XML Feed
5. Save and Flush Magento Cache

## Additional Configuration

Skroutz analytics should be enabled and configured properly for additional features to function properly.

### Skroutz Reviews

Enable Skroutz Product Reviews to display the Skroutz review tab at the product page.

#### Merchants Control Panel Settings

1. Navigate to `Integrations > Product Reviews`
2. Enable the widget and choose the desired style

#### Magento Settings

1. Navigate to `Stores > Configuration > Spirit > Skroutz > Skroutz Reviews`
2. Set the Enabled to yes.
3. Choose the theme you want (inline - extended)
4. Save and Flush Magento Cache

### Skroutz Embedded Badge

You can either use embedded badge with a layout handle to conditional display the badge in some store pages, or you can
directly embed it in a page / static block.

#### Merchants Control Panel Settings

1. Navigate to Integrations > Skroutz Partner Badge
2. Enable the widget and choose the desired Embedded Badge Style

#### Magento Settings

###### Page / Static Block Embed

1. Navigate to `Content > Pages or Content > Blocks`
2. Find the `Edit Page – Block`
3. Choose `Insert Widget` from editor toolbar
4. Select widget type `Skroutz Badge`
5. Insert Widget
6. Save and Flush Magento Cache

###### Conditional Embed

1. Navigate to `Content > Widgets`
2. Add new widget
3. Select type `Skroutz Badge`
4. Assign to the desired store views
5. Add Layout Update
6. Display on All Pages
7. Pick the location you want the badge to be
8. Save and Flush Magento Cache

##Author: 
Name: [Spirit Digital Agency](https://spirit.com.gr/)

Email: [support@spirit.com.gr](mailto:support@spirit.com.gr)

Release Date: 23 - 02 - 2021
