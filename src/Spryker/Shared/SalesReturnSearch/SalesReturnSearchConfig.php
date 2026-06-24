<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\SalesReturnSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class SalesReturnSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * Defines resource name, that will be used for key generation.
     *
     * @var string
     */
    public const RETURN_REASON_RESOURCE_NAME = 'return_reason';

    /**
     * @api
     *
     * Defines queue name as used for processing translation messages.
     *
     * @var string
     */
    public const SYNC_SEARCH_RETURN = 'sync.search.return';

    /**
     * @api
     *
     * Defines queue name as used for processing translation error messages.
     *
     * @var string
     */
    public const SYNC_SEARCH_RETURN_ERROR = 'sync.search.return.error';

    /**
     * @api
     *
     * This events that will be used for key writing.
     *
     * @var string
     */
    public const RETURN_REASON_PUBLISH_WRITE = 'Return.reason.publish_write';

    /**
     * @api
     *
     * This events that will be used for key deleting.
     *
     * @var string
     */
    public const RETURN_REASON_PUBLISH_DELETE = 'Return.reason.publish_delete';

    /**
     * @api
     *
     * This events will be used for spy_sales_return_reason entity creation.
     *
     * @var string
     */
    public const ENTITY_SPY_SALES_RETURN_REASON_CREATE = 'Entity.spy_sales_return_reason.create';

    /**
     * @api
     *
     * This events will be used for spy_sales_return_reason entity changes.
     *
     * @var string
     */
    public const ENTITY_SPY_SALES_RETURN_REASON_UPDATE = 'Entity.spy_sales_return_reason.update';

    /**
     * @api
     *
     * This events will be used for spy_sales_return_reason entity deletion.
     *
     * @var string
     */
    public const ENTITY_SPY_SALES_RETURN_REASON_DELETE = 'Entity.spy_sales_return_reason.delete';
}
