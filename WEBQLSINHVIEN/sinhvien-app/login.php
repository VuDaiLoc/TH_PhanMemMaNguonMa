<?php
session_start();
include 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSV = $_POST['MaSV'];
    $password = $_POST['Password'];

    $stmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ? AND Password = ?");
    $stmt->execute([$maSV, $password]);
    $sv = $stmt->fetch();

    if ($sv) {
        $_SESSION['MaSV'] = $sv['MaSV'];
        $_SESSION['HoTen'] = $sv['HoTen'];
        header('Location: sinhvien-app/index.php');
        exit;
    } else {
        $error = "Sai mã sinh viên hoặc mật khẩu!";
    }
}
?>

<h2>Đăng nhập</h2>
<?php if ($error): ?>
<p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    Mã Sinh Viên: <input name="MaSV" required><br>
    Mật khẩu: <input name="Password" type="password" required><br>
    <button type="submit">Đăng nhập</button>
</form>