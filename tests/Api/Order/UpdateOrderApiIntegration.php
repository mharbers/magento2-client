<?php
declare(strict_types=1);

namespace Eoko\Magento2\Client\tests\Api\Order;

use Eoko\Magento2\Client\Exception\BadRequestHttpException;

final class UpdateOrderApiIntegration extends AbstractOrderApiTestCase
{
    public function testItShouldUpdateAnOrderStatus(): void
    {
        $expectedOrder = $this->getExpectedOrder();

        $response = $this->createClient()->getOrderApi()->update(
            $expectedOrder['entity_id'], [
            'increment_id' => $expectedOrder['increment_id'],
            'state' => $expectedOrder['state'],
            'status' => $expectedOrder['status'],
        ]);

        $this->assertSameContent(
            $this->sanitizeOrder($expectedOrder),
            $this->sanitizeOrder($response)
        );
    }

    public function testItShouldToggleHoldOnAnOrder(): void
    {
        $entityId = 4;
        $api = $this->createClient()->getOrderApi();

        $this->assertTrue($api->hold($entityId));

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('A hold action is not available.');
        $api->hold($entityId);

        $this->assertTrue($api->unhold($entityId));

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('You cannot remove the hold.');
        $this->createClient()->getOrderApi()->unhold($entityId);
    }

    private function getExpectedOrder(): array
    {
        return [
            'entity_id' => 4,
            'increment_id' => '000000004',
            'state' => 'processing',
            'status' => 'fraud',
        ];
    }
}
