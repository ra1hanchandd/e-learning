<div class="row">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-journal-text me-2"></i> Detail Tugas
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($tugas->judul) ?></h5>
                <p class="text-muted mb-3">
                    <i class="bi bi-mortarboard me-1"></i> <?= htmlspecialchars($tugas->bootcamp_nama) ?> - <?= htmlspecialchars($tugas->nama_batch) ?>
                </p>
                
                <div class="mb-3">
                    <strong>Deskripsi:</strong>
                    <p><?= $tugas->deskripsi ? nl2br(htmlspecialchars($tugas->deskripsi)) : '<em class="text-muted">Tidak ada deskripsi</em>' ?></p>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong><i class="bi bi-calendar-event me-1"></i> Deadline:</strong>
                        <?php 
                            $today = date('Y-m-d');
                            $is_late = ($today > $tugas->deadline);
                        ?>
                        <p class="<?= $is_late ? 'text-danger' : '' ?>">
                            <?= date('d M Y', strtotime($tugas->deadline)) ?>
                            <?= $is_late ? ' (Sudah Lewat)' : '' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($submission): ?>
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-check-circle me-2"></i> Sudah Dikumpulkan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Waktu Pengumpulan:</strong>
                            <p><?= date('d M Y H:i', strtotime($submission->created_at)) ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>File:</strong>
                            <p>
                                <a href="<?= base_url($submission->file_path) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-download me-1"></i> Download File
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <?php if ($submission->nilai !== null): ?>
                        <div class="alert alert-success">
                            <strong><i class="bi bi-star-fill me-1"></i> Nilai:</strong> 
                            <span class="fs-4 fw-bold"><?= $submission->nilai ?></span>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="bi bi-hourglass-split me-1"></i> Menunggu penilaian dari mentor
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!$is_late): ?>
                        <hr>
                        <p class="text-muted mb-2">Ingin mengupload ulang?</p>
                        <a href="<?= site_url('user/tugas/upload/' . $tugas->id) ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-upload me-1"></i> Upload Ulang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="card mb-3">
                <div class="card-header bg-warning text-dark">
                    <i class="bi bi-upload me-2"></i> Upload Tugas
                </div>
                <div class="card-body">
                    <?php if ($is_late): ?>
                        <div class="alert alert-danger mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i> 
                            Deadline sudah lewat. Anda tidak dapat mengumpulkan tugas ini.
                        </div>
                    <?php else: ?>
                        <p>Anda belum mengumpulkan tugas ini.</p>
                        <a href="<?= site_url('user/tugas/upload/' . $tugas->id) ?>" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i> Upload Tugas Sekarang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i> Informasi
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td>Status</td>
                        <td>
                            <?php if ($submission): ?>
                                <?php if ($submission->nilai !== null): ?>
                                    <span class="badge bg-success">Dinilai</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Dikumpulkan</span>
                                <?php endif; ?>
                            <?php elseif ($is_late): ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Belum</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Deadline</td>
                        <td><?= date('d M Y', strtotime($tugas->deadline)) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="mt-3">
            <a href="<?= site_url('user/tugas') ?>" class="btn btn-secondary w-100">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Tugas
            </a>
        </div>
    </div>
</div>
