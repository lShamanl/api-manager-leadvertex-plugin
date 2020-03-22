<?php
require_once __DIR__ . '/api-manager-leadvertex-plugin/src/bootstrap.php';

use GuzzleHttp\Exception\GuzzleException;
use lShamanl\ApiAnswer\ApiAnswer;
use lShamanl\ApiAnswer\StatusCode;
use lShamanl\ApiManager\Classes\DataGuard;
use lShamanl\ApiManagerPlugins\Leadvertex\AdminApi;
use lShamanl\ApiManagerPlugins\Leadvertex\Entity\Good;
use lShamanl\ApiManagerPlugins\Leadvertex\Fields;

try {
    DataGuard::required([
        'id' => $_POST['id'],
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
        'statusId' => $_POST['statusId'],
    ]);

    if ($_POST['statusId'] != 1) {
        echo new ApiAnswer(false, StatusCode::HTTP_BAD_REQUEST, 'С таким статусом скрипт не работает!');
        http_response_code($e->getCode());
    }

    $lvAdminApi = new AdminApi('offerName','123',AdminApi::UPDATE_ORDER);

    $lvAdminApi->apiManager()
        ->addGetParams([
            'id' => $_POST['id']
        ])
        ->addPostParams([
            Fields::FIO => $_POST['fio'],
            Fields::PHONE => $_POST['phone'],
            Fields::GOODS => [
                Good::MODE_UPDATE => [
                    (new Good(41728,150, 2))->toArray()
                ],
            ]
        ])
        ->sendPostForm();

    echo new ApiAnswer(true, StatusCode::HTTP_OK,'Принято');
    http_response_code(StatusCode::HTTP_OK);
} catch (Exception $e) {
    echo new ApiAnswer(false, $e->getCode(), $e->getMessage());
    http_response_code($e->getCode());
} catch (GuzzleException $e) {
    echo new ApiAnswer(false, $e->getCode(), $e->getMessage());
    http_response_code($e->getCode());
}