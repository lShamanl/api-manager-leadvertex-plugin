<?php


namespace ApiManager\Plugins\Leadvertex;


use ApiManager\Application\ApiManager;
use ApiManager\Application\Exceptions\ApiException;
use ApiManager\Application\PluginApi;

/**
 * Class WebmasterApi
 * @package ApiManager\Plugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/webmaster/api
 */
class WebmasterApi extends PluginApi
{

    const ADD_ORDER = "addOrder"; // Импорт заказов
    const GET_ORDERS_BY_IDS = "getOrdersByIds"; // Получение списка заказов
    const GET_BALANCE = "getBalance"; // Получение баланса
    const GET_PROCESSED_PAYMENTS = "getProcessedPayments"; // Получение новых заявок на выплату

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