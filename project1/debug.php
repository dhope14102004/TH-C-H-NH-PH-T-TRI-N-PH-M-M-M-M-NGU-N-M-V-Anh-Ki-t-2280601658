<?php
require_once 'app/models/ProductModel.php';
require_once 'app/helpers/ImageGenerator.php';

// Xóa session hiện tại
session_start();
session_destroy();

// Khởi tạo session mới
session_start();

// Tạo các sản phẩm mẫu
$products = [];

// Sản phẩm 1: Điện thoại Samsung Galaxy S23 Ultra
$product1 = new ProductModel(
    1,
    'Samsung Galaxy S23 Ultra',
    'Điện thoại flagship mới nhất của Samsung với camera 200MP, bút S-Pen tích hợp và hiệu năng mạnh mẽ với chip Snapdragon 8 Gen 2.',
    28990000,
    'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/s/a/samsung-galaxy-s23-ultra.png'
);

// Sản phẩm 2: Laptop MacBook Pro M3
$product2 = new ProductModel(
    2,
    'MacBook Pro M3 14 inch',
    'Laptop cao cấp của Apple với chip M3 mạnh mẽ, màn hình Retina XDR 14 inch, thời lượng pin lên đến 18 giờ và hệ sinh thái Apple hoàn chỉnh.',
    45990000,
    'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/m/a/macbook-pro-m3-2023-14-inch.png'
);

// Sản phẩm 3: Tai nghe Sony WH-1000XM5
$product3 = new ProductModel(
    3,
    'Tai nghe Sony WH-1000XM5',
    'Tai nghe chống ồn cao cấp với 8 microphone, chất lượng âm thanh Hi-Res, thời lượng pin 30 giờ và khả năng chống ồn hàng đầu thị trường.',
    8490000,
    'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-sony-wh-1000xm5.png'
);

// Thêm các sản phẩm vào mảng
$products = [$product1, $product2, $product3];

// Lưu vào session
$_SESSION['products'] = $products;

echo "Đã tạo 3 sản phẩm mẫu trong session.<br>";
echo "<a href='/project1/Product/list'>Xem danh sách sản phẩm</a>";
?> 