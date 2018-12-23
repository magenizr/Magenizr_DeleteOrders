# Magenizr DeleteOrders
This Magento 2 modules allows admin users to delete orders including all related information such as invoices, shipments and credit memos via backend or command-line.

![Magenizr DeleteOrders - Intro](http://download.magenizr.com/pub/magenizr_deleteorders/all/intro.png)

![Magenizr DeleteOrders - Backend](http://download.magenizr.com/pub/magenizr_deleteorders/all/product_01.png)

![Magenizr DeleteOrders - Backend](http://download.magenizr.com/pub/magenizr_deleteorders/all/product_02.png)

## Business Value
A admin user can delete unwanted orders ( e.g test orders ) without having a developer / agency involved.

* A client support team, which usually has no access to the MySQL database can delete orders without having a developer involved.
* Practical for small businesses, which can not afford expensive agency support.

## Features
* A new option `Delete` to the `Actions` dropdown in the `Sales > Orders` grid.
* A CLI command called `magenizr:order:delete`.
* A list `Restrict Order Status` in `Stores > Configuration > Sales > Sales > Delete Orders` allows the admin user to limit the delete feature to specific order statuses only.
* A drop down `Availability` can be used to limit the availability to `Backend`, `Command-Line` or `Both`.

* It clears all related order information which are stored in the following tables.

```
sales_invoice, sales_invoice_grid, sales_shipment, sales_shipment_grid, sales_creditmemo, sales_creditmemo_grid
```
* The functionality can be restricted to specific roles via `System > Permissions > User Roles`. The ACL resource is `Stores > Configuration > Delete Orders`.
* The configuration can be found in `Stores > Configuration > Sales > Sales > Delete Orders`.

## Usage
Once the module is installed and enabled, a new option `Delete` in the dropdown `Actions` is available on `Sales > Orders`. Once the popup message `Are you sure you want to delete selected items?` is confirmed, the module will deleted selected items and display a success message `Total of X order(s) were deleted successfully.`.

On command-line `magenizr:order:delete` can be used to delete one or multiple ( comma separated ) order ids. For example:

```
bin/magento magenizr:order:delete 100000001
bin/magento magenizr:order:delete 100000001,100000002,100000003
```

```
bin/magento magenizr:order:delete 000000001,34234
Order ID 000000001 successfully deleted.
Order ID 34234 does not exist.
```

## Purchase
This module is available for free on [GitHub](https://github.com/magenizr) and [Magento Marketplace](https://marketplace.magento.com/partner/magenizr).

## System Requirements
* Magento 2.1.x, 2.2.x
* PHP 5.x, 7.x

## Installation (Composer)

1. Add this extension to your repository `composer config repositories.magenizr/magento2-deleteorders git https://github.com/magenizr/Magenizr_DeleteOrders.git`
2. Update your composer.json `composer require "magenizr/magento2-deleteorders":"1.0.1"`

```
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)              
Package operations: 1 install, 0 updates, 0 removals
  - Installing magenizr/magento2-deleteorders (1.0.1): Downloading (100%)         
Writing lock file
Generating autoload files
```

3. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_DeleteOrders --clear-static-content
php bin/magento setup:upgrade
```

## Installation (Manually)
1. Download the latest version of the source code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_DeleteOrders_1.0.1.tar.gz`.
3. Copy the code into `./app/code/Magenizr/DeleteOrders/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_DeleteOrders --clear-static-content
php bin/magento setup:upgrade
```

## Support
If you have any issues with this extension, open an issue on [Github](https://github.com/magenizr/Magenizr_DeleteOrders/issues). For a custom build, don't hesitate to contact us on [Magento Marketplace](https://marketplace.magento.com/partner/magenizr).

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.0.1 =====
* Command name renamed from magenizr:deleteorders to magenizr:order:delete

===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)