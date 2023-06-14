<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Model\Config\Source;

class Availability implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Array for Availability options
     *
     * @return mixed
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'all', 'label' => 'All'],
            ['value' => 'adminhtml', 'label' => 'Backend'],
            ['value' => 'cli-command', 'label' => 'Command-Line'],
            ['value' => 'rest-api', 'label' => 'REST API']
        ];
    }
}
