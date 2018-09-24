<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @package     Magenizr_DeleteOrders
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->getScopeConfig('enabled');
    }

    /**
     * @return array
     */
    public function getOrderStatusRestriction()
    {
        return explode(',', $this->getScopeConfig('restrict_order_status'));
    }

    /**
     * @param string $area
     */
    public function getAvailability($area = 'both')
    {
        $availability = $this->getScopeConfig('availability');

        if ($availability == 'both') {
            return true;
        }

        if ($availability == $area && $this->isEnabled()) {
            return true;
        }

        return false;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getScopeConfig($field)
    {
        return $this->scopeConfig->getValue(
            sprintf('sales/magenizr_deleteorders/%s', $field),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
