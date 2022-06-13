<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

$host = $_ENV["DATABASE_HOST"];
$db   = $_ENV["DATABASE_NAAM"];
$user = $_ENV["DATABASE_GEBRUIKER"];
$pass = $_ENV["DATABASE_WACHTWOORD"];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}