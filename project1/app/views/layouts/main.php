<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Shop Sản Phẩm'; ?></title>
    <link rel="stylesheet" href="/project1/public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <a href="/project1" class="logo">Shop<span>Digital</span></a>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="/project1"><i class="fas fa-home"></i> Trang chủ</a></li>
                        <li><a href="/project1/Product/list"><i class="fas fa-store"></i> Sản phẩm</a></li>
                        <li><a href="/project1/Product/add" class="add-product-btn"><i class="fas fa-plus-circle"></i> Thêm sản phẩm</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container">
        <main>
            <?php echo $content ?? ''; ?>
        </main>

        <footer class="site-footer">
            <div class="footer-content">
                <div class="footer-copyright">
                    &copy; <?php echo date('Y'); ?> Shop Digital. Tất cả quyền được bảo lưu.
                </div>
                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <script src="/project1/public/js/main.js"></script>
</body>
</html> 