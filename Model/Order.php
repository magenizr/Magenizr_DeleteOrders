<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @package     Magenizr_DeleteOrders
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Model;

class Order extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @param $order
     */
    public function deleteRelatedRecords($order)
    {

        $invoices = $order->getInvoiceCollection();

        if ($invoices) {
            foreach ($invoices as $invoice) {
                $invoice->delete();
            }
        }

        $shipments = $order->getShipmentsCollection();

        if ($shipments) {
            foreach ($shipments as $shipment) {
                $shipment->delete();
            }
        }

        $creditmemos = $order->getCreditmemosCollection();

        if ($creditmemos) {
            foreach ($creditmemos as $creditmemo) {
                $creditmemo->delete();
            }
        }
    }
}
