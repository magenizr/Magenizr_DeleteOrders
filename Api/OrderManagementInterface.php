<?php
/**
 * Magenizr DeleteOrders
 *
 * @category    Magenizr
 * @copyright   Copyright (c) 2018 - 2023 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\DeleteOrders\Api;

interface OrderManagementInterface
{

    /**
     * Delete a specific order
     *
     * @param integer $orderId
     * @return mixed
     */
    public function delete($orderId);
}
