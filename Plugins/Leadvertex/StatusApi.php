<?php


namespace ApiManager\Plugins\Leadvertex;


use ApiManager\Application\ApiManager;
use ApiManager\Application\Exceptions\ApiException;
use ApiManager\Application\PluginApi;

/**
 * Class StatusApi
 * @package ApiManager\Plugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class StatusApi extends PluginApi
{

    const ADD = "add"; // Добавление нового статуса
    const DELETE = "delete"; // Удалить статус
    const CONTAINER_GET_ALL = "container/getAll"; // Список контейнеров
    const CHANGE_NAME = "change/name"; // Сменить название статуса
    const CHANGE_GROUP = "change/group"; // Сменить группу статуса
    const CHANGE_POSITION = "change/position"; // Сменить позицию статуса
    const CHANGE_GOODS_QUANTITY = "change/goodsQuantity"; // Сменить действия со складом для статуса

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