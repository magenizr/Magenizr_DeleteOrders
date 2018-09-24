<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @package     Magenizr_DeleteOrders
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Model\Config\Source;

class Availability implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return mixed
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'both', 'label' => 'Both'],
            ['value' => 'adminhtml', 'label' => 'Backend'],
            ['value' => 'cli-command', 'label' => 'Command-Line'],
        ];
    }
}
