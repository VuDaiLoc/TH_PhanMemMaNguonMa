<?php
include 'db.php';
session_start();

// Lấy danh sách học phần
$hocphans = $pdo->query("SELECT * FROM HocPhan")->fetchAll();
?>

<h2>Danh sách học phần</h2>
<a href="cart.php">🧺 Xem học phần đã chọn</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Mã HP</th><th>Tên học phần</th><th>Tín chỉ</th><th>Thao tác</th>
    </tr>
    <?php foreach ($hocphans as $hp): ?>
    <tr>
        <td><?= $hp['MaHP'] ?></td>
        <td><?= $hp['TenHP'] ?></td>
        <td><?= $hp['SoTinChi'] ?></td>
        <td>
            <a href="add-to-cart.php?mahp=<?= $hp['MaHP'] ?>">➕ Đăng ký</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>