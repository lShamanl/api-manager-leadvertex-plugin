<?php
require_once __DIR__ . '/api-manager/src/autoload.php';

use ApiManager\Application\Classes\DataGuard;
use ApiManager\Application\Services\ApiService\Components\ApiAnswer;
use ApiManager\Plugins\Leadvertex\AdminApi;
use ApiManager\Plugins\Leadvertex\Entity\Good;
use ApiManager\Plugins\Leadvertex\Fields;
use GuzzleHttp\Exception\GuzzleException;

try {
    DataGuard::required([
        'id' => $_POST['id'],
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
        'statusId' => $_POST['statusId'],
    ]);

    if ($_POST['statusId'] != 1) {
        ApiAnswer::responseRejected('С таким статусом скрипт не работает!', ApiAnswer::CODE_400_BAD_REQUEST, true);
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

    echo ApiAnswer::responseOk('Принято',ApiAnswer::CODE_202_ACCEPTED, true); exit;
} catch (Exception $e) {
    echo ApiAnswer::responseError($e,true); exit;
} catch (GuzzleException $e) {
    echo ApiAnswer::responseError($e,true); exit;
}