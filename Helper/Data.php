<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * Check if module is enabled
     *
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->getScopeConfig('enabled');
    }

    /**
     * Return order status restriction
     *
     * @return array
     */
    public function getOrderStatusRestriction()
    {
        return explode(',', $this->getScopeConfig('restrict_order_status'));
    }

    /**
     * Return availability for restrictions
     *
     * @param string $area
     */
    public function getAvailability($area = 'all')
    {
        $availability = $this->getScopeConfig('availability');

        if ($availability == 'all') {
            return true;
        }

        if ($availability == $area && $this->isEnabled()) {
            return true;
        }

        return false;
    }

    /**
     * Return scope config by field
     *
     * @param string $field
     * @return mixed
     */
    public function getScopeConfig($field)
    {
        return $this->scopeConfig->getValue(
            sprintf('magenizr_deleteorders/general/%s', $field),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
