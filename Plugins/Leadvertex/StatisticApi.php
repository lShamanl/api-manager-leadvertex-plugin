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

    const CONVERSION = "conversion"; // Статистика по конверсиям
    const OPERATORS = "operators"; // Статистика по операторам
    const GET_ORDER_IDS_FOR_OPERATOR_STATISTIC = "getOrderIdsForOperatorStatistic"; // Запросить id заказов для статистики по операторам
    const BUYOUT = "buyout"; // Статистика по выкупаемости
    const GET_ORDER_IDS_FOR_BUYOUT_STATISTIC = "getOrderIdsForBuyoutStatistic"; // Запросить id заказов для статистики по выкупаемости
    const ROBO_CALLS = "roboCalls"; // Статистика по робо прозвону
    const WEBMASTERS = "webmasters"; // Статистика по веб-мастерам
    const EXTERNAL_WEBMASTERS = "externalWebmasters"; // Статистика по внешним веб-мастерам

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