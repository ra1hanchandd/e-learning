<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">🚀 Daftar Bootcamp Tersedia</h4>
        <p class="text-muted mb-0">Pilih bootcamp yang sesuai dengan minat Anda</p>
    </div>
</div>

<?php if (empty($batches)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 16px;">📚</div>
            <h5>Tidak Ada Bootcamp Tersedia</h5>
            <p class="text-muted">Belum ada bootcamp yang tersedia saat ini. Silakan cek kembali nanti.</p>
        </div>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($batches as $batch): ?>
            <?php $is_registered = in_array($batch->id, $registered); ?>
            <div class="col-md-6 col-lg-4">
                <div class="bootcamp-card h-100 <?= $is_registered ? 'border-success' : '' ?>" style="<?= $is_registered ? 'border: 2px solid #10b981 !important;' : '' ?>">
                    <div class="bootcamp-icon" style="<?= $is_registered ? 'background: var(--success-gradient);' : '' ?>">
                        <i class="bi bi-<?= $is_registered ? 'check-lg' : 'laptop' ?>"></i>
                    </div>
                    <h5 class="mb-2"><?= htmlspecialchars($batch->bootcamp_nama) ?></h5>
                    <span class="badge bg-primary mb-3"><?= htmlspecialchars($batch->nama_batch) ?></span>
                    
                    <div class="d-flex align-items-center mb-2 text-muted">
                        <i class="bi bi-calendar3 me-2"></i>
                        <small><?= date('d M', strtotime($batch->tanggal_mulai)) ?> - <?= date('d M Y', strtotime($batch->tanggal_selesai)) ?></small>
                    </div>
                    
                    <div class="mb-3">
                        <span style="font-size: 1.25rem; font-weight: 700; color: var(--accent-color);">
                            Rp <?= number_format($batch->harga, 0, ',', '.') ?>
                        </span>
                    </div>
                    
                    <?php if ($is_registered): ?>
                        <button class="btn btn-success w-100" disabled>
                            <i class="bi bi-check-circle me-1"></i> Sudah Terdaftar
                        </button>
                    <?php else: ?>
                        <a href="<?= site_url('user/bootcamp/detail/' . $batch->id) ?>" class="btn btn-primary w-100">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
