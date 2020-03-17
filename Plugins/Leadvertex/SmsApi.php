<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex;


use lShamanl\ApiManager\ApiManager;
use lShamanl\ApiManager\Exceptions\ApiException;
use lShamanl\ApiManager\PluginApi;

/**
 * Class SmsApi
 * @package lShamanl\ApiManagerPlugins\Leadvertex
 * Документация: https://demo-1.leadvertex.ru/admin/page/api.html
 */
class SmsApi extends PluginApi
{

    /**
     * Получение списка шаблонов SMS
     * https://demo-1.leadvertex.ru/admin/page/api.html#getTemplates
     */
    const TEMPLATES = "templates";

    /**
     * Получение списка провайдеров SMS
     * https://demo-1.leadvertex.ru/admin/page/api.html#getProviders
     */
    const PROVIDERS = "providers";

    /**
     * Отправка SMS по шаблону
     * https://demo-1.leadvertex.ru/admin/page/api.html#sendTemplate
     */
    const SEND_TEMPLATE = "sendTemplate";

    /**
     * Отправка произвольного текста
     * https://demo-1.leadvertex.ru/admin/page/api.html#sendText
     */
    const SEND_TEXT = "sendText";

    /**
     * Просмотр статуса отправленных SMS
     * https://demo-1.leadvertex.ru/admin/page/api.html#statusSms
     */
    const STATUS = "status";

    /**
     * Создание шаблона SMS
     * https://demo-1.leadvertex.ru/admin/page/api.html#createTemplate
     */
    const CREATE_TEMPLATE = "createTemplate";

    /**
     * Удалить шаблон SMS
     * https://demo-1.leadvertex.ru/admin/page/api.html#deleteTemplate
     */
    const DELETE_TEMPLATE = "deleteTemplate";

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