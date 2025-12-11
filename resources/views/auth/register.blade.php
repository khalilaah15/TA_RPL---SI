<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Pedasan Kunchung</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Base Styles */
        :root {
            --primary-red: #dc2626;
            --primary-red-light: #fef2f2;
            --primary-red-dark: #991b1b;
            --secondary-red: #ef4444;
            --accent-orange: #f97316;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border-color: #fca5a5;
            --shadow-red: rgba(220, 38, 38, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Figtree', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background Pattern */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 20%);
            z-index: -1;
        }
        
        /* Main Container */
        .main-container {
            width: 100%;
            max-width: 480px;
            margin: 40px 0;
        }
        
        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: var(--primary-red-dark);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .logo-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        
        .logo-section h1 {
            font-size: 32px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }
        
        .logo-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
        }
        
        /* Register Card */
        .register-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-label i {
            color: var(--primary-red);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #fecaca;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: var(--primary-red-light);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            background: white;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-red);
            font-size: 16px;
        }
        
        /* Textarea khusus untuk alamat */
        .form-textarea {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #fecaca;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: var(--primary-red-light);
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            background: white;
        }
        
        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: var(--primary-red);
        }
        
        /* Buttons */
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 30px;
        }
        
        .register-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-red), var(--secondary-red));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.25);
        }
        
        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.35);
        }
        
        .register-button:active {
            transform: translateY(0);
        }
        
        .login-button {
            width: 100%;
            padding: 16px;
            background: white;
            color: var(--primary-red);
            border: 2px solid #fecaca;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-button:hover {
            background: var(--primary-red-light);
            border-color: var(--primary-red);
        }
        
        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
        }
        
        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #fecaca, transparent);
        }
        
        .divider-text {
            padding: 0 16px;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 500;
        }
        
        /* Error Messages */
        .error-message {
            background: #fee2e2;
            color: var(--primary-red-dark);
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        /* Session Status */
        .session-status {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Info Box */
        .info-box {
            background: #f0f9ff;
            border-left: 4px solid var(--primary-red);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            color: var(--text-dark);
        }
        
        .info-box strong {
            color: var(--primary-red);
        }
        
        /* Footer */
        .register-footer {
            text-align: center;
            margin-top: 30px;
            color: var(--text-light);
            font-size: 14px;
        }
        
        .register-footer a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .main-container {
                max-width: 100%;
                margin: 20px 0;
            }
            
            .register-card {
                padding: 30px 20px;
            }
        }
        
        /* Animations for form inputs */
        .animate-fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Stagger animation for form groups */
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
        .form-group:nth-child(7) { animation-delay: 0.7s; }
    </style>
</head>
<body>
    <!-- Background Pattern -->
    <div class="bg-pattern"></div>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-wrapper">
                <img src="{{ asset('logo.png') }}" alt="Pedasan Kunchung" class="logo-img">
            </div>
            <h1>Pedasan Kunchung</h1>
            <p>Daftar Akun Reseller Baru</p>
        </div>
        
        <!-- Register Card -->
        <div class="register-card">
            <!-- Info Box -->
            <div class="info-box">
                <strong>Informasi Penting:</strong> Pastikan data yang Anda masukkan valid untuk proses verifikasi.
            </div>
            
            <!-- Session Status -->
            @if(session('status'))
                <div class="session-status">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Validation Errors -->
            @if($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="name">
                        <i class="fas fa-user"></i>
                        Nama Pemilik / Penanggung Jawab
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-tie input-icon"></i>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               placeholder="Masukkan nama lengkap">
                    </div>
                </div>
                
                <!-- Phone Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="phone">
                        <i class="fas fa-phone"></i>
                        No. WhatsApp Aktif
                    </label>
                    <div class="input-wrapper">
                        <i class="fab fa-whatsapp input-icon" style="color: #25D366;"></i>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="form-input" 
                               value="{{ old('phone') }}" 
                               required 
                               placeholder="Contoh: 081234567890">
                    </div>
                </div>
                
                <!-- Domicile Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="domicile">
                        <i class="fas fa-map-marker-alt"></i>
                        Domisili (Kota/Kabupaten)
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-city input-icon"></i>
                        <input type="text" 
                               id="domicile" 
                               name="domicile" 
                               class="form-input" 
                               value="{{ old('domicile') }}" 
                               required 
                               placeholder="Contoh: Kota Bandung">
                    </div>
                </div>
                
                <!-- Address Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="address">
                        <i class="fas fa-home"></i>
                        Alamat Lengkap Pengiriman
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-map-pin input-icon"></i>
                        <textarea id="address" 
                                  name="address" 
                                  class="form-textarea" 
                                  required 
                                  placeholder="Masukkan alamat lengkap untuk pengiriman">{{ old('address') }}</textarea>
                    </div>
                </div>
                
                <!-- Email Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-at input-icon"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-input" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="masukan@email.com">
                    </div>
                </div>
                
                <!-- Password Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-key input-icon"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Confirm Password Input -->
                <div class="form-group animate-fadeIn">
                    <label class="form-label" for="password_confirmation">
                        <i class="fas fa-lock"></i>
                        Konfirmasi Password
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-key input-icon"></i>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               required 
                               placeholder="Ulangi password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Divider -->
                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">SUDAH MEMILIKI AKUN?</div>
                    <div class="divider-line"></div>
                </div>
                
                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="register-button">
                        <i class="fas fa-user-plus"></i>
                        Daftar Sekarang
                    </button>
                    
                    <a href="{{ route('login') }}" class="login-button">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Akun
                    </a>
                </div>
            </form>
            
            <!-- Footer -->
            <div class="register-footer">
                <p>@pedasan.kunchung</p>
            </div>
        </div>
    </div>
    
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleButton = passwordInput.nextElementSibling.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            }
        }
        
        // Format phone number
        document.getElementById('phone')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.replace(/^0+/, '');
                if (!value.startsWith('62')) {
                    value = '62' + value;
                }
            }
            e.target.value = value;
        });
        
        // Add animation to form inputs
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.animationDelay = `${index * 0.1}s`;
                group.classList.add('animate-fadeIn');
            });
        });
        
        // Auto-capitalize for name and domicile
        document.getElementById('name')?.addEventListener('blur', function() {
            this.value = this.value.toUpperCase();
        });
        
        document.getElementById('domicile')?.addEventListener('blur', function() {
            this.value = this.value.toUpperCase();
        });
        
    </script>
</body>
</html>