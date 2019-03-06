<?php

declare(strict_types=1);

/*
 * This file is part of eoko\magento2.
 *
 * PHP Version 7.1
 *
 * @author    Romain DARY <romain.dary@eoko.fr>
 * @copyright 2011-2018 Eoko. All rights reserved.
 */

namespace Eoko\Magento2\Client\tests\Api\Order;

use Eoko\Magento2\Client\tests\AbstractApiTestCase;

abstract class AbstractOrderApiTestCase extends AbstractApiTestCase
{
    public function sanitizeOrders(array $orders): array
    {
        return array_map(function ($order) {
            return $this->sanitizeOrder($order);
        }, $orders);
    }

    public function sanitizeOrder(array $order): array
    {
        return array_intersect_key($order, array_flip(['entity_id', 'increment_id', 'state', 'status']));
    }
}
