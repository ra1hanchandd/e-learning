<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">📚 Bootcamp Saya</h4>
        <p class="text-muted mb-0">Daftar bootcamp yang Anda ikuti</p>
    </div>
    <a href="<?= site_url('user/daftar_bootcamp') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Daftar Bootcamp Baru
    </a>
</div>

<?php if (empty($pendaftaran)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 16px;">📚</div>
            <h5>Belum Ada Bootcamp</h5>
            <p class="text-muted mb-3">Anda belum mendaftar di bootcamp manapun</p>
            <a href="<?= site_url('user/daftar_bootcamp') ?>" class="btn btn-primary">
                <i class="bi bi-search me-1"></i> Cari Bootcamp
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($pendaftaran as $p): ?>
            <?php 
                $today = date('Y-m-d');
                if ($p->tanggal_selesai < $today) {
                    $badge = '<span class="badge bg-secondary">Selesai</span>';
                    $status = 'selesai';
                } elseif ($p->tanggal_mulai <= $today) {
                    $badge = '<span class="badge" style="background: var(--success-gradient);">Aktif</span>';
                    $status = 'aktif';
                } else {
                    $badge = '<span class="badge" style="background: var(--info-gradient);">Menunggu</span>';
                    $status = 'menunggu';
                }
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="bootcamp-card h-100" style="<?= $status == 'aktif' ? 'border: 2px solid #10b981;' : '' ?>">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="bootcamp-icon" style="<?= $status == 'aktif' ? 'background: var(--success-gradient);' : ($status == 'selesai' ? 'background: #64748b;' : '') ?>">
                            <i class="bi bi-<?= $status == 'aktif' ? 'play-circle' : ($status == 'selesai' ? 'check-circle' : 'hourglass-split') ?>"></i>
                        </div>
                        <?= $badge ?>
                    </div>
                    <h5 class="mb-2"><?= htmlspecialchars($p->bootcamp_nama) ?></h5>
                    <span class="badge bg-primary mb-3"><?= htmlspecialchars($p->nama_batch) ?></span>
                    
                    <div class="mb-2">
                        <small class="text-muted"><i class="bi bi-person me-1"></i>Mentor</small>
                        <div class="fw-semibold"><?= htmlspecialchars($p->mentor_nama) ?></div>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>Periode</small>
                        <div><?= date('d M', strtotime($p->tanggal_mulai)) ?> - <?= date('d M Y', strtotime($p->tanggal_selesai)) ?></div>
                    </div>
                    
                    <?php if ($status == 'aktif'): ?>
                        <a href="<?= site_url('user/tugas') ?>" class="btn btn-primary w-100">
                            <i class="bi bi-journal-text me-1"></i> Lihat Tugas
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
