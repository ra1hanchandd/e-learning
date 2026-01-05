<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">⭐ Nilai Saya</h4>
        <p class="text-muted mb-0">Lihat perkembangan dan nilai tugas Anda</p>
    </div>
</div>

<?php if (empty($nilai_list)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 16px;">🏆</div>
            <h5>Belum Ada Nilai</h5>
            <p class="text-muted">Nilai akan muncul setelah tugas Anda dinilai oleh mentor</p>
        </div>
    </div>
<?php else: ?>
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card bg-primary">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-file-earmark-check-fill"></i></div>
                </div>
                <div class="stat-value"><?= count($nilai_list) ?></div>
                <div class="stat-label">Total Dikumpulkan</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-success">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-check2-all"></i></div>
                </div>
                <div class="stat-value"><?= $summary && $summary->dinilai ? $summary->dinilai : 0 ?></div>
                <div class="stat-label">Sudah Dinilai</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-info">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-star-fill"></i></div>
                </div>
                <div class="stat-value"><?= $summary && $summary->rata_rata ? number_format($summary->rata_rata, 1) : '-' ?></div>
                <div class="stat-label">Rata-rata Nilai</div>
            </div>
        </div>
    </div>
    
    <?php if ($summary && $summary->rata_rata): ?>
    <!-- Grade Overview -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <?php
                        $avg = $summary->rata_rata;
                        if ($avg >= 85) {
                            $grade = 'A';
                            $grade_color = 'success';
                            $message = 'Luar Biasa!';
                        } elseif ($avg >= 75) {
                            $grade = 'B';
                            $grade_color = 'primary';
                            $message = 'Sangat Baik!';
                        } elseif ($avg >= 65) {
                            $grade = 'C';
                            $grade_color = 'warning';
                            $message = 'Cukup Baik';
                        } elseif ($avg >= 55) {
                            $grade = 'D';
                            $grade_color = 'warning';
                            $message = 'Perlu Ditingkatkan';
                        } else {
                            $grade = 'E';
                            $grade_color = 'danger';
                            $message = 'Butuh Usaha Lebih';
                        }
                    ?>
                    <div style="width: 100px; height: 100px; background: var(--<?= $grade_color ?>-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <span style="font-size: 3rem; font-weight: 800; color: white;"><?= $grade ?></span>
                    </div>
                    <h5 class="mt-3 mb-0 text-<?= $grade_color ?>"><?= $message ?></h5>
                </div>
                <div class="col-md-9">
                    <h6 class="mb-3">Distribusi Nilai</h6>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Progress Nilai</small>
                            <small class="fw-bold"><?= number_format($avg, 1) ?>/100</small>
                        </div>
                        <div class="progress" style="height: 12px; border-radius: 6px;">
                            <div class="progress-bar bg-<?= $grade_color ?>" style="width: <?= $avg ?>%; border-radius: 6px;"></div>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Terus kumpulkan tugas dengan baik untuk meningkatkan nilai rata-rata Anda.
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <span><i class="bi bi-list-ul me-2"></i>Detail Nilai</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Tugas</th>
                            <th>Bootcamp</th>
                            <th>Batch</th>
                            <th>Dikumpulkan</th>
                            <th style="width: 100px;">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($nilai_list as $n): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($n->tugas_judul) ?></strong></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($n->bootcamp_nama) ?></span></td>
                                <td><?= htmlspecialchars($n->nama_batch) ?></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i><?= date('d M Y', strtotime($n->created_at)) ?></td>
                                <td>
                                    <?php if ($n->nilai !== null): ?>
                                        <?php
                                            if ($n->nilai >= 80) {
                                                $badge_style = 'background: var(--success-gradient);';
                                            } elseif ($n->nilai >= 60) {
                                                $badge_style = 'background: var(--warning-gradient);';
                                            } else {
                                                $badge_style = 'background: var(--danger-gradient);';
                                            }
                                        ?>
                                        <span class="badge" style="<?= $badge_style ?> font-size: 1rem; min-width: 50px;"><?= $n->nilai ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pending</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
