<?php


namespace ApiManager\Plugins\Leadvertex;


use ApiManager\Application\ApiManager;
use ApiManager\Application\Exceptions\ApiException;
use ApiManager\Application\PluginApi;
use Exception;

/**
 * Class AdminApi
 * @package ApiManager\Plugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class AdminApi extends PluginApi
{
    const ADD_ORDER = 'addOrder'; // Импорт заказов
    const UPDATE_ORDER = 'updateOrder'; // Редактирование заказа
    const ADD_GOOD = "addGood"; // Добавление товара
    const ACTIVATE_GOOD_IN_OFFER = "activateGoodInOffer"; // Включить товар в проекте
    const UPDATE_GOOD = "updateGood"; // Редактирование товара
    const INCREASE_GOOD_RESERVE = "increaseGoodReserve"; // Управление остатками - увеличить количество
    const REDUCE_GOOD_RESERVE = "reduceGoodReserve"; // Управление остатками - уменьшить количество

    const GET_STATUS_LIST = "getStatusList"; // Получение списка статусов
    const GET_ORDERS_ID_IN_STATUS = "getOrdersIdsInStatus"; // Получение ID всех заказов в статусе
    const GET_ORDERS_IDS_BY_CONDITION ="getOrdersIdsByCondition"; // Поиск заказов по параметрам
    const GET_OFFER_GOODS = "getOfferGoods"; // Получение данных товаров
    const GET_GOOD_CATEGORIES = "getGoodCategories"; // Получение данных о категориях товаров
    const GET_ORDERS_BY_IDS = "getOrdersByIds"; // Получение данных заказа
    const GET_ORDERS_BY_RUSSIAN_POST_TRACKS = "getOrdersByRussianPostTracks"; // Получение данных заказа по трек-номеру Почты России
    const CHECK_USED_BY_ORDER = "checkUsedByOrder"; // Проверка редактируется ли заказ
    const GET_ORDER_HISTORY = "getOrderHistory"; // Получение истории заказа
    const GET_ORDER_HISTORY_BY_TIME_SAVE = "getOrderHistoryByTimeSave"; // Получение истории заказа за определенный период времени
    const GET_OPERATOR_ACTIONS = "getOperatorActions"; // Получение истории действий оператора
    const GET_OPERATORS = "getOperators"; // Получение информации по операторах
    const GET_ACTIVE_ACTIONS = "getActiveOperators"; // Получение информации по активным операторах
    const GET_ONLINE_OPERATORS = "getOnlineOperators"; // Получение списка операторов онлайн
    const GET_WEBMASTERS = "getWebmasters"; // Получение информации по веб-мастерам
    const GET_WEBMASTER_PAYMENTS = "getWebmasterPayments"; // Получение данных по ставкам веб-мастера
    const GET_WEBMASTER_ORDERED_PAYMENTS ="getWebmasterOrderedPayments"; // Получение данных по заказанным выплатам веб-мастера
    const GET_POST_OFFICE_DATA ="getPostOfficeData"; // Получение данных по заказанным выплатам веб-мастера

    const FIELDS_GET_RULES ="fields/getRules"; // Получить настройки полей формы
    const FIELDS_UPDATE_RULES ="fields/updateRules"; // Редактировать настройки полей формы

    /** @var string */
    protected $method;

    /** @var ApiManager */
    protected $apiManager;

    /**
     * AdminApi constructor.
     * @param string $offerName
     * @param string $apiToken
     * @param string $method
     * @throws Exception
     */
    public function __construct($offerName, $apiToken, $method)
    {
        $this->methodGuard($method);
        $this->apiManager = new ApiManager("https://{$offerName}.leadvertex.ru/api/admin/{$method}.html");

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
            self::ADD_ORDER,
            self::UPDATE_ORDER,
            self::ADD_GOOD,
            self::ACTIVATE_GOOD_IN_OFFER,
            self::UPDATE_GOOD,
            self::INCREASE_GOOD_RESERVE,
            self::REDUCE_GOOD_RESERVE,
            self::GET_STATUS_LIST,
            self::GET_ORDERS_ID_IN_STATUS,
            self::GET_ORDERS_IDS_BY_CONDITION,
            self::GET_OFFER_GOODS,
            self::GET_GOOD_CATEGORIES,
            self::GET_ORDERS_BY_IDS,
            self::GET_ORDERS_BY_RUSSIAN_POST_TRACKS,
            self::CHECK_USED_BY_ORDER,
            self::GET_ORDER_HISTORY,
            self::GET_ORDER_HISTORY_BY_TIME_SAVE,
            self::GET_OPERATOR_ACTIONS,
            self::GET_POST_OFFICE_DATA,
            self::GET_OPERATORS,
            self::GET_ACTIVE_ACTIONS,
            self::GET_ONLINE_OPERATORS,
            self::GET_WEBMASTERS,
            self::GET_WEBMASTER_PAYMENTS,
            self::GET_WEBMASTER_ORDERED_PAYMENTS,
            self::FIELDS_GET_RULES,
            self::FIELDS_UPDATE_RULES,
        ];

        if (!in_array($method, $methodList)) {
            throw new ApiException('Неизвестный метод для Leadvertex');
        }
    }

}