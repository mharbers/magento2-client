<?php
declare(strict_types=1);

namespace Eoko\Magento2\Client\tests\Api\Order;

final class GetOrderApiIntegration extends AbstractOrderApiTestCase
{
    public function testGet(): void
    {
        $api = $this->createClient()->getOrderApi();

        $order = $api->get('000000001');

        $this->assertSame('000000001', $order['increment_id']);
        $this->assertSame(1, $order['entity_id']);
        $this->assertSame('roni_cost@example.com', $order['extension_attributes']['shipping_assignments'][0]['shipping']['address']['email']);
        $this->assertCount(1, $order['items']);
    }
}
