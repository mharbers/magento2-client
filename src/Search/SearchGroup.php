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

namespace Eoko\Magento2\Client\Search;

class SearchGroup
{
    /** @var SearchFilter[] */
    protected $filters = [];

    /**
     * @return SearchFilter[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param SearchFilter[] $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @param SearchFilter $filter
     */
    public function addFilter(SearchFilter $filter): void
    {
        $this->filters[] = $filter;
    }

    public function toArray(): array
    {
        $array = [
            'filters' => [],
        ];

        foreach ($this->filters as $filter) {
            $array['filters'][] = $filter->toArray();
        }

        return $array;
    }
}
