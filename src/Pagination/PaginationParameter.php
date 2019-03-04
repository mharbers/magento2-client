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

namespace Eoko\Magento2\Client\Pagination;

/**
 * This class contains the list of parameters to use for the pagination of the API.
 */
final class PaginationParameter
{
    public const SEARCH = 'search';
    public const LIMIT = 'limit';
    public const WITH_COUNT = 'with_count';
}
