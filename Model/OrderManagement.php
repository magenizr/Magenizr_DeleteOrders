<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Model;

use Magento\Framework\Exception\LocalizedException;

class OrderManagement implements \Magenizr\DeleteOrders\Api\OrderManagementInterface
{
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    private $orderFactory;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var \Magenizr\DeleteOrders\Helper\Data
     */
    private $helper;

    /**
     * Init constructor
     *
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param Order $order
     * @param \Magenizr\DeleteOrders\Helper\Data $helper
     */
    public function __construct(
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magenizr\DeleteOrders\Model\Order $order,
        \Magenizr\DeleteOrders\Helper\Data $helper
    ) {
        $this->orderFactory = $orderFactory;
        $this->order = $order;
        $this->helper = $helper;
    }

    /**
     * Delete order by orderId
     *
     * @param integer $orderId
     * @return mixed|void
     */
    public function delete($orderId)
    {
        try {

            if (!$this->helper->getAvailability('rest-api')) {

                throw new LocalizedException(
                    __('This feature is temporarily disabled. Please have a look at the module settings in Stores > Configuration > Sales > Sales > Delete Orders.')
                );
            }

            $order = $this->orderFactory->create()->loadByIncrementId($orderId);

            if (!$order->getId()) {

                throw new LocalizedException(
                    __('The requested order does not exist.')
                );

            } else {

                // Delete Invoice, Shipment and Credit Memo first
                $this->order->deleteRelatedRecords($order);

                // Delete the actual order
                $order->delete();

                return $orderId;
            }

        } catch (\Throwable $exception) {
            throw new LocalizedException(
                __('Something went wrong while deleting the requested order: %1', $exception->getMessage()),
                $exception
            );
        }
    }
}
