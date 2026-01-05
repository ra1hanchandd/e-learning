<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Learning Bootcamp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            --secondary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f8fafc;
        }
        
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .auth-left {
            flex: 1;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        
        .auth-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        }
        
        .auth-brand {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            max-width: 480px;
        }
        
        .auth-brand .brand-icon {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 32px;
            backdrop-filter: blur(10px);
        }
        
        .auth-brand h1 { font-size: 3rem; font-weight: 800; margin-bottom: 16px; }
        .auth-brand p { font-size: 1.2rem; opacity: 0.9; line-height: 1.7; }
        
        .steps {
            margin-top: 48px;
            text-align: left;
        }
        
        .step {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .step-text h5 { margin: 0 0 4px; font-weight: 600; }
        .step-text p { margin: 0; opacity: 0.8; font-size: 0.9rem; }
        
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            background: white;
            overflow-y: auto;
        }
        
        .auth-form-wrapper { width: 100%; max-width: 440px; }
        
        .auth-form-wrapper h2 { font-weight: 800; font-size: 2rem; margin-bottom: 8px; color: #1e293b; }
        .auth-form-wrapper .subtitle { color: #64748b; margin-bottom: 32px; }
        
        .form-floating { margin-bottom: 16px; }
        
        .form-floating .form-control, .form-floating .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 16px;
            height: auto;
            font-size: 1rem;
            transition: all 0.2s;
        }
        
        .form-floating .form-control:focus, .form-floating .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        
        .form-floating label { padding: 20px 16px; color: #64748b; }
        
        .btn-register {
            width: 100%;
            padding: 16px;
            font-size: 1rem;
            font-weight: 700;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 32px;
            color: #64748b;
        }
        
        .auth-footer a {
            color: #10b981;
            font-weight: 600;
            text-decoration: none;
        }
        
        .auth-footer a:hover { text-decoration: underline; }
        
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        
        .alert-danger { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        
        @media (max-width: 992px) {
            .auth-left { display: none; }
            .auth-right { padding: 32px; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-left">
            <div class="auth-brand">
                <div class="brand-icon">🎓</div>
                <h1>Bergabung Sekarang</h1>
                <p>Mulai perjalanan belajar Anda bersama ribuan peserta lainnya di platform bootcamp terbaik.</p>
                
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            <h5>Daftar Akun</h5>
                            <p>Buat akun gratis dalam hitungan detik</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            <h5>Pilih Bootcamp</h5>
                            <p>Pilih program yang sesuai dengan minat Anda</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            <h5>Mulai Belajar</h5>
                            <p>Akses materi dan mulai kembangkan skill</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-form-wrapper">
                <h2>Buat Akun Baru 🚀</h2>
                <p class="subtitle">Isi form di bawah untuk mendaftar</p>
                
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>
                
                <?= form_open('auth/register') ?>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>" required>
                        <label for="name"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" required>
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" value="<?= set_value('no_hp') ?>" required>
                        <label for="no_hp"><i class="bi bi-phone me-2"></i>Nomor HP</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required>
                        <label for="confirm_password"><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password</label>
                    </div>
                    
                    <button type="submit" class="btn btn-register mt-3">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </button>
                <?= form_close() ?>
                
                <div class="auth-footer">
                    <p>Sudah punya akun? <a href="<?= site_url('auth/login') ?>">Masuk disini</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
