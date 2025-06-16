<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh WHERE sv.MaSV = ?");
$stmt->execute([$id]);
$sv = $stmt->fetch();

if (!$sv) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sinh viên - <?= htmlspecialchars($sv['HoTen']) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        .student-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-label {
            font-weight: bold;
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
        }
        .detail-value {
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border-left: 4px solid #3498db;
        }
        .student-photo {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
            margin: 0 auto;
            display: block;
        }
        .photo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-link:hover {
            background-color: #2980b9;
        }
        .action-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .action-btn {
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .edit-btn {
            background-color: #f39c12;
            color: white;
        }
        .edit-btn:hover {
            background-color: #e67e22;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        @media (max-width: 600px) {
            .student-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chi tiết sinh viên</h2>
        
        <div class="photo-container">
        <img src="uploads/<?= htmlspecialchars($sv['Hinh']) ?>" alt="Ảnh sinh viên <?= htmlspecialchars($sv['HoTen']) ?>" class="student-photo" width="300">
        </div>
        
        <div class="student-details">
            <div class="detail-item">
                <span class="detail-label">Mã sinh viên:</span>
                <div class="detail-value"><?= htmlspecialchars($sv['MaSV']) ?></div>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Họ và tên:</span>
                <div class="detail-value"><?= htmlspecialchars($sv['HoTen']) ?></div>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Giới tính:</span>
                <div class="detail-value"><?= htmlspecialchars($sv['GioiTinh']) ?></div>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Ngày sinh:</span>
                <div class="detail-value"><?= htmlspecialchars($sv['NgaySinh']) ?></div>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Ngành học:</span>
                <div class="detail-value"><?= htmlspecialchars($sv['TenNganh']) ?></div>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="edit.php?id=<?= $sv['MaSV'] ?>" class="action-btn edit-btn">✏️ Chỉnh sửa</a>
            <a href="delete.php?id=<?= $sv['MaSV'] ?>" class="action-btn delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">🗑 Xóa</a>
            <a href="index.php" class="back-link">⬅ Quay lại danh sách</a>
        </div>
    </div>
</body>
</html>