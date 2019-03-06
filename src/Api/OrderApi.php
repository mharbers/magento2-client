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

namespace Eoko\Magento2\Client\Api;

use Eoko\Magento2\Client\Client\ResourceClientInterface;
use Eoko\Magento2\Client\Exception\InvalidArgumentException;
use Eoko\Magento2\Client\Pagination\PageFactoryInterface;
use Eoko\Magento2\Client\Pagination\PageInterface;
use Eoko\Magento2\Client\Pagination\ResourceCursorFactoryInterface;
use Eoko\Magento2\Client\Pagination\ResourceCursorInterface;
use Eoko\Magento2\Client\Search\SearchCriteria;

class OrderApi implements OrderApiInterface
{
    private const ORDERS_URI = 'V1/orders';
    private const ORDER_URI = 'V1/orders/%s';
    private const ORDER_HOLD_URI = 'V1/orders/%s/hold';
    private const ORDER_UNHOLD_URI = 'V1/orders/%s/unhold';

    /** @var ResourceClientInterface */
    protected $resourceClient;

    /** @var PageFactoryInterface */
    protected $pageFactory;

    /** @var ResourceCursorFactoryInterface */
    protected $cursorFactory;

    /**
     * @param ResourceClientInterface        $resourceClient
     * @param PageFactoryInterface           $pageFactory
     * @param ResourceCursorFactoryInterface $cursorFactory
     */
    public function __construct(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->resourceClient = $resourceClient;
        $this->pageFactory = $pageFactory;
        $this->cursorFactory = $cursorFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function listPerPage(?SearchCriteria $searchCriteria = null): PageInterface
    {
        if (null === $searchCriteria) {
            $searchCriteria = new SearchCriteria();
        }

        $queryParameters['searchCriteria'] = $searchCriteria->toArray();

        $data = $this->resourceClient->getResources(static::ORDERS_URI, [], $queryParameters);

        return $this->pageFactory->createPage($data);
    }

    /**
     * {@inheritdoc}
     */
    public function all($limit = 100, ?SearchCriteria $searchCriteria = null): ResourceCursorInterface
    {
        $firstPage = $this->listPerPage($searchCriteria);

        return $this->cursorFactory->createCursor($limit, $firstPage);
    }

    /**
     * {@inheritdoc}
     */
    public function get($orderId): array
    {
        return $this->resourceClient->getResource(static::ORDER_URI, [$orderId]);
    }

    public function update($code, array $data = []): array
    {
        if (array_key_exists('entity_id', $data)) {
            throw new InvalidArgumentException('The parameter "entity_id" should not be defined in the data parameter');
        }

        $data = [
            'entity' => array_merge(
                ['entity_id' => (string) $code],
                $data
            ),
        ];

        return $this->resourceClient->createResource(static::ORDERS_URI, [], $data);
    }

    public function hold(int $entityId): bool
    {
        return $this->resourceClient->createResource(static::ORDER_HOLD_URI, [(string) $entityId])[0];
    }

    public function unhold(int $entityId): bool
    {
        return $this->resourceClient->createResource(static::ORDER_UNHOLD_URI, [(string) $entityId])[0];
    }
}
