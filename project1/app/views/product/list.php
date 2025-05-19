<?php 
$pageTitle = 'Danh sách sản phẩm';
ob_start(); 
?>

<section class="products">
    <h1 class="section-title">Danh Sách Sản Phẩm</h1>
    
    <div class="text-center" style="margin-bottom: 30px;">
        <a href="/project1/Product/add" class="btn btn-primary">Thêm Sản Phẩm Mới</a>
        
        <?php if (!empty($products)): ?>
            <a href="/project1/Product/deleteAll" class="btn btn-danger" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa TẤT CẢ sản phẩm?');">
                <i class="fas fa-trash-alt"></i> Xóa Tất Cả
            </a>
        <?php endif; ?>
        
        <a href="/project1/Product/resetProducts" class="btn btn-success">
            <i class="fas fa-sync"></i> Tạo Lại Sản Phẩm Mẫu
        </a>
    </div>
    
    <?php if (empty($products)): ?>
        <div class="empty-products" style="text-align: center; padding: 50px 0;">
            <i class="fas fa-box-open" style="font-size: 48px; color: rgba(255, 255, 255, 0.3); margin-bottom: 20px;"></i>
            <p>Không có sản phẩm nào. Hãy thêm sản phẩm mới!</p>
        </div>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product->getImage()): ?>
                            <img src="<?php echo htmlspecialchars($product->getImage(), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>">
                            <?php if (strpos($product->getImage(), '/project1/public/images/products/') === 0): ?>
                                <div class="ai-badge">AI</div>
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="https://via.placeholder.com/300x200/333/fff?text=<?php echo urlencode($product->getName()); ?>" alt="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="product-price"><?php echo number_format($product->getPrice()); ?> VNĐ</div>
                        <div class="product-actions">
                            <a href="/project1/Product/edit/<?php echo $product->getID(); ?>" class="btn-edit">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="/project1/Product/delete/<?php echo $product->getID(); ?>" class="btn-delete" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<style>
.product-image {
    position: relative;
}
.ai-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: linear-gradient(135deg, #a742f0, #f04fd3);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
.btn-danger {
    background-color: #dc3545;
    margin-left: 10px;
}
.btn-success {
    background-color: #28a745;
    margin-left: 10px;
}
</style>

<?php 
$content = ob_get_clean();
include 'app/views/layouts/main.php';
?> 