<?php
$host = 'localhost';
$db = 'test1';
$user = 'root';
$pass = ''; // hoặc '123456' tùy hệ thống

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>