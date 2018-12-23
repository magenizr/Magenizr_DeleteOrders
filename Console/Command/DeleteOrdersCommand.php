<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @package     Magenizr_DeleteOrders
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteOrdersCommand
 * @package Magenizr\DeleteOrders\Console\Command
 */
class DeleteOrdersCommand extends Command
{
    const ORDER_ID = 'increment_id';

    /**
     * DeleteOrdersCommand constructor.
     * @param \Magento\Framework\App\State $state
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Magenizr\DeleteOrders\Model\Order $order
     * @param \Magenizr\DeleteOrders\Helper\Data $helper
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magenizr\DeleteOrders\Model\Order $order,
        \Magenizr\DeleteOrders\Helper\Data $helper,
        \Magento\Framework\Registry $registry
    ) {
        $state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);

        $this->orderFactory = $orderFactory;
        $this->order = $order;
        $this->registry = $registry;
        $this->helper = $helper;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('magenizr:order:delete')
            ->setDescription('Delete Orders Command')
            ->setDefinition([
                new InputArgument(
                    self::ORDER_ID,
                    InputArgument::OPTIONAL,
                    'Order ID'
                )
            ]);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->helper->getAvailability('cli-command')) {
            throw new \InvalidArgumentException('This feature is temporarily disabled. Please have a look at the module settings in Stores > Configuration > Sales > Sales > Delete Orders.');
        }

        $orderNumbers = $input->getArgument(self::ORDER_ID);

        if ($orderNumbers === null) {
            throw new \InvalidArgumentException('Order ID(s) is missing. One or multiple ( comma separated ) order ID(s) are required.');
        } else {

            $orderNumbers = array_map('trim', explode(',', $orderNumbers));

            foreach ($orderNumbers as $orderNumber) {

                $order = $this->orderFactory->create()->loadByIncrementId($orderNumber);

                if (!$order->getId()) {
                    $output->writeln('Order ID ' . $orderNumber . ' does not exist.');
                } else {
                    $this->registry->register('isSecureArea', 'true');

                    // Delete Invoice, Shipment and Credit Memo first
                    $this->order->deleteRelatedRecords($order);

                    // Delete the actual order
                    $order->delete();

                    $this->registry->unregister('isSecureArea');

                    $output->writeln('Order ID ' . $orderNumber . ' successfully deleted.');
                }
            }
        }
    }
}
