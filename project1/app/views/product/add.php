<?php 
$pageTitle = 'Thêm sản phẩm mới';
ob_start(); 
?>

<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">Thêm Sản Phẩm Mới</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <ul class="error-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/project1/Product/add" class="product-form" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <small>Tên sản phẩm phải có từ 10 đến 100 ký tự.</small>
            </div>
            
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control" required>
                <small>Giá phải là một số dương lớn hơn 0.</small>
            </div>
            
            <div class="form-group">
                <label>Hình ảnh sản phẩm:</label>
                <div class="image-options">
                    <div class="image-option">
                        <input type="radio" id="image_ai" name="image_option" value="ai" checked>
                        <label for="image_ai">Tạo hình ảnh bằng AI</label>
                        <p class="image-option-desc">Hệ thống sẽ tự động tạo hình ảnh dựa trên tên và mô tả sản phẩm của bạn.</p>
                    </div>
                    
                    <div class="image-option">
                        <input type="radio" id="image_url" name="image_option" value="url">
                        <label for="image_url">Sử dụng URL hình ảnh có sẵn</label>
                        <input type="text" id="image_url_input" name="image_url" class="form-control" placeholder="Nhập URL hình ảnh" disabled>
                    </div>
                </div>
                <small>Nếu bạn không chọn hình ảnh, hệ thống sẽ tự động tạo hình ảnh bằng AI.</small>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                <a href="/project1/Product/list">Quay lại danh sách sản phẩm</a>
            </div>
        </form>
    </div>
</section>

<script>
function validateForm() {
    let name = document.getElementById('name').value;
    let price = document.getElementById('price').value;
    let errors = [];
    
    if (name.length < 10 || name.length > 100) {
        errors.push('Tên sản phẩm phải có từ 10 đến 100 ký tự.');
    }
    
    if (price <= 0 || isNaN(price)) {
        errors.push('Giá phải là một số dương lớn hơn 0.');
    }
    
    // Kiểm tra URL hình ảnh nếu người dùng chọn tùy chọn URL
    let imageOption = document.querySelector('input[name="image_option"]:checked').value;
    if (imageOption === 'url') {
        let imageUrl = document.getElementById('image_url_input').value;
        if (!imageUrl || imageUrl.trim() === '') {
            errors.push('Vui lòng nhập URL hình ảnh hoặc chọn tùy chọn tạo hình ảnh bằng AI.');
        }
    }
    
    if (errors.length > 0) {
        alert(errors.join('\n'));
        return false;
    }
    return true;
}

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
</style>

<?php 
$content = ob_get_clean();
include 'app/views/layouts/main.php';
?> 