<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\SalesReturnSearch;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\SalesReturnSearch\Dependency\Client\SalesReturnSearchToSearchClientBridge;
use Spryker\Client\SalesReturnSearch\Plugin\Elasticsearch\Query\ReturnReasonSearchQueryPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \Spryker\Client\SalesReturnSearch\SalesReturnSearchConfig getConfig()
 */
class SalesReturnSearchDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    /**
     * @var string
     */
    public const PLUGIN_RETURN_REASON_SEARCH_QUERY = 'PLUGIN_RETURN_REASON_SEARCH_QUERY';

    /**
     * @var string
     */
    public const PLUGINS_RETURN_REASON_SEARCH_RESULT_FORMATTER = 'PLUGINS_RETURN_REASON_SEARCH_RESULT_FORMATTER';

    /**
     * @var string
     */
    public const PLUGINS_RETURN_REASON_SEARCH_QUERY_EXPANDER = 'PLUGINS_RETURN_REASON_SEARCH_QUERY_EXPANDER';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addSearchClient($container);
        $container = $this->addReturnReasonSearchQueryPlugin($container);
        $container = $this->addReturnReasonSearchResultFormatterPlugins($container);
        $container = $this->addReturnReasonSearchQueryExpanderPlugins($container);

        return $container;
    }

    protected function addSearchClient(Container $container): Container
    {
        $container->set(static::CLIENT_SEARCH, function (Container $container) {
            return new SalesReturnSearchToSearchClientBridge(
                $container->getLocator()->search()->client(),
            );
        });

        return $container;
    }

    protected function addReturnReasonSearchQueryPlugin(Container $container): Container
    {
        $container->set(static::PLUGIN_RETURN_REASON_SEARCH_QUERY, function () {
            return $this->createReturnReasonSearchQueryPlugin();
        });

        return $container;
    }

    protected function addReturnReasonSearchResultFormatterPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_RETURN_REASON_SEARCH_RESULT_FORMATTER, function () {
            return $this->getReturnReasonSearchResultFormatterPlugins();
        });

        return $container;
    }

    protected function addReturnReasonSearchQueryExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_RETURN_REASON_SEARCH_QUERY_EXPANDER, function () {
            return $this->getReturnReasonSearchQueryExpanderPlugins();
        });

        return $container;
    }

    protected function createReturnReasonSearchQueryPlugin(): QueryInterface
    {
        return new ReturnReasonSearchQueryPlugin();
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getReturnReasonSearchResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getReturnReasonSearchQueryExpanderPlugins(): array
    {
        return [];
    }
}
