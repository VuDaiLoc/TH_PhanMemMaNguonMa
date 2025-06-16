<?php
include 'db.php';
session_start();

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<p>Chưa chọn học phần nào.</p>";
    echo '<a href="hocphan.php">⬅ Quay lại</a>';
    exit;
}

// Lấy thông tin học phần từ DB
$placeholders = implode(',', array_fill(0, count($cart), '?'));
$stmt = $pdo->prepare("SELECT * FROM HocPhan WHERE MaHP IN ($placeholders)");
$stmt->execute($cart);
$hps = $stmt->fetchAll();
?>

<h2>Học phần đã chọn</h2>
<a href="hocphan.php">➕ Tiếp tục chọn</a> | 
<a href="clear-cart.php" onclick="return confirm('Xoá tất cả?')">🗑 Xóa tất cả</a>

<table border="1" cellpadding="8">
    <tr><th>Mã HP</th><th>Tên học phần</th><th>Số tín chỉ</th><th>Hành động</th></tr>
    <?php foreach ($hps as $hp): ?>
    <tr>
        <td><?= $hp['MaHP'] ?></td>
        <td><?= $hp['TenHP'] ?></td>
        <td><?= $hp['SoTinChi'] ?></td>
        <td>
            <a href="remove-from-cart.php?mahp=<?= $hp['MaHP'] ?>">❌ Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
