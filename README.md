[![Magenizr Plus](https://images2.imgbox.com/11/6b/yVOOloaA_o.gif)](https://account.magenizr.com)
---

# Delete Orders
This Magento 2 modules allows admin users to delete orders including all related information such as invoices, shipments and credit memos via backend, command-line or REST API only.

![Magenizr DeleteOrders - Backend](https://images2.imgbox.com/59/44/yrAzplxT_o.jpeg)
![Magenizr DeleteOrders - Backend](https://images2.imgbox.com/46/79/NfMo5mky_o.jpeg)

## Business Value
A admin user can delete unwanted orders ( e.g test orders ) without having a developer / agency involved.

* A client support team, which usually has no access to the MySQL database can delete orders without having a developer involved.
* Practical for small businesses, which can not afford expensive agency support.

## Features
* A new option `Delete` to the `Actions` dropdown in the `Sales > Orders` grid.
* CLI command called `magenizr:order:delete`.
* REST API endpoint `/V1/order/:orderId`.
* A list `Restrict Order Status` in `Stores > Configuration > Magenizr > Delete Orders` allows the admin user to limit the delete feature to specific order statuses only.
* A drop down `Availability` that can be used to limit the availability to `Backend`, `Command-Line`, `REST API` or `All`.

* It clears all related order information which are stored in the following tables.

```
sales_invoice, sales_invoice_grid, sales_shipment, sales_shipment_grid, sales_creditmemo, sales_creditmemo_grid
```
* The functionality can be restricted to specific roles via `System > Permissions > User Roles`. The ACL resource is `Stores > Configuration > Delete Orders`.
* The configuration can be found in `Stores > Configuration > Magenizr > Delete Orders`.

## Usage
1. Once the module is installed and enabled, a new option `Delete` in the dropdown `Actions` is available on `Sales > Orders`. Once the popup message `Are you sure you want to delete selected items?` is confirmed, the module will deleted selected items and display a success message `Total of X order(s) were deleted successfully.`.
2. On command-line `magenizr:order:delete` can be used to delete one or multiple ( comma separated ) order ids. For example:

```
bin/magento magenizr:order:delete 100000001
bin/magento magenizr:order:delete 100000001,100000002,100000003
```

```
bin/magento magenizr:order:delete 000000001,34234
Order ID 000000001 successfully deleted.
Order ID 34234 does not exist.
```

3. Via REST API simply git the endpoint `/V1/order/:orderId` and method `DELETE`.

## System Requirements
* Magento 2.4.x
* PHP 7.x, 8.x

## Installation (Composer 2)

1. Update your composer.json `composer require "magenizr/magento2-deleteorders":"1.1.0" --no-update`
2. Use `composer update magenizr/magento2-deleteorders --no-install` to update your composer.lock file.

```
Updating dependencies
Lock file operations: 1 install, 1 update, 0 removals
  - Locking magenizr/magento2-deleteorders (1.1.0)
```

3. And then `composer install` to install the package.

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 1 install, 0 update, 0 removals
  - Installing magenizr/magento2-deleteorders (1.1.0): Extracting archive
```

4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_DeleteOrders --clear-static-content
```

## Installation (Manually)
1. Download the latest version of the source code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_DeleteOrders_1.1.0.tar.gz`.
3. Copy the code into `./app/code/Magenizr/DeleteOrders/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_DeleteOrders --clear-static-content
```

## Support
If you experience any issues, don't hesitate to open an issue on [Github](https://github.com/magenizr/Magenizr_Debugger/issues).

## Purchase
This module is available for free on [GitHub](https://github.com/magenizr).

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.1.0 =====
* 2.4.6 compatibility tested
* REST API Support `<route url="/V1/order/:orderId" method="DELETE">`
* Code cleanup

===== 1.0.2 =====
* Test 2.4.5 compatibility
* Remove constraints in composer file
* Change wording

===== 1.0.1 =====
* Command name renamed from magenizr:deleteorders to magenizr:order:delete

===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)
