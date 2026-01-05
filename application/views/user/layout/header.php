<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - E-Learning Bootcamp</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-gradient: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            --secondary-gradient: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --info-gradient: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
            --dark-bg: #0f172a;
            --dark-surface: #1e293b;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --accent-color: #10b981;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--dark-bg);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 24px;
            background: var(--dark-surface);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .sidebar-brand .brand-icon {
            width: 45px;
            height: 45px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .sidebar-brand .brand-text { color: white; }
        .sidebar-brand .brand-text h5 { margin: 0; font-weight: 700; font-size: 1.1rem; }
        .sidebar-brand .brand-text span { font-size: 0.75rem; color: #94a3b8; }
        
        .sidebar-menu { list-style: none; padding: 16px 12px; margin: 0; }
        
        .menu-label {
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 16px 16px 8px;
            margin-top: 8px;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }
        
        .sidebar-menu li a:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #6ee7b7;
        }
        
        .sidebar-menu li a.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        
        .sidebar-menu li a i { font-size: 1.2rem; width: 24px; text-align: center; }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--bg-light);
        }
        
        .top-navbar {
            background: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .top-navbar .page-title h4 { margin: 0; font-weight: 700; font-size: 1.25rem; }
        
        .navbar-actions { display: flex; align-items: center; gap: 16px; }
        
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--bg-light);
            border-radius: 12px;
        }
        
        .user-dropdown .avatar {
            width: 38px;
            height: 38px;
            background: var(--primary-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-dropdown .user-info .name { font-weight: 600; font-size: 0.9rem; }
        .user-dropdown .user-info .role { font-size: 0.75rem; color: var(--text-secondary); }
        
        .content-wrapper { padding: 32px; }
        
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
            background: white;
            overflow: hidden;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 20px 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-body { padding: 24px; }
        
        .stat-card {
            border-radius: 16px;
            padding: 24px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        }
        
        .stat-card.bg-primary { background: var(--primary-gradient) !important; }
        .stat-card.bg-success { background: var(--success-gradient) !important; }
        .stat-card.bg-warning { background: var(--warning-gradient) !important; }
        .stat-card.bg-info { background: var(--info-gradient) !important; }
        .stat-card.bg-danger { background: var(--danger-gradient) !important; }
        
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
        }
        
        .stat-card .stat-value { font-size: 2rem; font-weight: 800; }
        .stat-card .stat-label { opacity: 0.9; font-weight: 500; }
        
        .btn {
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-success { background: var(--success-gradient); border: none; }
        .btn-warning { background: var(--warning-gradient); border: none; color: white; }
        .btn-danger { background: var(--danger-gradient); border: none; }
        
        .btn-sm { padding: 8px 14px; font-size: 0.8rem; border-radius: 8px; }
        
        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        
        .form-label { font-weight: 600; margin-bottom: 8px; font-size: 0.9rem; }
        
        .badge { font-weight: 600; padding: 6px 12px; border-radius: 8px; }
        
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
        }
        
        .alert-success { background: rgba(16, 185, 129, 0.1); color: #059669; }
        .alert-danger { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        .alert-info { background: rgba(6, 182, 212, 0.1); color: #0891b2; }
        
        .bootcamp-card {
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            background: white;
        }
        
        .bootcamp-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
            border-color: var(--accent-color);
        }
        
        .bootcamp-card .bootcamp-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-gradient);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            margin-bottom: 16px;
        }
        
        .bootcamp-card h5 { font-weight: 700; margin-bottom: 8px; }
        .bootcamp-card .mentor { color: var(--text-secondary); font-size: 0.9rem; }
        
        .task-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .task-item:last-child { border-bottom: none; }
        
        .task-item .task-icon {
            width: 48px;
            height: 48px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            font-size: 1.25rem;
        }
        
        .task-item .task-info { flex: 1; }
        .task-item .task-info h6 { margin: 0 0 4px; font-weight: 600; }
        .task-item .task-info small { color: var(--text-secondary); }
        
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="<?= site_url('user/dashboard') ?>" class="sidebar-brand">
                <div class="brand-icon">🎓</div>
                <div class="brand-text">
                    <h5>EduCamp</h5>
                    <span>Student Portal</span>
                </div>
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="<?= site_url('user/dashboard') ?>" class="<?= uri_string() == 'user/dashboard' || uri_string() == 'user' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            
            <div class="menu-label">Pembelajaran</div>
            <li>
                <a href="<?= site_url('user/bootcamp_saya') ?>" class="<?= strpos(uri_string(), 'user/bootcamp') !== false ? 'active' : '' ?>">
                    <i class="bi bi-mortarboard-fill"></i> Bootcamp Saya
                </a>
            </li>
            <li>
                <a href="<?= site_url('user/tugas') ?>" class="<?= strpos(uri_string(), 'user/tugas') !== false ? 'active' : '' ?>">
                    <i class="bi bi-journal-text"></i> Tugas
                </a>
            </li>
            <li>
                <a href="<?= site_url('user/absensi') ?>" class="<?= strpos(uri_string(), 'user/absensi') !== false ? 'active' : '' ?>">
                    <i class="bi bi-calendar-check-fill"></i> Absensi
                </a>
            </li>
            <li>
                <a href="<?= site_url('user/nilai') ?>" class="<?= strpos(uri_string(), 'user/nilai') !== false ? 'active' : '' ?>">
                    <i class="bi bi-star-fill"></i> Nilai
                </a>
            </li>
            
            <div class="menu-label">Lainnya</div>
            <li>
                <a href="<?= site_url('user/daftar_bootcamp') ?>" class="<?= strpos(uri_string(), 'user/daftar') !== false ? 'active' : '' ?>">
                    <i class="bi bi-plus-circle-fill"></i> Daftar Bootcamp
                </a>
            </li>
            <li>
                <a href="<?= site_url('user/profil') ?>" class="<?= strpos(uri_string(), 'user/profil') !== false ? 'active' : '' ?>">
                    <i class="bi bi-person-fill"></i> Profil
                </a>
            </li>
            
            <div class="menu-label">Account</div>
            <li>
                <a href="<?= site_url('logout') ?>">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-navbar">
            <div class="page-title">
                <h4><?= $title ?></h4>
            </div>
            <div class="navbar-actions">
                <div class="user-dropdown">
                    <div class="avatar">
                        <?= strtoupper(substr($this->session->userdata('name'), 0, 1)) ?>
                    </div>
                    <div class="user-info">
                        <div class="name"><?= $this->session->userdata('name') ?></div>
                        <div class="role">Student</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
