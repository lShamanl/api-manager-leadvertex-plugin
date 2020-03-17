<?php
require_once __DIR__ . '/api-manager-leadvertex-plugin/src/bootstrap.php';


use GuzzleHttp\Exception\GuzzleException;
use lShamanl\ApiAnswer\ApiAnswer;
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

    echo ApiAnswer::responseOk('Принято',ApiAnswer::CODE_202_ACCEPTED, true); exit;
} catch (Exception $e) {
    echo ApiAnswer::responseError($e,true); exit;
} catch (GuzzleException $e) {
    echo ApiAnswer::responseError($e,true); exit;
}