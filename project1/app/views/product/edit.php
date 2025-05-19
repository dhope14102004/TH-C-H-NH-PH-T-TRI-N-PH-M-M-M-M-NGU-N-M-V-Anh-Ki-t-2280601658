<?php 
$pageTitle = 'Chỉnh sửa sản phẩm';
ob_start(); 
?>

<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">Chỉnh Sửa Sản Phẩm</h1>
        
        <form method="POST" action="/project1/Product/edit/<?php echo $product->getID(); ?>" class="product-form">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" class="form-control" required>
                <small>Tên sản phẩm phải có từ 10 đến 100 ký tự.</small>
            </div>
            
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>" class="form-control" step="0.01" required>
                <small>Giá phải là một số dương lớn hơn 0.</small>
            </div>

            <div class="form-group">
                <label>Hình ảnh sản phẩm:</label>
                
                <?php if ($product->getImage()): ?>
                <div class="current-image">
                    <p>Hình ảnh hiện tại:</p>
                    <img src="<?php echo htmlspecialchars($product->getImage(), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" style="max-width: 200px; max-height: 200px; margin: 10px 0;">
                </div>
                <?php endif; ?>
                
                <div class="image-options">
                    <div class="image-option">
                        <input type="radio" id="image_keep" name="image_option" value="keep" <?php echo !$product->getImage() ? 'style="display:none;"' : 'checked'; ?>>
                        <label for="image_keep" <?php echo !$product->getImage() ? 'style="display:none;"' : ''; ?>>Giữ hình ảnh hiện tại</label>
                    </div>
                    
                    <div class="image-option">
                        <input type="radio" id="image_ai" name="image_option" value="ai" <?php echo !$product->getImage() ? 'checked' : ''; ?>>
                        <label for="image_ai">Tạo hình ảnh mới bằng AI</label>
                        <p class="image-option-desc">Hệ thống sẽ tự động tạo hình ảnh dựa trên tên và mô tả sản phẩm của bạn.</p>
                    </div>
                    
                    <div class="image-option">
                        <input type="radio" id="image_url" name="image_option" value="url">
                        <label for="image_url">Sử dụng URL hình ảnh có sẵn</label>
                        <input type="text" id="image_url_input" name="image_url" class="form-control" placeholder="Nhập URL hình ảnh" disabled>
                    </div>
                </div>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                <a href="/project1/Product/list">Quay lại danh sách sản phẩm</a>
            </div>
        </form>
    </div>
</section>

<script>
// Bật/tắt trường nhập URL hình ảnh tùy thuộc vào tùy chọn người dùng
document.querySelectorAll('input[name="image_option"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        let urlInput = document.getElementById('image_url_input');
        if (this.value === 'url') {
            urlInput.disabled = false;
            urlInput.required = true;
        } else {
            urlInput.disabled = true;
            urlInput.required = false;
            urlInput.value = '';
        }
    });
});
</script>

<style>
.image-options {
    margin-top: 10px;
}
.image-option {
    margin-bottom: 15px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}
.image-option label {
    font-weight: 500;
    margin-left: 5px;
}
.image-option-desc {
    margin-left: 25px;
    font-size: 0.9em;
    color: rgba(255, 255, 255, 0.7);
    margin-top: 5px;
}
#image_url_input {
    margin-top: 10px;
    margin-left: 25px;
}
.current-image {
    margin-bottom: 15px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 10px;
    border-radius: 8px;
    background: rgba(0, 0, 0, 0.2);
}
</style>

<?php 
$content = ob_get_clean();
include 'app/views/layouts/main.php';
?> 