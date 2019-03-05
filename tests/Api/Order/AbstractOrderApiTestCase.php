<?php
declare(strict_types=1);

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
