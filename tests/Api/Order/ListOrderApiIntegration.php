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

use Eoko\Magento2\Client\Exception\ServerErrorHttpException;
use Eoko\Magento2\Client\Pagination\ResourceCursorInterface;
use Eoko\Magento2\Client\Search\SearchCriteria;
use Eoko\Magento2\Client\Search\SearchFilter;
use Eoko\Magento2\Client\Search\SearchGroup;

final class ListOrderApiIntegration extends AbstractOrderApiTestCase
{
    public function testListPerPage(): void
    {
        $api = $this->createClient()->getOrderApi();
        $baseUri = $this->getConfiguration()['magento2']['base_uri'];

        $firstPage = $api->listPerPage();

        $this->assertNull($firstPage->getPreviousLink());
        $this->assertNull($firstPage->getPreviousPage());
        $this->assertFalse($firstPage->hasPreviousPage());
        $this->assertFalse($firstPage->hasNextPage());
        $this->assertNull($firstPage->getNextLink());
        $this->assertEquals(5, $firstPage->getCount());
    }

    public function testListPerPageWithSpecificQueryParameter(): void
    {
        $api = $this->createClient()->getOrderApi();
        $baseUri = $this->getConfiguration()['magento2']['base_uri'];

        $searchCriteria = new SearchCriteria();
        $searchGroup = new SearchGroup();
        $searchGroup->addFilter(
            new SearchFilter('state', 'closed', SearchFilter::EQ)
        );
        $searchCriteria->addSearchGroup($searchGroup);

        $firstPage = $api->listPerPage($searchCriteria);

        $this->assertNull($firstPage->getPreviousLink());
        $this->assertNull($firstPage->getPreviousPage());
        $this->assertFalse($firstPage->hasPreviousPage());
        $this->assertFalse($firstPage->hasNextPage());
        $this->assertNull($firstPage->getNextLink());
        $this->assertEquals(1, $firstPage->getCount());
    }

    public function testAll(): void
    {
        $api = $this->createClient()->getOrderApi();

        $orders = $api->all();

        $this->assertInstanceOf(ResourceCursorInterface::class, $orders);

        $orders = $api->all(2);

        $this->assertCount(2, iterator_to_array($orders));
    }

    public function testAllWithUselessQueryParameter(): void
    {
        $api = $this->createClient()->getOrderApi();

        $searchCriteria = new SearchCriteria();
        $searchGroup = new SearchGroup();
        $searchGroup->addFilter(
            new SearchFilter('foo', 'bar', SearchFilter::EQ)
        );
        $searchCriteria->addSearchGroup($searchGroup);

        $this->expectException(ServerErrorHttpException::class);
        $api->all(10, $searchCriteria);
    }
}
