<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex;


use lShamanl\ApiManager\ApiManager;
use lShamanl\ApiManager\Exceptions\ApiException;
use lShamanl\ApiManager\PluginApi;

/**
 * Class WebmasterApi
 * @package lShamanl\ApiManagerPlugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/webmaster/api
 */
class WebmasterApi extends PluginApi
{

    /**
     * Импорт заказов
     * https://demo-1.leadvertex.ru/webmaster/api#addOrder
     */
    const ADD_ORDER = "addOrder";

    /**
     * Получение списка заказов
     * https://demo-1.leadvertex.ru/webmaster/api#getOrdersByIds
     */
    const GET_ORDERS_BY_IDS = "getOrdersByIds";

    /**
     * Получение баланса
     * https://demo-1.leadvertex.ru/webmaster/api#getBalance
     */
    const GET_BALANCE = "getBalance";

    /**
     * Получение новых заявок на выплату
     * https://demo-1.leadvertex.ru/webmaster/api#getProcessedPayments
     */
    const GET_PROCESSED_PAYMENTS = "getProcessedPayments";

    /** @var string */
    protected $method;

    /** @var ApiManager */
    protected $apiManager;

    /**
     * AdminApi constructor.
     * @param string $offerName
     * @param string $apiToken
     * @param int $webmasterID
     * @param string $method
     * @throws ApiException
     */
    public function __construct($offerName, $apiToken, $webmasterID, $method)
    {
        $this->methodGuard($method);
        $this->apiManager = new ApiManager("https://{$offerName}.leadvertex.ru/api/webmaster/v2/{$method}.html");

        $this->apiManager->addGetParams([
            'token' => $apiToken,
            'webmasterID' => $webmasterID
        ]);
    }

    /**
     * @param string $method
     * @throws ApiException
     */
    protected function methodGuard($method)
    {
        $methodList = [
            self::ADD_ORDER,
            self::GET_ORDERS_BY_IDS,
            self::GET_BALANCE,
            self::GET_PROCESSED_PAYMENTS,
        ];

        if (!in_array($method, $methodList)) {
            throw new ApiException('Неизвестный метод для Leadvertex');
        }
    }
}