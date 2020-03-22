<?php
require_once __DIR__ . '/api-manager-leadvertex-plugin/src/bootstrap.php';


use GuzzleHttp\Exception\GuzzleException;
use lShamanl\ApiAnswer\ApiAnswer;
use lShamanl\ApiAnswer\StatusCode;
use lShamanl\ApiManager\Classes\DataGuard;
use lShamanl\ApiManager\Classes\DataHelper;
use lShamanl\ApiManagerPlugins\Leadvertex\AdminApi;
use lShamanl\ApiManagerPlugins\Leadvertex\Entity\Good;
use lShamanl\ApiManagerPlugins\Leadvertex\Fields;

try {
    DataGuard::required([
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
    ]);

    $lvAdminApi = new AdminApi('offerName','123',AdminApi::ADD_ORDER);

    $lvAdminApi->apiManager()
        ->addGetParams([])
        ->addPostParams([
            Fields::FIO => $_POST['fio'],
            Fields::PHONE => $_POST['phone'],
            Fields::DOMAIN => DataHelper::getDomain(),
            Fields::IP => DataHelper::getUserIp(),
            Fields::UTM_SOURCE => $_POST['utm_source'],
            Fields::UTM_MEDIUM => $_POST['utm_medium'],
            Fields::UTM_CAMPAIGN => $_POST['utm_campaign'],
            Fields::UTM_TERM => $_POST['utm_term'],
            Fields::UTM_CONTENT => $_POST['utm_content'],
            Fields::GOODS => [
                (new Good(41728,150, 1))->toArray()
            ]
        ])
        ->sendPostForm();

    header('location: /');

    echo new ApiAnswer(true, StatusCode::HTTP_OK,'Принято');
    http_response_code(StatusCode::HTTP_OK);
} catch (Exception $e) {
    echo new ApiAnswer(false, $e->getCode(), $e->getMessage());
    http_response_code($e->getCode());
} catch (GuzzleException $e) {
    echo new ApiAnswer(false, $e->getCode(), $e->getMessage());
    http_response_code($e->getCode());
}