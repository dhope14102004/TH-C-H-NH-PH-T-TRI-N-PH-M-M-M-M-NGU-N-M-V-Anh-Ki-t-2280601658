// Main JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Animation for hero section
    const heroTitle = document.querySelector('.hero-title');
    if (heroTitle) {
        heroTitle.classList.add('animate');
    }
    
    // Product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('hover-effect');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('hover-effect');
        });
        
        // Xử lý nút xóa sản phẩm
        const deleteBtn = card.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                const confirmed = confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');
                if (!confirmed) {
                    e.preventDefault();
                }
            });
        }
    });
    
    // Form validation
    const productForm = document.querySelector('.product-form');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            const nameInput = document.getElementById('name');
            const priceInput = document.getElementById('price');
            let errors = [];
            
            if (nameInput.value.length < 10 || nameInput.value.length > 100) {
                errors.push('Tên sản phẩm phải có từ 10 đến 100 ký tự.');
            }
            
            if (parseFloat(priceInput.value) <= 0 || isNaN(parseFloat(priceInput.value))) {
                errors.push('Giá phải là một số dương lớn hơn 0.');
            }
            
            if (errors.length > 0) {
                e.preventDefault();
                const errorContainer = document.querySelector('.error-container');
                if (errorContainer) {
                    errorContainer.innerHTML = '';
                    const errorList = document.createElement('ul');
                    errorList.className = 'error-list';
                    
                    errors.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        errorList.appendChild(li);
                    });
                    
                    errorContainer.appendChild(errorList);
                } else {
                    alert(errors.join('\n'));
                }
            }
        });
    }
    
    // Hiệu ứng mượt cho thanh điều hướng
    const navLinks = document.querySelectorAll('.nav-menu a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Chỉ áp dụng cho các link nội bộ
            if (this.getAttribute('href').indexOf('/project1') === 0) {
                // Thêm hiệu ứng khi click
                this.classList.add('nav-click');
                
                // Xóa hiệu ứng sau khi chuyển trang
                setTimeout(() => {
                    this.classList.remove('nav-click');
                }, 300);
            }
        });
    });
    
    // Nút scroll-to-top
    const createScrollTopButton = () => {
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollBtn.className = 'scroll-top-btn';
        document.body.appendChild(scrollBtn);
        
        // Hiện nút khi scroll xuống
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        });
        
        // Xử lý sự kiện click
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    };
    
    createScrollTopButton();
    
    // Thêm CSS động cho nút scroll-to-top
    const style = document.createElement('style');
    style.textContent = `
        .scroll-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(to right, #bb6bd9, #e882da);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(187, 107, 217, 0.3);
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .scroll-top-btn i {
            font-size: 20px;
        }
        
        .scroll-top-btn.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .scroll-top-btn:hover {
            background: linear-gradient(to right, #a742f0, #f04fd3);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(187, 107, 217, 0.4);
        }
        
        .hover-effect {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }
        
        .nav-click {
            transform: scale(0.95);
            opacity: 0.8;
        }
    `;
    document.head.appendChild(style);
}); 