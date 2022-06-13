<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

echo $_ENV["DATABASE_HOST"];