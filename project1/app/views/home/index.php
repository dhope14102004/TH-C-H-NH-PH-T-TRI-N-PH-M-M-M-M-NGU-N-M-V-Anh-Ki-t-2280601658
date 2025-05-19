<?php 
$pageTitle = 'Shop Digital - Trang chủ';
ob_start(); 
?>

<div class="banner-section">
    <div class="banner-content">
        <h1 class="banner-title">Shop<span>Digital</span></h1>
        <p class="banner-subtitle">Khám phá các sản phẩm số chất lượng cao với thiết kế hiện đại và tiện ích đa dạng.</p>
        <a href="/project1/Product/list" class="btn btn-primary">Khám phá ngay <i class="fas fa-arrow-right"></i></a>
    </div>
</div>

<section class="featured-products">
    <div class="section-header">
        <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
        <p class="section-subtitle">Những sản phẩm được ưa chuộng nhất của chúng tôi</p>
    </div>
    
    <div class="product-grid">
        <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="product-card">
            <div class="product-badge">Hot</div>
            <div class="product-image">
                <img src="https://placehold.co/600x400/6c2e9b/ffffff?text=Sản+phẩm+<?php echo $i; ?>" alt="Sản phẩm <?php echo $i; ?>">
                <div class="product-actions">
                    <a href="/project1/Product/edit/<?php echo $i; ?>" class="action-btn edit-btn" title="Sửa sản phẩm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="/project1/Product/delete/<?php echo $i; ?>" class="action-btn delete-btn" title="Xóa sản phẩm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Sản phẩm mẫu <?php echo $i; ?></h3>
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>(4.5)</span>
                </div>
                <p class="product-description">Mô tả sản phẩm mẫu, đây là một sản phẩm tuyệt vời với nhiều tính năng và ưu điểm.</p>
                <div class="product-price"><?php echo number_format(rand(100000, 500000)); ?> VNĐ</div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    
    <div class="view-all-container">
        <a href="/project1/Product/list" class="btn btn-outline">Xem Tất Cả Sản Phẩm <i class="fas fa-angle-right"></i></a>
    </div>
</section>

<section class="features-section">
    <div class="section-header">
        <h2 class="section-title">Tính Năng Nổi Bật</h2>
        <p class="section-subtitle">Quản lý sản phẩm dễ dàng và hiệu quả</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="feature-content">
                <h3 class="feature-title">Thêm Sản Phẩm</h3>
                <p class="feature-description">Dễ dàng thêm sản phẩm mới vào hệ thống với các thông tin chi tiết.</p>
                <a href="/project1/Product/add" class="feature-link">Thêm ngay <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="feature-content">
                <h3 class="feature-title">Chỉnh Sửa Sản Phẩm</h3>
                <p class="feature-description">Cập nhật thông tin sản phẩm một cách nhanh chóng và thuận tiện.</p>
                <a href="/project1/Product/list" class="feature-link">Quản lý <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="feature-content">
                <h3 class="feature-title">Theo Dõi Sản Phẩm</h3>
                <p class="feature-description">Xem thống kê và theo dõi hiệu suất của từng sản phẩm.</p>
                <a href="/project1/Product/stats" class="feature-link">Xem thống kê <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php 
$content = ob_get_clean();
include 'app/views/layouts/main.php';
?> 