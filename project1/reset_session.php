<?php
// Khởi động session
session_start();

// Xóa toàn bộ session
session_destroy();

// Thông báo
echo "Session đã được xóa. Sản phẩm mẫu sẽ được tạo lại.";
echo "<br><br>";
echo "<a href='/project1/Product/list'>Quay lại trang danh sách sản phẩm</a>";
?> 