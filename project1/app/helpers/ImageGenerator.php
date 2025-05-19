<?php
/**
 * Helper class để tạo và quản lý hình ảnh sản phẩm sử dụng AI
 */
class ImageGenerator
{
    /**
     * Tạo hình ảnh sản phẩm từ mô tả sử dụng AI.
     * 
     * Lưu ý: Trong ứng dụng thực tế, bạn sẽ cần sử dụng API key thực và có thể 
     * tính phí khi sử dụng dịch vụ tạo hình ảnh AI. Đây chỉ là mã giả định.
     * 
     * @param string $productName Tên sản phẩm
     * @param string $description Mô tả sản phẩm
     * @return string Đường dẫn đến hình ảnh được tạo
     */
    public static function generateProductImage($productName, $description)
    {
        // Trong một ứng dụng thực tế, đây là nơi bạn sẽ gọi API của dịch vụ tạo hình ảnh AI
        // Ví dụ: OpenAI DALL-E, Midjourney API, Stability.ai, v.v.

        // Tạo tên file độc nhất dựa trên thời gian và ID ngẫu nhiên
        $fileName = 'product_' . time() . '_' . uniqid() . '.jpg';
        $filePath = 'public/images/products/' . $fileName;
        $webPath = '/project1/public/images/products/' . $fileName;
        
        // Trong ứng dụng này, chúng ta sẽ tạo một placeholder thay vì gọi API thực
        // Tạo prompt cho API từ tên và mô tả sản phẩm
        $prompt = "A professional product image of " . $productName . ": " . $description;
        
        // Lưu prompt vào file bên cạnh hình ảnh để tham khảo
        file_put_contents('public/images/products/' . pathinfo($fileName, PATHINFO_FILENAME) . '.txt', $prompt);
        
        // Trong ứng dụng thực tế, bạn sẽ gọi API và lưu hình ảnh trả về
        // Trong demo này, chúng ta tạo một placeholder với màu ngẫu nhiên
        self::createPlaceholderImage($filePath, $productName);
        
        return $webPath;
    }
    
    /**
     * Tạo một placeholder image với văn bản được chỉ định.
     * Chỉ dùng cho demo, trong ứng dụng thật bạn sẽ thay thế bằng hình ảnh từ API AI.
     * 
     * @param string $path Đường dẫn đến nơi lưu hình ảnh
     * @param string $text Văn bản hiển thị trên hình ảnh
     */
    private static function createPlaceholderImage($path, $text)
    {
        // Tạo hình ảnh trống
        $width = 500;
        $height = 400;
        $image = imagecreatetruecolor($width, $height);
        
        // Tạo một màu ngẫu nhiên cho nền
        $r = mt_rand(50, 200);
        $g = mt_rand(50, 200);
        $b = mt_rand(50, 200);
        $backgroundColor = imagecolorallocate($image, $r, $g, $b);
        
        // Đặt màu nền
        imagefill($image, 0, 0, $backgroundColor);
        
        // Màu văn bản
        $textColor = imagecolorallocate($image, 255, 255, 255);
        
        // Đặt văn bản ở trung tâm
        $font = 5; // Sử dụng font built-in
        $text = "AI Generated: " . $text;
        
        // Tính toán vị trí văn bản để căn giữa
        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;
        
        // Đặt văn bản lên hình ảnh
        imagestring($image, $font, $x, $y, $text, $textColor);
        
        // Thêm đường viền cho hình ảnh
        $borderColor = imagecolorallocate($image, 255, 255, 255);
        imagerectangle($image, 0, 0, $width - 1, $height - 1, $borderColor);
        
        // Lưu hình ảnh
        imagejpeg($image, $path);
        
        // Giải phóng bộ nhớ
        imagedestroy($image);
    }
} 