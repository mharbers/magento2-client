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

/**
 * Client to use the Magento API.
 */
interface MagentoClientInterface
{
    /**
     * Gets the authentication access token.
     *
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * Gets the authentication refresh token.
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string;

    /**
     * Gets the product API.
     *
     * @return ProductApiInterface
     */
    public function getProductApi(): ProductApiInterface;

    /**
     * Gets the Order API.
     *
     * @return OrderApiInterface
     */
    public function getOrderApi(): OrderApiInterface;

    /**
     * Get the Order Comment API.
     *
     * @return OrderCommentApiInterface
     */
    public function getOrderCommentApi(): OrderCommentApiInterface;

    /**
     *  Gets the admin token API.
     *
     * @return AdminTokenApiInterface
     */
    public function getAdminTokenApi(): AdminTokenApiInterface;
}
