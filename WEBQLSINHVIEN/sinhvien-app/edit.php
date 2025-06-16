<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->execute([$id]);
$sv = $stmt->fetch();

if (!$sv) {
    header('Location: index.php');
    exit;
}

$nganhs = $pdo->query("SELECT * FROM NganhHoc")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $uploadDir = 'uploads/';
    $imagePath = $sv['Hinh']; // Keep old image by default
    
    if (isset($_FILES['HinhFile']) && $_FILES['HinhFile']['error'] === UPLOAD_ERR_OK) {
        // Delete old image if it exists
        if ($sv['Hinh'] && file_exists($sv['Hinh'])) {
            unlink($sv['Hinh']);
        }
        
        // Generate unique filename
        $fileExt = pathinfo($_FILES['HinhFile']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $fileExt;
        $uploadPath = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($_FILES['HinhFile']['tmp_name'], $uploadPath)) {
            $imagePath = $uploadPath;
        }
    }

    $stmt = $pdo->prepare("UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?");
    $stmt->execute([
        $_POST['HoTen'], 
        $_POST['GioiTinh'], 
        $_POST['NgaySinh'], 
        $imagePath,
        $_POST['MaNganh'], 
        $id
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin sinh viên</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="file"]:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
            border: none;
            margin-right: 10px;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        .form-actions {
            margin-top: 30px;
            text-align: right;
        }
        .student-photo {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: block;
            object-fit: cover;
        }
        .photo-container {
            margin: 15px 0;
            text-align: center;
        }
        .readonly-field {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        .file-input-button {
            background: #3498db;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }
        .file-input-button:hover {
            background: #2980b9;
        }
        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .file-name {
            margin-left: 10px;
            font-style: italic;
        }
        .image-options {
            margin-top: 10px;
        }
        .remove-image {
            color: #e74c3c;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cập nhật thông tin sinh viên</h2>
        
        <form method="post" id="editForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="MaSV">Mã sinh viên:</label>
                <div class="readonly-field"><?= htmlspecialchars($sv['MaSV']) ?></div>
                <input type="hidden" name="MaSV" value="<?= htmlspecialchars($sv['MaSV']) ?>">
            </div>
            
            <div class="form-group">
                <label for="HoTen">Họ và tên:</label>
                <input type="text" id="HoTen" name="HoTen" value="<?= htmlspecialchars($sv['HoTen']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="GioiTinh">Giới tính:</label>
                <select id="GioiTinh" name="GioiTinh" required>
                    <option value="Nam" <?= $sv['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $sv['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="NgaySinh">Ngày sinh:</label>
                <input type="date" id="NgaySinh" name="NgaySinh" value="<?= htmlspecialchars($sv['NgaySinh']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Hình ảnh:</label>
                
                <?php if ($sv['Hinh']): ?>
                    <div class="photo-container">
                        <img src="<?= htmlspecialchars($sv['Hinh']) ?>" class="student-photo" id="imagePreview">
                        <div class="image-options">
                            <label class="file-input-wrapper">
                                <span class="file-input-button">Chọn ảnh khác</span>
                                <input type="file" id="HinhFile" name="HinhFile" class="file-input" accept="image/*">
                            </label>
                            <span id="fileName" class="file-name"></span>
                        </div>
                    </div>
                    <input type="hidden" id="Hinh" name="Hinh" value="<?= htmlspecialchars($sv['Hinh']) ?>">
                <?php else: ?>
                    <div class="file-input-wrapper">
                        <span class="file-input-button">Chọn ảnh</span>
                        <input type="file" id="HinhFile" name="HinhFile" class="file-input" accept="image/*">
                        <span id="fileName" class="file-name"></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="MaNganh">Ngành học:</label>
                <select id="MaNganh" name="MaNganh" required>
                    <?php foreach ($nganhs as $ng): ?>
                        <option value="<?= htmlspecialchars($ng['MaNganh']) ?>" <?= $sv['MaNganh'] == $ng['MaNganh'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ng['TenNganh']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-actions">
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </form>
    </div>

    <script>
        // Image preview and file name display
        document.getElementById('HinhFile').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const fileName = document.getElementById('fileName');
            
            if (this.files && this.files[0]) {
                // Display file name
                fileName.textContent = this.files[0].name;
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (!preview) {
                        // Create preview element if it doesn't exist
                        const container = document.createElement('div');
                        container.className = 'photo-container';
                        const img = document.createElement('img');
                        img.id = 'imagePreview';
                        img.className = 'student-photo';
                        container.appendChild(img);
                        document.querySelector('.form-group label[for="HinhFile"]').after(container);
                        preview = img;
                    }
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Set default date to today if empty
        if (!document.getElementById('NgaySinh').value) {
            document.getElementById('NgaySinh').valueAsDate = new Date();
        }
    </script>
</body>
</html>