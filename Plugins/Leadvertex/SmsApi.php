<?php


namespace ApiManager\Plugins\Leadvertex;


use ApiManager\Application\ApiManager;
use ApiManager\Application\Exceptions\ApiException;
use ApiManager\Application\PluginApi;

/**
 * Class SmsApi
 * @package ApiManager\Plugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class SmsApi extends PluginApi
{

    const TEMPLATES = "templates"; // Получение списка шаблонов SMS
    const PROVIDERS = "providers"; // Получение списка провайдеров SMS
    const SEND_TEMPLATE = "sendTemplate"; // Отправка SMS по шаблону
    const SEND_TEXT = "sendText"; // Отправка произвольного текста
    const STATUS = "status"; // Просмотр статуса отправленных SMS
    const CREATE_TEMPLATE = "createTemplate"; // Создание шаблона SMS
    const DELETE_TEMPLATE = "deleteTemplate"; // Удалить шаблон SMS

    /** @var string */
    protected $method;

    /** @var ApiManager */
    protected $apiManager;

    /**
     * SmsApi constructor.
     * @param $offerName
     * @param $apiToken
     * @param $method
     * @throws ApiException
     */
    public function __construct($offerName, $apiToken, $method)
    {
        $this->methodGuard($method);
        $this->apiManager = new ApiManager("https://{$offerName}.leadvertex.ru/api/sms/{$method}.html");

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
            self::TEMPLATES,
            self::PROVIDERS,
            self::SEND_TEMPLATE,
            self::SEND_TEXT,
            self::STATUS,
            self::CREATE_TEMPLATE,
            self::DELETE_TEMPLATE,
        ];

        if (!in_array($method, $methodList)) {
            throw new ApiException('Неизвестный метод для Leadvertex');
        }
    }
}