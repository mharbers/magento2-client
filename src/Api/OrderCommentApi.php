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

final class OrderCommentApi implements OrderCommentApiInterface
{
    private const ORDER_COMMENT_URI = 'V1/orders/%s/comments';

    /**
     * @var \Eoko\Magento2\Client\Client\ResourceClientInterface
     */
    private $resourceClient;

    public function __construct(
        ResourceClientInterface $resourceClient
    ) {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function update($code, array $data = []): array
    {
        $data = [
            'statusHistory' => $data,
        ];

        return $this->resourceClient->createResource(
            static::ORDER_COMMENT_URI,
            [$code],
            $data
        );
    }
}
