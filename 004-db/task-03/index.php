<?php

require __DIR__ . '/DatabaseWrapper.php';
require __DIR__ . '/BaseTable.php';
require __DIR__ . '/Shop.php';
require __DIR__ . '/Order.php';
require __DIR__ . '/Client.php';

$pdo = require __DIR__ . '/database.php';

function show($title, $data)
{
    echo $title, ":\n";
    print_r($data);
    echo "\n";
}

$shops = new Shop($pdo);
$clients = new Client($pdo);
$orders = new Order($pdo);

$shop = $shops->insert(['name', 'address'], ['Временный магазин', 'ул. Тестовая, 1']);
show('Добавлен магазин', $shop);

$shop = $shops->update($shop['id'], ['address' => 'ул. Новая, 2']);
show('Изменён магазин', $shop);

show('Найден магазин', $shops->find($shop['id']));

$deleted = $shops->delete($shop['id']);
echo 'Магазин удалён: ', $deleted ? 'да' : 'нет', "\n\n";
show('После удаления магазина', $shops->find($shop['id']));

$client = $clients->insert(['phone', 'name'], ['+7 900 999-99-99', 'Новый клиент']);
show('Добавлен клиент', $client);

$client = $clients->update($client['id'], ['phone' => '+7 900 000-00-00']);
show('Изменён клиент', $client);

show('Найден клиент', $clients->find($client['id']));
$clients->delete($client['id']);

$order = $orders->insert(['created_at', 'client_id', 'shop_id'], ['2025-02-01 10:00:00', 1, 1]);
show('Добавлен заказ', $order);

$order = $orders->update($order['id'], ['created_at' => '2025-02-02 11:00:00']);
show('Изменён заказ', $order);

show('Найден заказ', $orders->find($order['id']));
$orders->delete($order['id']);
