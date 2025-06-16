<?php
session_start();
$mahp = $_GET['mahp'] ?? '';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tránh thêm trùng
if (!in_array($mahp, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $mahp;
}

header('Location: hocphan.php');
exit;