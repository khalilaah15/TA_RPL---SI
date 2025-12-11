<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedasan Kunchung - Reseller Snack Pedas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header */
        .top-bar {
            background: #f8f8f8;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .top-bar .container {
            text-align: right;
            font-size: 14px;
            color: #666;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #c41e1e 0%, #e52424 100%);
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 500px;
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 40px;
            padding: 60px 20px;
        }

        .hero-content {
            z-index: 2;
        }

        .logo {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 150px;
            width: auto;
            filter: brightness(0) invert(1);
            padding: 5px;
            border-radius: 8px;
        }

        .badge {
            display: inline-block;
            background: rgba(255, 152, 0, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .badge::before {
            content: "🔥";
            margin-right: 6px;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .btn-primary {
            display: inline-block;
            background: white;
            color: #c41e1e;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-primary::after {
            content: " ›";
            margin-left: 4px;
        }

        .auth-link {
            position: absolute;
            top: 30px;
            right: 40px;
            background: white;
            color: #c41e1e;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        @if (Route::has('login')) @auth .auth-link {
            content: "Dashboard";
        }

        @endauth @endif .hero-image {
            position: relative;
            z-index: 2;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            overflow: hidden;
            margin-left: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Section Title */
        .section-badge {
            text-align: center;
            margin-bottom: 16px;
        }

        .section-badge span {
            display: inline-block;
            background: #fff3e0;
            color: #f57c00;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
        }

        .section-description {
            text-align: center;
            font-size: 16px;
            color: #666;
            max-width: 700px;
            margin: 0 auto 60px;
            line-height: 1.6;
        }

        /* Features Section */
        .features {
            padding: 80px 20px;
            background: #fafafa;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .feature-card {
            text-align: center;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: #ff5722;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* Products Section */
        .products {
            padding: 80px 20px;
            background: linear-gradient(135deg, #c41e1e 0%, #e52424 100%);
            color: white;
        }

        .products .section-badge span {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .products .section-title,
        .products .section-description {
            color: white;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-8px);
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 220px;
            background: #f5f5f5;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .halal-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #4caf50;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .product-info {
            padding: 20px;
        }

        .product-info h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .product-info p {
            font-size: 13px;
            color: #666;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: #c41e1e;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 80px 20px;
            background: #fafafa;
        }

        .testimonials .section-badge span {
            background: #ffe0e0;
            color: #c41e1e;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .stars {
            color: #ffa726;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .testimonial-card blockquote {
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .testimonial-role {
            font-size: 13px;
            color: #999;
        }

        /* CTA Section */
        .cta {
            padding: 80px 20px;
            background: linear-gradient(135deg, #c41e1e 0%, #e52424 100%);
            color: white;
            text-align: center;
        }

        .cta h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 40px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .btn-secondary {
            display: inline-block;
            background: white;
            color: #c41e1e;
            padding: 16px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary::after {
            content: " ›";
            margin-left: 6px;
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 40px 20px;
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo {
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            line-height: 1.3;
        }

        .footer-copyright {
            font-size: 14px;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .hero .container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-image {
                margin: 0 auto;
                width: 300px;
                height: 300px;
            }

            .auth-link {
                position: static;
                display: inline-block;
                margin-bottom: 20px;
            }

            .features-grid,
            .products-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto;
            }

            .hero h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .hero-image {
                width: 250px;
                height: 250px;
            }

            .cta h2 {
                font-size: 28px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero">
        @if (Route::has('login'))
        @auth
        <a href="{{ url('/dashboard') }}" class="auth-link">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="auth-link">Masuk / Daftar</a>
        @endauth
        @endif
        <div class="container">
            <div class="hero-content">
                <div class="logo" style="margin-bottom: 40px;">
                    <img src="{{ asset('logo.png') }}" alt="Pedasan Kunchung" class="logo-img">
                </div>
                <div class="badge" style="margin-bottom: 30px;">#1 Snack Pedas Terlaris</div>
                <h1 style="margin-bottom: 30px;">Raih Untung Maksimal dengan Pedasan Kunchung</h1>
                <p style="font-size: 20px; margin-bottom: 40px;">Gabung sebagai reseller dan dapatkan akses ke produk snack pedas pilihan, marketing kit lengkap, dan dukungan penuh untuk kesuksesan bisnis Anda.</p>
                <a href="{{ route('register') }}" style="margin-bottom: 70px;" class="btn-primary">Mulai Sekarang</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('basreng.jpeg') }}" alt="Makaroni Pedas">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="section-badge">
            <span>Tentang Kami</span>
        </div>
        <h2 class="section-title">Kenapa Pilih Pedasan Kunchung?</h2>
        <p class="section-description">Pedasan Kunchung adalah brand snack pedas premium yang telah dipercaya ribuan reseller di seluruh Indonesia. Kami menyediakan produk berkualitas dengan sistem kemitraan yang menguntungkan.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">👍</div>
                <h3>Produk Berkualitas</h3>
                <p>Snack pedas pilihan dengan bahan berkualitas dan rasa yang konsisten</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📈</div>
                <h3>Margin Menguntungkan</h3>
                <p>Dapatkan keuntungan maksimal dengan harga reseller spesial</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⭐</div>
                <h3>Support Penuh</h3>
                <p>Marketing kit lengkap dan dukungan tim untuk kesuksesan bisnis Anda</p>
            </div>
        </div>
    </section>

    <!-- Products Section - TERINTEGRASI DENGAN DATABASE -->
    <section class="products">
        <div class="section-badge">
            <span>Katalog Produk</span>
        </div>
        <h2 class="section-title">Produk Snack Pedas Pilihan</h2>
        <p class="section-description">Berbagai varian rasa pedas yang pasti disukai pelanggan Anda</p>

        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <span class="halal-badge">HALAL</span>
                </div>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description ?? 'Snack pedas berkualitas premium dengan rasa yang nikmat', 80) }}</p>
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Testimonials Section - TERINTEGRASI DENGAN DATABASE -->
    <section class="testimonials">
        <div class="section-badge">
            <span>Testimoni</span>
        </div>
        <h2 class="section-title">Apa Kata Reseller Kami</h2>
        <p class="section-description">Ribuan reseller telah sukses berbisnis bersama Pedasan Kunchung</p>

        <div class="testimonials-grid">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-card">
                <div class="stars">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                        ★
                        @endfor
                        @for($i = $testimonial->rating; $i < 5; $i++)
                            ☆
                            @endfor
                            </div>
                            <blockquote>"{{ $testimonial->content }}"</blockquote>
                            <div class="testimonial-author">{{ $testimonial->user->name ?? 'Reseller' }}</div>
                            <div class="testimonial-role">Reseller {{ $testimonial->user->domicile ?? 'Indonesia' }}</div>
                </div>
                @endforeach

            </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Siap Memulai Bisnis Pedasan Kunchung?</h2>
        <p>Daftar sekarang dan dapatkan akses penuh ke katalog produk, sistem pemesanan, dan marketing kit lengkap untuk mendukung bisnis Anda.</p>
        <a href="{{ route('register') }}" class="btn-secondary">Daftar Sebagai Reseller</a>
    </section>

    <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-logo">
            <img src="{{ asset('logo.png') }}" alt="Pedasan Kunchung" class="logo-img">
        </div>
        
        <div class="footer-contact">
            <h3>Hubungi Kami</h3>
            <div class="contact-info">
                <a href="https://wa.me/6281393133583" target="_blank" class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="contact-details">
                        <span class="contact-label">WhatsApp</span>
                        <span class="contact-value">+62 813-9313-3583</span>
                    </div>
                </a>
                
                <a href="https://instagram.com/pedasan.kunchung" target="_blank" class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="contact-details">
                        <span class="contact-label">Instagram</span>
                        <span class="contact-value">@pedasan.kunchung</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: #1a1a1a;
        color: white;
        padding: 40px 20px;
    }

    .footer .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-logo .logo-img {
        height: 100px;
        width: auto;
        filter: brightness(0) invert(1);
        padding: 8px;
        border-radius: 10px;
    }

    .footer-contact {
        text-align: right;
    }

    .footer-contact h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        color: white;
        transition: transform 0.3s;
        padding: 10px 15px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
    }

    .contact-item:hover {
        transform: translateX(-5px);
        background: rgba(255, 255, 255, 0.1);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .contact-item:nth-child(1) .contact-icon {
        background: #25D366;
    }

    .contact-item:nth-child(2) .contact-icon {
        background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
    }

    .contact-details {
        display: flex;
        flex-direction: column;
    }

    .contact-label {
        font-size: 12px;
        color: #999;
        margin-bottom: 3px;
    }

    .contact-value {
        font-size: 14px;
        font-weight: 600;
        color: white;
    }

    @media (max-width: 768px) {
        .footer .container {
            flex-direction: column;
            text-align: center;
            gap: 30px;
        }
        
        .footer-contact {
            text-align: center;
        }
        
        .contact-item {
            justify-content: center;
        }
        
        .contact-item:hover {
            transform: translateY(-3px);
        }
    }

    @media (max-width: 480px) {
        .footer {
            padding: 30px 15px;
        }
        
        .contact-item {
            padding: 8px 12px;
        }
        
        .contact-icon {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
    }
</style>


    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.feature-card, .product-card, .testimonial-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            elements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(element);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>