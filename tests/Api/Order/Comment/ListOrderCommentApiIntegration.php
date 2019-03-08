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

namespace Eoko\Magento2\Client\tests\Api\Order\Comment;

use Eoko\Magento2\Client\tests\Api\Order\AbstractOrderApiTestCase;

final class ListOrderCommentApiIntegration extends AbstractOrderApiTestCase
{
    public function testUpdate()
    {
        $api = $this->createClient()->getOrderCommentApi();

        $response = $api->update(
            '5', [
            'is_customer_notified' => 0,
            'is_visible_on_front' => 1,
            'status' => 'fraud',
        ]);

        $this->assertArraySubset([0 => true], $response);
    }
}
