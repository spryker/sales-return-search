<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\SalesReturnSearch;

use Generated\Shared\Transfer\PaginationConfigTransfer;
use Spryker\Client\Kernel\AbstractBundleConfig;

class SalesReturnSearchConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    protected const PAGINATION_DEFAULT_ITEMS_PER_PAGE = 10;

    /**
     * @var int
     */
    protected const PAGINATION_MAX_ITEMS_PER_PAGE = 10000;

    /**
     * @var string
     */
    protected const PAGINATION_PARAMETER_NAME_PAGE = 'page';

    /**
     * @var string
     */
    protected const PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME = 'ipp';

    /**
     * @api
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getReturnReasonSearchPaginationConfigTransfer(): PaginationConfigTransfer
    {
        return (new PaginationConfigTransfer())
            ->setParameterName(static::PAGINATION_PARAMETER_NAME_PAGE)
            ->setItemsPerPageParameterName(static::PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME)
            ->setDefaultItemsPerPage(static::PAGINATION_DEFAULT_ITEMS_PER_PAGE)
            ->setMaxItemsPerPage(static::PAGINATION_MAX_ITEMS_PER_PAGE);
    }
}
