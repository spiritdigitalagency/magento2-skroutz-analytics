# Changelog

## 2.0.0

### Compatibility
- Magento Open Source / Adobe Commerce 2.4.0 – 2.4.9.
- PHP 7.4, 8.1, 8.2, 8.3, 8.4 and 8.5.
- Magento 2.3 is no longer supported.
- `composer.json` declares every Magento module the extension uses, with version ranges.

### Fixed
- Order amounts of 1,000 or more were sent with a thousands separator (`1,234.50`).
- `revenue` is now the order grand total, so discounts are no longer counted as revenue.
- `paid_by` and `paid_by_descr` were swapped. `paid_by` now holds the payment type
  (`bank_transfer`, `cash_on_delivery`, `paypal`, or the method code) and `paid_by_descr` the
  payment method title.
- `order_id` is now the order number (increment ID) that the merchant sees in the admin.
- The Inline and Extended reviews themes were swapped.
- The reviews widget now sends the configured Unique ID, matching the XML feed, instead of
  always sending the SKU.
- A deleted product no longer breaks the success page.
- Invalid schema location in `widget.xml`.
- The success page no longer forces the `1column` page layout.

### Changed
- Inline scripts are rendered with `SecureHtmlRenderer`, so they keep working under the strict
  Content Security Policy that Magento 2.4.7+ applies to the checkout.
- Added `connect-src` for `*.skroutz.gr` to the CSP whitelist.
- Ecommerce data is passed to Skroutz Analytics as JSON objects, encoded safely for inline
  scripts.
- The tracking script is not printed when the Shop Account ID is empty.
- Default configuration values in `etc/config.xml`.
- Code follows the Magento 2 coding standard.
