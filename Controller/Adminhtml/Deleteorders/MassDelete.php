<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @package     Magenizr_DeleteOrders
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Controller\Adminhtml\Deleteorders;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class MassDelete extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
    /**
     * MassDelete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Magenizr\DeleteOrders\Helper\Data $helper
     * @param \Magenizr\DeleteOrders\Model\Order $order
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Sales\Model\OrderRepository $orderRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Magenizr\DeleteOrders\Helper\Data $helper,
        \Magenizr\DeleteOrders\Model\Order $order,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory,
        \Magento\Sales\Model\OrderRepository $orderRepository
    ) {

        parent::__construct($context, $filter);

        $this->helper = $helper;
        $this->order = $order;
        $this->collectionFactory = $collectionFactory;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param AbstractCollection $collection //abstract collection
     * @return type
     */
    protected function massAction(AbstractCollection $collection)
    {
        if (!$this->helper->getAvailability('adminhtml')) {

            $this->messageManager->addWarningMessage(
                __('This feature is temporarily disabled. Please have a look at the <a href="%1">configuration settings</a>.', $this->getUrl('adminhtml/system_config/edit/section/sales'))
            );

        } else {

            $ordersDeleted = 0;
            $notDeleted = 0;

            $orderStatusRestriction = $this->helper->getOrderStatusRestriction();

            foreach ($collection as $order) {
                if (in_array($order->getStatus(), $orderStatusRestriction)) {
                    try {
                        // Delete Invoice, Shipment and Credit Memo first
                        $this->order->deleteRelatedRecords($order);

                        // Delete the actual order
                        $this->orderRepository->delete($order);

                        $ordersDeleted++;
                    } catch (\Exception $e) {
                        $this->messageManager->addErrorMessage(__($e->getMessage()));
                    }
                } else {
                    $notDeleted++;
                }
            }

            if ($ordersDeleted <= 0 && $notDeleted >= 0) {
                $this->messageManager->addWarningMessage(
                    __('Only orders with a specific status can be deleted. Please have a look at the order status restrictions in the <a href="%1">configuration settings</a>.', $this->getUrl('adminhtml/system_config/edit/section/sales'))
                );
            }

            if ($ordersDeleted == 1) {

                $this->messageManager->addSuccessMessage(
                    __('%1 order has been deleted.', $ordersDeleted)
                );

            } else {
                $this->messageManager->addSuccessMessage(
                    __('Total of %1 orders were deleted.', $ordersDeleted)
                );
            }

            if ($ordersDeleted > 0 && $notDeleted > 0) {
                $this->messageManager->addWarningMessage(
                    __('At least one order could not be deleted because of the order status restrictions in the <a href="%1">configuration settings</a>.', $this->getUrl('adminhtml/system_config/edit/section/sales'))
                );
            }
        }

        $this->_redirect('sales/order/index');
    }
}
