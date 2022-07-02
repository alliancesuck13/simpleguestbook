<?php

$host = 'localhost';
$db = 'guestbook_db';
$user = 'root';
$password = 'root';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $password, $options);

// var_dump($pdo);
