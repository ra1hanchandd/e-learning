<div class="card">
    <div class="card-header">
        <i class="bi bi-calendar-check me-2"></i> Manajemen Absensi
    </div>
    <div class="card-body">
        <p class="text-muted">Pilih batch untuk mengelola absensi:</p>
        
        <?php if (empty($batches)): ?>
            <div class="alert alert-info">Belum ada batch yang tersedia.</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($batches as $batch): ?>
                    <?php 
                        $today = date('Y-m-d');
                        if ($batch->tanggal_selesai < $today) {
                            $badge = '<span class="badge bg-secondary">Selesai</span>';
                            $status = 'selesai';
                        } elseif ($batch->tanggal_mulai <= $today) {
                            $badge = '<span class="badge bg-success">Berjalan</span>';
                            $status = 'berjalan';
                        } else {
                            $badge = '<span class="badge bg-info">Akan Datang</span>';
                            $status = 'akan_datang';
                        }
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 <?= $status == 'berjalan' ? 'border-success' : '' ?>">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <?= htmlspecialchars($batch->bootcamp_nama) ?>
                                    <?= $badge ?>
                                </h6>
                                <p class="card-text">
                                    <strong><?= htmlspecialchars($batch->nama_batch) ?></strong><br>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d M', strtotime($batch->tanggal_mulai)) ?> - <?= date('d M Y', strtotime($batch->tanggal_selesai)) ?>
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-grid gap-2">
                                    <a href="<?= site_url('admin/absensi/batch/' . $batch->id) ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle me-1"></i> Input Absensi
                                    </a>
                                    <a href="<?= site_url('admin/absensi/history/' . $batch->id) ?>" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-clock-history me-1"></i> Lihat Riwayat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
