<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
$stmt->execute([$id]);
header('Location: index.php');
exit;