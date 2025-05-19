<?php
require_once 'app/models/ProductModel.php';
require_once 'app/helpers/ImageGenerator.php';

class ProductController
{
    private $products = [];
    
    public function __construct()
    {
        // Giả sử chúng ta lưu trữ sản phẩm trong session để giữ lại khi làm mới trang
        session_start();
        if (isset($_SESSION['products'])) {
            $this->products = $_SESSION['products'];
        } else {
            // Thêm các sản phẩm mẫu nếu không có sản phẩm nào
            $this->addSampleProducts();
        }
    }
    
    /**
     * Thêm các sản phẩm mẫu vào danh sách
     */
    private function addSampleProducts()
    {
        // Debug: Xác nhận phương thức được gọi
        error_log("addSampleProducts method is called!");
        
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
        
        // Sản phẩm 4: Đồng hồ Apple Watch Series 9
        $product4 = new ProductModel(
            4,
            'Apple Watch Series 9 GPS',
            'Đồng hồ thông minh với chip S9 mới, màn hình Always-On Retina, tính năng theo dõi sức khỏe toàn diện và hệ điều hành watchOS mới nhất.',
            10990000,
            'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/a/p/apple-watch-series-9-gps-41mm.png'
        );
        
        // Sản phẩm 5: Máy ảnh Sony Alpha A7 IV
        $product5 = new ProductModel(
            5,
            'Máy ảnh Sony Alpha A7 IV',
            'Máy ảnh mirrorless full-frame 33MP, quay video 4K 60fps, hệ thống lấy nét tự động thông minh và khả năng chụp liên tiếp 10fps.',
            59990000,
            'https://product.hstatic.net/1000304920/product/sony-a7-iv-body_e0d2c6b9e2e34ed9b3447a2c6b9a8c2e.jpg'
        );
        
        // Thêm các sản phẩm vào mảng
        $this->products = [$product1, $product2, $product3, $product4, $product5];
        
        // Lưu vào session
        $_SESSION['products'] = $this->products;
    }
    
    public function index()
    {
        $this->list();
    }
    
    public function list()
    {
        // Hiển thị danh sách sản phẩm
        $products = $this->products;
        include 'app/views/product/list.php';
    }
    
    /**
     * Xóa tất cả sản phẩm và tạo lại sản phẩm mẫu
     */
    public function resetProducts()
    {
        // Xóa tất cả sản phẩm
        $this->products = [];
        $_SESSION['products'] = [];
        
        // Tạo lại sản phẩm mẫu
        $this->addSampleProducts();
        
        // Chuyển hướng về trang danh sách
        header('Location: /project1/Product/list');
        exit();
    }
    
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image = ''; // Mặc định để trống
            
            // Kiểm tra tên sản phẩm
            if (empty($name)) {
                $errors[] = 'Tên sản phẩm là bắt buộc.';
            } elseif (strlen($name) < 10 || strlen($name) > 100) {
                $errors[] = 'Tên sản phẩm phải có từ 10 đến 100 ký tự.';
            }
            
            // Kiểm tra giá
            if (!is_numeric($price) || $price <= 0) {
                $errors[] = 'Giá phải là một số dương lớn hơn 0.';
            }
            
            // Xử lý hình ảnh
            $imageOption = $_POST['image_option'] ?? 'ai';
            if ($imageOption === 'url' && !empty($_POST['image_url'])) {
                // Sử dụng URL hình ảnh được cung cấp
                $image = $_POST['image_url'];
            } elseif ($imageOption === 'ai') {
                // Tạo hình ảnh bằng AI
                try {
                    $image = ImageGenerator::generateProductImage($name, $description);
                } catch (Exception $e) {
                    $errors[] = 'Không thể tạo hình ảnh: ' . $e->getMessage();
                }
            }
            
            if (empty($errors)) {
                $id = count($this->products) + 1;
                $product = new ProductModel($id, $name, $description, $price, $image);
                $this->products[] = $product;
                $_SESSION['products'] = $this->products;
                header('Location: /project1/Product/list');
                exit();
            }
        }
        include 'app/views/product/add.php';
    }
    
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($this->products as $key => $product) {
                if ($product->getID() == $id) {
                    $this->products[$key]->setName($_POST['name']);
                    $this->products[$key]->setDescription($_POST['description']);
                    $this->products[$key]->setPrice($_POST['price']);
                    
                    // Xử lý hình ảnh
                    $imageOption = $_POST['image_option'] ?? 'keep';
                    if ($imageOption === 'url' && !empty($_POST['image_url'])) {
                        // Sử dụng URL hình ảnh được cung cấp
                        $this->products[$key]->setImage($_POST['image_url']);
                    } elseif ($imageOption === 'ai') {
                        // Tạo hình ảnh mới bằng AI
                        try {
                            $image = ImageGenerator::generateProductImage(
                                $_POST['name'], 
                                $_POST['description']
                            );
                            $this->products[$key]->setImage($image);
                        } catch (Exception $e) {
                            // Xử lý lỗi - có thể giữ nguyên hình ảnh cũ nếu có lỗi
                        }
                    }
                    // Nếu imageOption là 'keep', giữ nguyên hình ảnh hiện tại
                    
                    break;
                }
            }
            $_SESSION['products'] = $this->products;
            header('Location: /project1/Product/list');
            exit();
        }
        
        foreach ($this->products as $product) {
            if ($product->getID() == $id) {
                include 'app/views/product/edit.php';
                return;
            }
        }
        die('Product not found');
    }
    
    public function delete($id)
    {
        foreach ($this->products as $key => $product) {
            if ($product->getID() == $id) {
                // Xóa hình ảnh nếu là hình ảnh do AI tạo và lưu trên máy chủ
                $imagePath = $product->getImage();
                if ($imagePath && strpos($imagePath, '/project1/public/images/products/') === 0) {
                    $serverPath = str_replace('/project1/', '', $imagePath);
                    if (file_exists($serverPath)) {
                        unlink($serverPath);
                        // Xóa cả file text chứa prompt nếu có
                        $textFile = str_replace('.jpg', '.txt', $serverPath);
                        if (file_exists($textFile)) {
                            unlink($textFile);
                        }
                    }
                }
                
                unset($this->products[$key]);
                break;
            }
        }
        $this->products = array_values($this->products);
        $_SESSION['products'] = $this->products;
        header('Location: /project1/Product/list');
        exit();
    }
    
    /**
     * Xóa tất cả sản phẩm
     */
    public function deleteAll()
    {
        // Xóa tất cả hình ảnh do AI tạo
        foreach ($this->products as $product) {
            $imagePath = $product->getImage();
            if ($imagePath && strpos($imagePath, '/project1/public/images/products/') === 0) {
                $serverPath = str_replace('/project1/', '', $imagePath);
                if (file_exists($serverPath)) {
                    unlink($serverPath);
                    // Xóa cả file text chứa prompt nếu có
                    $textFile = str_replace('.jpg', '.txt', $serverPath);
                    if (file_exists($textFile)) {
                        unlink($textFile);
                    }
                }
            }
        }
        
        // Xóa tất cả sản phẩm
        $this->products = [];
        $_SESSION['products'] = [];
        
        // Chuyển hướng về trang danh sách
        header('Location: /project1/Product/list');
        exit();
    }
} 