<?php

$databaseFile = __DIR__ . '/database.sqlite';

if (!file_exists($databaseFile)) {
    $setup = new PDO('sqlite:' . $databaseFile);
    $setup->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $setup->exec(file_get_contents(__DIR__ . '/../task-02/setup.sql'));
}

$pdo = new PDO('sqlite:' . $databaseFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->exec('PRAGMA foreign_keys = ON');

return $pdo;
