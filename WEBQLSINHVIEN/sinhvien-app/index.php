<?php
include 'db.php';

$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Get students with major names
$sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
        JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
        LIMIT $start, $limit";
$students = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Count total students
$total = $pdo->query("SELECT COUNT(*) FROM SinhVien")->fetchColumn();
$total_pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .add-btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .add-btn:hover {
            background: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .student-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .action-btn {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 3px;
            text-decoration: none;
            color: white;
            border-radius: 3px;
        }
        .view-btn { background: #3498db; }
        .edit-btn { background: #f39c12; }
        .delete-btn { background: #e74c3c; }
        .action-btn:hover {
            opacity: 0.8;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #3498db;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #3498db;
            color: white;
            border: 1px solid #3498db;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách sinh viên</h2>
        <a href="create.php" class="add-btn">➕ Thêm sinh viên</a>
        
        <table>
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Ngành</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $sv): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                    <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                    <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                    <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                    <td><?= htmlspecialchars($sv['TenNganh']) ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($sv['Hinh']) ?>" class="student-photo" alt="Ảnh sinh viên">
                    <td>
                        <a href="detail.php?id=<?= $sv['MaSV'] ?>" class="action-btn view-btn" title="Xem chi tiết">👁</a>
                        <a href="edit.php?id=<?= $sv['MaSV'] ?>" class="action-btn edit-btn" title="Sửa">✏️</a>
                        <a href="delete.php?id=<?= $sv['MaSV'] ?>" class="action-btn delete-btn" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">🗑</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>