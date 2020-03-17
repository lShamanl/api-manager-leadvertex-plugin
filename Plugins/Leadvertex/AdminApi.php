<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex;


use Exception;
use lShamanl\ApiManager\ApiManager;
use lShamanl\ApiManager\Exceptions\ApiException;
use lShamanl\ApiManager\PluginApi;

/**
 * Class AdminApi
 * @package lShamanl\ApiManagerPlugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class AdminApi extends PluginApi
{
    /**
     * Импорт заказов
     * https://demo-1.leadvertex.ru/admin/page/api.html#importOrder
     */
    const ADD_ORDER = 'addOrder';

    /**
     * Редактирование заказа
     * https://demo-1.leadvertex.ru/admin/page/api.html#updateOrder
     */
    const UPDATE_ORDER = 'updateOrder';

    /**
     * Добавление товара
     * https://demo-1.leadvertex.ru/admin/page/api.html#addGood
     */
    const ADD_GOOD = "addGood";

    /**
     * Включить товар в проекте
     * https://demo-1.leadvertex.ru/admin/page/api.html#activateGoodInOffer
     */
    const ACTIVATE_GOOD_IN_OFFER = "activateGoodInOffer";

    /**
     * Редактирование товара
     * https://demo-1.leadvertex.ru/admin/page/api.html#updateGood
     */
    const UPDATE_GOOD = "updateGood";

    /**
     * Управление остатками - увеличить количество
     * https://demo-1.leadvertex.ru/admin/page/api.html#increaseGoodReserve
     */
    const INCREASE_GOOD_RESERVE = "increaseGoodReserve";

    /**
     * Управление остатками  - уменьшить количество
     * https://demo-1.leadvertex.ru/admin/page/api.html#reduceGoodReserve
     */
    const REDUCE_GOOD_RESERVE = "reduceGoodReserve";

    /**
     * Получение списка статусов
     * https://demo-1.leadvertex.ru/admin/page/api.html#getStatusList
     */
    const GET_STATUS_LIST = "getStatusList";

    /**
     * Получение ID  всех заказов в статусе
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrdersIdsInStatus
     */
    const GET_ORDERS_ID_IN_STATUS = "getOrdersIdsInStatus";

    /**
     * Поиск заказов по параметрам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrdersIdsByCondition
     */
    const GET_ORDERS_IDS_BY_CONDITION ="getOrdersIdsByCondition";

    /**
     * Получение данных товаров
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOfferGoods
     */
    const GET_OFFER_GOODS = "getOfferGoods";

    /**
     * Получение данных  о категориях товаров
     * https://demo-1.leadvertex.ru/admin/page/api.html#getGoodCategories
     */
    const GET_GOOD_CATEGORIES = "getGoodCategories";

    /**
     * Получение данных  заказа
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrdersByIds
     */
    const GET_ORDERS_BY_IDS = "getOrdersByIds";

    /**
     * Получение данных  заказа по трек-номеру Почты России
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrdersByRussianPostTracks
     */
    const GET_ORDERS_BY_RUSSIAN_POST_TRACKS = "getOrdersByRussianPostTracks";

    /**
     * Проверка редактируется  ли заказ
     * https://demo-1.leadvertex.ru/admin/page/api.html#checkUsedByOrder
     */
    const CHECK_USED_BY_ORDER = "checkUsedByOrder";

    /**
     * Получение истории  заказа
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrderHistory
     */
    const GET_ORDER_HISTORY = "getOrderHistory";

    /**
     * Получение истории  заказа за определенный период времени
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOrderHistoryByTimeSave
     */
    const GET_ORDER_HISTORY_BY_TIME_SAVE = "getOrderHistoryByTimeSave";

    /**
     * Получение истории  действий оператора
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOperatorActions
     */
    const GET_OPERATOR_ACTIONS = "getOperatorActions";

    /**
     * Получение информации  по операторах
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOperators
     */
    const GET_OPERATORS = "getOperators";

    /**
     * Получение информации  по активным операторах
     * https://demo-1.leadvertex.ru/admin/page/api.html#getActiveOperators
     */
    const GET_ACTIVE_ACTIONS = "getActiveOperators";

    /**
     * Получение списка  операторов онлайн
     * https://demo-1.leadvertex.ru/admin/page/api.html#getOnlineOperators
     */
    const GET_ONLINE_OPERATORS = "getOnlineOperators";

    /**
     * Получение информации  по веб-мастерам
     * https://demo-1.leadvertex.ru/admin/page/api.html#getWebmasters
     */
    const GET_WEBMASTERS = "getWebmasters";

    /**
     * Получение данных  по ставкам веб-мастера
     * https://demo-1.leadvertex.ru/admin/page/api.html#getWebmasterPayments
     */
    const GET_WEBMASTER_PAYMENTS = "getWebmasterPayments";

    /**
     * Получение данных  по заказанным выплатам веб-мастера
     * https://demo-1.leadvertex.ru/admin/page/api.html#getWebmasterOrderedPayments
     */
    const GET_WEBMASTER_ORDERED_PAYMENTS ="getWebmasterOrderedPayments";

    /**
     * Получение данных  по заказанным выплатам веб-мастера
     * https://demo-1.leadvertex.ru/admin/page/api.html#getPostOfficeData
     */
    const GET_POST_OFFICE_DATA ="getPostOfficeData";

    /**
     * Получить настройки полей формы
     * https://demo-1.leadvertex.ru/admin/page/api.html#getFieldsRules
     */
    const FIELDS_GET_RULES ="fields/getRules";

    /**
     * Редактировать настройки полей формы
     * https://demo-1.leadvertex.ru/admin/page/api.html#updateFieldsRules
     */
    const FIELDS_UPDATE_RULES ="fields/updateRules";


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