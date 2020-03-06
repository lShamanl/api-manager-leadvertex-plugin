<?php


namespace ApiManager\Plugins\Leadvertex;


use ApiManager\Application\ApiManager;
use ApiManager\Application\Exceptions\ApiException;
use ApiManager\Application\PluginApi;

/**
 * Class StatisticApi
 * @package ApiManager\Plugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class StatisticApi extends PluginApi
{

    /**
     * Статистика по конверсиям
     * https://demo-1.leadvertex.ru/admin/page/api.html#getConversionStatistic
     */
    const CONVERSION = "conversion";

    /**
     * Статистика по операторам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOperatorStatistic
     */
    const OPERATORS = "operators";

    /**
     * Запросить id заказов для статистики по операторам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOperatorStatisticIds
     */
    const GET_ORDER_IDS_FOR_OPERATOR_STATISTIC = "getOrderIdsForOperatorStatistic";

    /**
     * Статистика по выкупаемости
     * https://demo-1.leadvertex.ru/admin/page/api.html#getBuyoutStatistic
     */
    const BUYOUT = "buyout";

    /**
     * Запросить id заказов для статистики по выкупаемости
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrderIdsForBuyoutStat
     */
    const GET_ORDER_IDS_FOR_BUYOUT_STATISTIC = "getOrderIdsForBuyoutStatistic";

    /**
     * Статистика по робо прозвону
     * https://demo-1.leadvertex.ru/admin/page/api.html#getRoboCallsStatistic
     */
    const ROBO_CALLS = "roboCalls";

    /**
     * Статистика по веб-мастерам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getWebmasterStatistic
     */
    const WEBMASTERS = "webmasters";

    /**
     * Статистика по внешним веб-мастерам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getExternalWebmasterStatistic
     */
    const EXTERNAL_WEBMASTERS = "externalWebmasters";

    /** @var string */
    protected $method;

    /** @var ApiManager */
    protected $apiManager;

    /**
     * StatisticApi constructor.
     * @param $offerName
     * @param $apiToken
     * @param $method
     * @throws ApiException
     */
    public function __construct($offerName, $apiToken, $method)
    {
        $this->methodGuard($method);
        $this->apiManager = new ApiManager("https://{$offerName}.leadvertex.ru/api/statistic/{$method}.html");

        $this->apiManager->addGetParams([
            'token' => $apiToken
        ]);
    }

    /**
     * @param string $method
     * @throws ApiException
     */
    protected function methodGuard($method)
    {
        $methodList = [
            self::CONVERSION,
            self::OPERATORS,
            self::GET_ORDER_IDS_FOR_OPERATOR_STATISTIC,
            self::BUYOUT,
            self::GET_ORDER_IDS_FOR_BUYOUT_STATISTIC,
            self::ROBO_CALLS,
            self::WEBMASTERS,
            self::EXTERNAL_WEBMASTERS,
        ];

        if (!in_array($method, $methodList)) {
            throw new ApiException('Неизвестный метод для Leadvertex');
        }
    }
}