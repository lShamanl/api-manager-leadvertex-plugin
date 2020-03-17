<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex;



use lShamanl\ApiManager\ApiManager;
use lShamanl\ApiManager\Exceptions\ApiException;
use lShamanl\ApiManager\PluginApi;

/**
 * Class StatusApi
 * @package lShamanl\ApiManagerPlugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class StatusApi extends PluginApi
{

    /**
     * Добавление нового статуса
     * https://demo-1.leadvertex.ru/admin/page/api.html#addStatus
     */
    const ADD = "add";

    /**
     * Удалить статус
     * https://demo-1.leadvertex.ru/admin/page/api.html#deleteStatus
     */
    const DELETE = "delete";

    /**
     * Список контейнеров
     * https://demo-1.leadvertex.ru/admin/page/api.html#containerList
     */
    const CONTAINER_GET_ALL = "container/getAll";

    /**
     * Сменить название статуса
     * https://demo-1.leadvertex.ru/admin/page/api.html#changeName
     */
    const CHANGE_NAME = "change/name";

    /**
     * Сменить группу статуса
     * https://demo-1.leadvertex.ru/admin/page/api.html#changeGroup
     */
    const CHANGE_GROUP = "change/group";

    /**
     * Сменить позицию статуса
     * https://demo-1.leadvertex.ru/admin/page/api.html#changePosition
     */
    const CHANGE_POSITION = "change/position";

    /**
     * Сменить действия со складом для статуса
     * https://demo-1.leadvertex.ru/admin/page/api.html#changeGoodsQuantity
     */
    const CHANGE_GOODS_QUANTITY = "change/goodsQuantity";

    /** @var string */
    protected $method;

    /** @var ApiManager */
    protected $apiManager;

    /**
     * StatusApi constructor.
     * @param $offerName
     * @param $apiToken
     * @param $method
     * @throws ApiException
     */
    public function __construct($offerName, $apiToken, $method)
    {
        $this->methodGuard($method);
        $this->apiManager = new ApiManager("https://{$offerName}.leadvertex.ru/api/status/{$method}.html");

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
            self::ADD,
            self::DELETE,
            self::CONTAINER_GET_ALL,
            self::CHANGE_NAME,
            self::CHANGE_GROUP,
            self::CHANGE_POSITION,
            self::CHANGE_GOODS_QUANTITY,
        ];

        if (!in_array($method, $methodList)) {
            throw new ApiException('Неизвестный метод для Leadvertex');
        }
    }
}