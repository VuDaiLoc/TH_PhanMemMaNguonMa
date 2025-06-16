<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý upload ảnh
    $fileName = '';
    if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = time() . '_' . basename($_FILES['Hinh']['name']);
        $targetFile = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFile);
    }

    // Thêm sinh viên
    $stmt = $pdo->prepare("INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'],
        $_POST['NgaySinh'], $fileName, $_POST['MaNganh']
    ]);

    header('Location: index.php');
    exit;
}

$nganhs = $pdo->query("SELECT * FROM NganhHoc")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên mới</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 30px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="date"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-cancel {
            background-color: #95a5a6;
            margin-left: 10px;
        }
        .btn-cancel:hover {
            background-color: #7f8c8d;
        }
        .form-actions {
            text-align: right;
        }
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            margin-top: 10px;
            display: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Thêm sinh viên mới</h2>
    <form method="post" enctype="multipart/form-data" id="studentForm">
        <div class="form-group">
            <label for="MaSV">Mã sinh viên:</label>
            <input type="text" id="MaSV" name="MaSV" required>
        </div>

        <div class="form-group">
            <label for="HoTen">Họ và tên:</label>
            <input type="text" id="HoTen" name="HoTen" required>
        </div>

        <div class="form-group">
            <label for="GioiTinh">Giới tính:</label>
            <select id="GioiTinh" name="GioiTinh" required>
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="NgaySinh">Ngày sinh:</label>
            <input type="date" id="NgaySinh" name="NgaySinh" required>
        </div>

        <div class="form-group">
            <label for="Hinh">Chọn ảnh:</label>
            <input type="file" id="Hinh" name="Hinh" accept="image/*">
            <img id="imagePreview" class="preview-image" alt="Preview">
        </div>

        <div class="form-group">
            <label for="MaNganh">Ngành học:</label>
            <select id="MaNganh" name="MaNganh" required>
                <option value="">-- Chọn ngành học --</option>
                <?php foreach ($nganhs as $ng): ?>
                    <option value="<?= htmlspecialchars($ng['MaNganh']) ?>">
                        <?= htmlspecialchars($ng['TenNganh']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="button" class="btn btn-cancel" onclick="window.location.href='index.php'">Hủy bỏ</button>
            <button type="submit" class="btn">Lưu thông tin</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('Hinh').addEventListener('change', function (event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });

    document.getElementById('NgaySinh').valueAsDate = new Date();
</script>
</body>
</html>
