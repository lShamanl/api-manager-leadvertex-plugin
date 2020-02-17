# ApiManager
Информация о том, как пользоваться библиотекой ApiManager:
https://github.com/lShamanl/api-manager

# Установка
```
composer require lshamanl/api-manager-leadvertex-plugin
```

## Примеры пользования плагином:

### Добавление заказа от лица администратора
```php
try {
    DataGuard::required([
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
    ]);

    $lvAdminApi = new AdminApi('offerName','123', AdminApi::ADD_ORDER);

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
```

### Добавление заказа от лица вебмастера
```php
try {
    DataGuard::required([
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
    ]);

    $lvAdminApi = new WebmasterApi('offerName','123', 1,WebmasterApi::ADD_ORDER);

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
```

## Обновление данных заказа:
```php
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
```