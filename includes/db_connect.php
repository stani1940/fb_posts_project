<?php
$conn = mysqli_connect('localhost','root',"sitevrc22",'fb_posts');
if (!$conn){
    die("Connection failed ".mysqli_connect_error()." - ".mysqli_connect_errno());
}
session_start();

//else{
//echo "Database connected successfully";
//}
$host = '127.0.0.1';
$db   = 'fb_posts';
$user = 'root';
$pass = 'sitevrc22';
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