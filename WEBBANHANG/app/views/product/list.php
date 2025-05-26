<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-title {
            color: #2c3e50;
            font-weight: 600;
        }
        .product-title:hover {
            color: #3498db !important;
        }
        .price-tag {
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold text-primary">
                <i class="fas fa-boxes me-2"></i>Danh sách sản phẩm
            </h1>
            <a href="/webbanhang/Product/add" class="btn btn-success">
                <i class="fas fa-plus-circle me-1"></i> Thêm sản phẩm
            </a>
        </div>

        <!-- Product Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($product->image)): ?>
                    <img src="/webbanhang/<?php echo htmlspecialchars($product->image); ?>" 
                         class="card-img-top p-3" 
                         alt="<?php echo htmlspecialchars($product->name); ?>" 
                         style="object-fit: contain; height: 200px;">
                    <?php else: ?>
                    <div class="text-center py-5 bg-light">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <p class="mt-2 text-muted">Không có hình ảnh</p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title product-title">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" 
                               class="text-decoration-none">
                               <?php echo htmlspecialchars($product->name); ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted">
                            <?php echo htmlspecialchars($product->description); ?>
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info text-dark">
                                <?php echo htmlspecialchars($product->category_name); ?>
                            </span>
                            <span class="price-tag text-danger">
                                <?php echo number_format($product->price, 0, ',', '.'); ?> ₫
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <div class="d-flex justify-content-between">
                            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" 
                               class="btn btn-sm btn-outline-warning">
                               <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                               <i class="fas fa-trash-alt"></i>
                            </a>
                            
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                               class="btn btn-sm btn-primary">
                               <i class="fas fa-cart-plus me-1"></i> Thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>