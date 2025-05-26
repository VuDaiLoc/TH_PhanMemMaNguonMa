<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-5 fw-bold text-primary">
                    <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn
                </h1>
                <a href="/webbanhang/Product" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i> Tiếp tục mua sắm
                </a>
            </div>

            <?php if (!empty($cart)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 120px">Ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach ($cart as $id => $item): 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <?php if ($item['image']): ?>
                                        <img src="/webbanhang/<?php echo $item['image']; ?>" 
                                             alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                             class="img-thumbnail" style="max-height: 80px;">
                                        <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width:80px; height:80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <h5 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h5>
                                        <small class="text-muted">ID: <?php echo $id; ?></small>
                                    </td>
                                    <td class="text-end">
                                        <?php echo number_format($item['price'], 0, ',', '.'); ?> ₫
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="/webbanhang/Product/updateCart/<?php echo $id; ?>" class="d-flex justify-content-center">
                                            <div class="input-group" style="max-width: 120px;">
                                                <input type="number" name="quantity" 
                                                       value="<?php echo $item['quantity']; ?>" 
                                                       min="1" class="form-control form-control-sm">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold">
                                        <?php echo number_format($subtotal, 0, ',', '.'); ?> ₫
                                    </td>
                                    <td class="text-center">
                                        <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Tổng cộng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span><?php echo number_format($total, 0, ',', '.'); ?> ₫</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span>0 ₫</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Tổng tiền:</span>
                                <span class="text-danger"><?php echo number_format($total, 0, ',', '.'); ?> ₫</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-end">
                            <a href="/webbanhang/Product/checkout" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i> Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card shadow-sm text-center py-5">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted mb-3">Giỏ hàng của bạn đang trống</h3>
                    <a href="/webbanhang/Product" class="btn btn-primary px-4">
                        <i class="fas fa-store me-2"></i> Mua sắm ngay
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>