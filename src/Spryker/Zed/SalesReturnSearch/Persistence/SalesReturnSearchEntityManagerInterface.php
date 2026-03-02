<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesReturnSearch\Persistence;

use Generated\Shared\Transfer\ReturnReasonSearchTransfer;

interface SalesReturnSearchEntityManagerInterface
{
    /**
     * @param array<int> $returnReasonIds
     *
     * @return void
     */
    public function deleteReturnReasonSearchByReturnReasonIds(array $returnReasonIds): void;

    public function saveReturnReasonSearch(ReturnReasonSearchTransfer $returnReasonSearchTransfer): void;
}
