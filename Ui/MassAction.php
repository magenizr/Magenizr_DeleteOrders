<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Ui;

class MassAction extends \Magento\Ui\Component\MassAction
{
    /**
     * @var \Magenizr\DeleteOrders\Helper\Data
     */
    private $helper;
    
    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;

    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;

    /**
     * Init constructor
     *
     * @param \Magenizr\DeleteOrders\Helper\Data $helper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\AuthorizationInterface $authorization
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param array $data
     * @param array $components
     */
    public function __construct(
        \Magenizr\DeleteOrders\Helper\Data $helper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\AuthorizationInterface $authorization,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        array $data,
        array $components = []
    ) {

        $this->helper = $helper;
        $this->urlBuilder = $urlBuilder;
        $this->authorization = $authorization;

        parent::__construct($context, $components, $data);
    }

    /**
     * Init prepare
     *
     * @return void
     */
    public function prepare()
    {
        parent::prepare();

        $config = $this->getConfiguration();

        // Module has to be enabled and ACL assigned to the role.
        if ($this->helper->isEnabled() && $this->authorization->isAllowed('Magenizr_DeleteOrders::deleteorders')) {
            $config['actions'][] = [
                'component' => 'uiComponent',
                'type' => 'delete',
                'label' => __('Delete'),
                'url' => $this->urlBuilder->getUrl('deleteorders/deleteorders/massDelete'),
                'confirm' => [
                    'title' => __('Delete Order(s)'),
                    'message' => __('Are you sure you want to delete selected items?'),
                ]
            ];
        }

        $this->setData('config', $config);
    }
}
