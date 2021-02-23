![GitHub all releases](https://img.shields.io/github/downloads/spiritdigitalagency/magento2-skroutz/total?style=for-the-badge)
![GitHub Release Date](https://img.shields.io/github/release-date/spiritdigitalagency/magento2-skroutz?style=for-the-badge)
![Packagist Version](https://img.shields.io/packagist/v/spiritdigitalagency/module-skroutz?style=for-the-badge)
![GitHub](https://img.shields.io/github/license/spiritdigitalagency/magento2-skroutz?style=for-the-badge)

# Skroutz Analytics Magento 2 Module

Integrate skroutz analytics to your Magento 2 site.

This module provides the integration between [Skroutz Analytics](http://developer.skroutz.gr/analytics/) and the Magento
2 store.

* Integrates the analytics tracking script to all your frontend pages.
* Integrates the ecommerce data (transactions and revenue) generated during an order.
* Integrates the skroutz partner embedded badge as a widget for the store’s pages.
* Integrates the skroutz product reviews as a tab to all your product pages.

The module is available from the [Github repo]((https://github.com/spiritgr/module-skroutz/archive/master.zip)).

## Installation

### 1. Install via composer (recommended)

We recommend you to install Spirit_Skroutz module via composer. It is easy to install, update and maintain.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require spiritgr/module-skroutz
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update spiritgr/module-skroutz
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

### 2. Manual

If you don't want to install via composer, you can use this way.

- Download [the latest version here](https://github.com/spiritgr/module-skroutz/archive/master.zip)
- Extract `master.zip` file to `app/code/Spirit/Skroutz`. You should create a folder path `app/code/Spirit/Skroutz` if
  not exist.
- Go to Magento root folder and run upgrade command line to install `Spirit_Skroutz`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## Setup

There are several configuration options for this extension which can be found
at `Stores > Configuration > Spirit > Skroutz`.

### Skroutz Analytics

1. Navigate to `Stores > Configuration > Spirit > Skroutz > Skroutz Analytics`
2. Set the `Enabled` to `yes`.
3. Set the `Shop Account ID` to the one provided by Skroutz.
4. Set the `Unique ID` to the product Unique ID you are using in your XML Feed.
5. Save and Flush Magento Cache.

### Skroutz Reviews

1. Navigate to `Stores > Configuration > Spirit > Skroutz > Skroutz Reviews`
2. Set the `Enabled` to `yes`.
3. Choose the theme you want (inline - extended)
4. Save and Flush Magento Cache.
