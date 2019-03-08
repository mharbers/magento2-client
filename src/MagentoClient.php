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

namespace Eoko\Magento2\Client;

use Eoko\Magento2\Client\Api\AdminTokenApiInterface;
use Eoko\Magento2\Client\Api\OrderApiInterface;
use Eoko\Magento2\Client\Api\OrderCommentApiInterface;
use Eoko\Magento2\Client\Api\ProductApiInterface;
use Eoko\Magento2\Client\Security\Authentication;
use Eoko\Magento2\Client\Security\AuthenticationInterface;

/**
 * This class is the implementation of the client to use the Magento API.
 */
class MagentoClient implements MagentoClientInterface
{
    /** @var Authentication */
    protected $authentication;

    /** @var ProductApiInterface */
    protected $productApi;

    /** @var OrderApiInterface */
    protected $orderApi;

    /** @var AdminTokenApiInterface */
    private $adminTokenApi;
    /**
     * @var \Eoko\Magento2\Client\Api\OrderCommentApiInterface
     */
    private $orderCommentApi;

    /**
     * @param AuthenticationInterface|null $authentication
     * @param AdminTokenApiInterface       $adminTokenApi
     * @param ProductApiInterface          $productApi
     * @param OrderApiInterface            $orderApi
     * @param OrderCommentApiInterface     $orderCommentApi
     */
    public function __construct(
        AuthenticationInterface $authentication = null,
        AdminTokenApiInterface $adminTokenApi,
        ProductApiInterface $productApi,
        OrderApiInterface $orderApi,
        OrderCommentApiInterface $orderCommentApi
    ) {
        $this->authentication = $authentication;
        $this->adminTokenApi = $adminTokenApi;
        $this->productApi = $productApi;
        $this->orderApi = $orderApi;
        $this->orderCommentApi = $orderCommentApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(): ?string
    {
        return $this->authentication->getAccessToken();
    }

    /**
     * {@inheritdoc}
     */
    public function getRefreshToken(): ?string
    {
        return $this->authentication->getRefreshToken();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductApi(): ProductApiInterface
    {
        return $this->productApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderApi(): OrderApiInterface
    {
        return $this->orderApi;
    }

    public function getOrderCommentApi(): OrderCommentApiInterface
    {
        return $this->orderCommentApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminTokenApi(): AdminTokenApiInterface
    {
        return $this->adminTokenApi;
    }
}
