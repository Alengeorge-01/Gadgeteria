<?php
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
}

if (class_exists('Dotenv\\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/php');
    $dotenv->safeLoad();
}

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASSWORD') ?: '';
$dbName = getenv('DB_NAME') ?: 'appliances';

$link = mysqli_connect($dbHost, $dbUser, $dbPass) or die("Connection Error");
mysqli_select_db($link, $dbName) or die("Connection Error");
?>
