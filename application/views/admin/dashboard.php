<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: var(--primary-gradient); color: white;">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2">Selamat Datang, <?= $this->session->userdata('name') ?>! 👋</h3>
                        <p class="mb-0 opacity-75">Kelola platform e-learning bootcamp dengan mudah. Pantau perkembangan peserta dan kelola semua kegiatan dari dashboard ini.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <div style="font-size: 5rem;">📊</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-primary">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-mortarboard-fill"></i></div>
            </div>
            <div class="stat-value"><?= isset($total_bootcamp) ? $total_bootcamp : 0 ?></div>
            <div class="stat-label">Total Bootcamp</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="stat-value"><?= isset($total_peserta) ? $total_peserta : 0 ?></div>
            <div class="stat-label">Total Peserta</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-warning">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-person-workspace"></i></div>
            </div>
            <div class="stat-value"><?= isset($total_mentor) ? $total_mentor : 0 ?></div>
            <div class="stat-label">Total Mentor</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-info">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-calendar3"></i></div>
            </div>
            <div class="stat-value"><?= isset($total_batch) ? $total_batch : 0 ?></div>
            <div class="stat-label">Total Batch</div>
        </div>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <span><i class="bi bi-lightning-fill me-2 text-warning"></i>Quick Actions</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="<?= site_url('admin/bootcamp/create') ?>" class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center">
                            <i class="bi bi-plus-circle-fill fs-4 mb-2"></i>
                            <span>Tambah Bootcamp</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('admin/mentor/create') ?>" class="btn btn-outline-success w-100 py-3 d-flex flex-column align-items-center">
                            <i class="bi bi-person-plus-fill fs-4 mb-2"></i>
                            <span>Tambah Mentor</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('admin/batch/create') ?>" class="btn btn-outline-warning w-100 py-3 d-flex flex-column align-items-center">
                            <i class="bi bi-calendar-plus-fill fs-4 mb-2"></i>
                            <span>Tambah Batch</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= site_url('admin/pendaftaran') ?>" class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center">
                            <i class="bi bi-clipboard2-check-fill fs-4 mb-2"></i>
                            <span>Kelola Pendaftaran</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Statistik Hari Ini</span>
                <span class="badge bg-primary"><?= date('d M Y') ?></span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center p-3 rounded" style="background: rgba(99, 102, 241, 0.1);">
                            <div class="me-3" style="width: 48px; height: 48px; background: var(--primary-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-clipboard-check text-white fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Total Pendaftaran</small>
                                <h5 class="mb-0"><?= isset($total_pendaftaran) ? $total_pendaftaran : 0 ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center p-3 rounded" style="background: rgba(16, 185, 129, 0.1);">
                            <div class="me-3" style="width: 48px; height: 48px; background: var(--success-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-file-earmark-check text-white fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Tugas Belum Dinilai</small>
                                <h5 class="mb-0"><?= isset($tugas_belum_dinilai) ? $tugas_belum_dinilai : 0 ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center p-3 rounded" style="background: rgba(6, 182, 212, 0.1);">
                            <div class="me-3" style="width: 48px; height: 48px; background: var(--info-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-check text-white fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Batch Aktif</small>
                                <h5 class="mb-0"><?= isset($total_batch) ? $total_batch : 0 ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
