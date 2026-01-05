<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: var(--primary-gradient); color: white;">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2">Hai, <?= $this->session->userdata('name') ?>! 👋</h3>
                        <p class="mb-0 opacity-75">Selamat datang di portal pembelajaran. Lanjutkan perjalanan belajar Anda dan raih skill baru!</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <div style="font-size: 5rem;">🚀</div>
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
            <div class="stat-value"><?= isset($bootcamp_diikuti) ? $bootcamp_diikuti : 0 ?></div>
            <div class="stat-label">Bootcamp Diikuti</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
            </div>
            <div class="stat-value"><?= isset($tugas_selesai) ? $tugas_selesai : 0 ?></div>
            <div class="stat-label">Tugas Selesai</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-warning">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-clock-fill"></i></div>
            </div>
            <div class="stat-value"><?= isset($tugas_pending) ? $tugas_pending : 0 ?></div>
            <div class="stat-label">Tugas Pending</div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-info">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bi bi-star-fill"></i></div>
            </div>
            <div class="stat-value"><?= isset($nilai_rata) ? number_format($nilai_rata, 1) : '-' ?></div>
            <div class="stat-label">Nilai Rata-rata</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Bootcamp Saya -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-mortarboard-fill me-2 text-primary"></i>Bootcamp Saya</span>
                <a href="<?= site_url('user/bootcamp_saya') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <?php if (isset($my_bootcamps) && count($my_bootcamps) > 0): ?>
                    <div class="row g-3">
                        <?php foreach (array_slice($my_bootcamps, 0, 4) as $bootcamp): ?>
                            <div class="col-md-6">
                                <div class="bootcamp-card">
                                    <div class="bootcamp-icon">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                    <h5><?= $bootcamp->bootcamp_nama ?></h5>
                                    <p class="mentor mb-2"><i class="bi bi-person me-1"></i><?= $bootcamp->mentor_nama ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success"><?= $bootcamp->nama_batch ?></span>
                                        <a href="<?= site_url('user/tugas') ?>" class="btn btn-sm btn-outline-primary">Lihat Tugas</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <div style="font-size: 4rem; margin-bottom: 16px;">📚</div>
                        <h5>Belum ada bootcamp</h5>
                        <p class="text-muted mb-3">Anda belum terdaftar di bootcamp manapun</p>
                        <a href="<?= site_url('user/daftar_bootcamp') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Daftar Bootcamp
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Tugas Terbaru -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-journal-text me-2 text-warning"></i>Tugas Terbaru</span>
            </div>
            <div class="card-body">
                <?php if (isset($tugas_list) && count($tugas_list) > 0): ?>
                    <?php foreach (array_slice($tugas_list, 0, 5) as $tugas): ?>
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="me-3">
                                <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #10b981;">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0"><?= $tugas->judul ?></h6>
                                <small class="text-muted">Deadline: <?= date('d M Y', strtotime($tugas->deadline)) ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="<?= site_url('user/tugas') ?>" class="btn btn-outline-primary w-100 mt-3">
                        Lihat Semua Tugas
                    </a>
                <?php else: ?>
                    <div class="text-center py-4">
                        <div style="font-size: 3rem; margin-bottom: 12px;">✅</div>
                        <p class="text-muted mb-0">Tidak ada tugas</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
