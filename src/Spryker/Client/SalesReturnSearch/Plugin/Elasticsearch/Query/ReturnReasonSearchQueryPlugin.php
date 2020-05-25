<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\SalesReturnSearch\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Match;
use Generated\Shared\Search\ReturnReasonIndexMap;
use Generated\Shared\Transfer\ReturnReasonSearchRequestTransfer;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;
use Spryker\Shared\SalesReturnSearch\SalesReturnSearchConfig;

/**
 * @method \Spryker\Client\SalesReturnSearch\SalesReturnSearchConfig getConfig()
 */
class ReturnReasonSearchQueryPlugin extends AbstractPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    protected const SOURCE_IDENTIFIER = 'return_reason';

    /**
     * @var \Elastica\Query
     */
    protected $query;

    /**
     * @var \Generated\Shared\Transfer\ReturnReasonSearchRequestTransfer
     */
    protected $returnReasonSearchRequestTransfer;

    /**
     * @var \Generated\Shared\Transfer\SearchContextTransfer
     */
    protected $searchContextTransfer;

    /**
     * @param \Generated\Shared\Transfer\ReturnReasonSearchRequestTransfer $returnReasonSearchRequestTransfer
     */
    public function __construct(ReturnReasonSearchRequestTransfer $returnReasonSearchRequestTransfer)
    {
        $this->returnReasonSearchRequestTransfer = $returnReasonSearchRequestTransfer;
        $this->query = $this->createSearchQuery();
    }

    /**
     * {@inheritDoc}
     * - Returns query object for Return Reason search.
     *
     * @api
     *
     * @return \Elastica\Query
     */
    public function getSearchQuery(): Query
    {
        return $this->query;
    }

    /**
     * {@inheritDoc}
     * - Defines context for Return Reason search.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\SearchContextTransfer
     */
    public function getSearchContext(): SearchContextTransfer
    {
        if (!$this->hasSearchContext()) {
            $this->setupDefaultSearchContext();
        }

        return $this->searchContextTransfer;
    }

    /**
     * {@inheritDoc}
     * - Sets context for Return Reason search.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SearchContextTransfer $searchContextTransfer
     *
     * @return void
     */
    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        $this->searchContextTransfer = $searchContextTransfer;
    }

    /**
     * @return \Elastica\Query
     */
    protected function createSearchQuery(): Query
    {
        $query = new Query();

        $query = $this->setQuery($query);
        $query = $query->setSource([ReturnReasonIndexMap::SEARCH_RESULT_DATA]);
        $query = $this->setFilter($query);

        return $query;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @return \Elastica\Query
     */
    protected function setFilter(Query $query): Query
    {
        $filterTransfer = $this->returnReasonSearchRequestTransfer->getFilter();

        if (!$filterTransfer) {
            return $query;
        }

        if ($filterTransfer->getLimit()) {
            $query->setSize($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset()) {
            $query->setFrom($filterTransfer->getOffset());
        }

        return $query;
    }

    /**
     * @param \Elastica\Query $baseQuery
     *
     * @return \Elastica\Query
     */
    protected function setQuery(Query $baseQuery): Query
    {
        $boolQuery = new BoolQuery();
        $boolQuery = $this->setTypeFilter($boolQuery);

        return $baseQuery->setQuery($boolQuery);
    }

    /**
     * @param \Elastica\Query\BoolQuery $boolQuery
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function setTypeFilter(BoolQuery $boolQuery): BoolQuery
    {
        $typeFilter = new Match();
        $typeFilter->setField(ReturnReasonIndexMap::TYPE, SalesReturnSearchConfig::RETURN_REASON_RESOURCE_NAME);

        return $boolQuery->addMust($typeFilter);
    }

    /**
     * @return void
     */
    protected function setupDefaultSearchContext(): void
    {
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier(static::SOURCE_IDENTIFIER);

        $this->searchContextTransfer = $searchContextTransfer;
    }

    /**
     * @return bool
     */
    protected function hasSearchContext(): bool
    {
        return (bool)$this->searchContextTransfer;
    }
}
