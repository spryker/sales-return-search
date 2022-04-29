<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\SalesReturnSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Search\ReturnReasonIndexMap;
use Generated\Shared\Transfer\ReturnReasonSearchCollectionTransfer;
use Generated\Shared\Transfer\ReturnReasonSearchTransfer;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class ReturnReasonSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    /**
     * @var string
     */
    public const NAME = 'ReturnReasonCollection';

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array<string, mixed> $requestParameters
     *
     * @return \Generated\Shared\Transfer\ReturnReasonSearchCollectionTransfer
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): ReturnReasonSearchCollectionTransfer
    {
        $returnReasonSearchCollection = new ReturnReasonSearchCollectionTransfer();

        foreach ($searchResult->getResults() as $document) {
            $returnReasonSearchCollection->addReturnReason(
                $this->getMappedReturnReasonSearchTransfer($document->getSource()[ReturnReasonIndexMap::SEARCH_RESULT_DATA]),
            );
        }

        return $returnReasonSearchCollection->setNbResults($searchResult->getTotalHits());
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return \Generated\Shared\Transfer\ReturnReasonSearchTransfer
     */
    protected function getMappedReturnReasonSearchTransfer(array $data): ReturnReasonSearchTransfer
    {
        return (new ReturnReasonSearchTransfer())->fromArray($data, true);
    }
}
