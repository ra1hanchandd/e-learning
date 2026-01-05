<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">📅 Riwayat Absensi</h4>
        <p class="text-muted mb-0">Pantau kehadiran Anda di setiap sesi bootcamp</p>
    </div>
</div>

<?php if (empty($absensi_list)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div style="font-size: 4rem; margin-bottom: 16px;">📋</div>
            <h5>Belum Ada Data Absensi</h5>
            <p class="text-muted">Data absensi akan muncul setelah Anda mengikuti sesi bootcamp</p>
        </div>
    </div>
<?php else: ?>
    <?php
        $hadir = 0; $izin = 0; $alpha = 0;
        foreach ($absensi_list as $a) {
            switch($a->status_hadir) {
                case 'hadir': $hadir++; break;
                case 'izin': $izin++; break;
                case 'alpha': $alpha++; break;
            }
        }
        $total = count($absensi_list);
        $persentase = $total > 0 ? round(($hadir / $total) * 100) : 0;
    ?>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-success">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
                </div>
                <div class="stat-value"><?= $hadir ?></div>
                <div class="stat-label">Hadir</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-warning">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-envelope-fill"></i></div>
                </div>
                <div class="stat-value"><?= $izin ?></div>
                <div class="stat-label">Izin</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-danger">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-x-circle-fill"></i></div>
                </div>
                <div class="stat-value"><?= $alpha ?></div>
                <div class="stat-label">Alpha</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-info">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
                <div class="stat-value"><?= $persentase ?>%</div>
                <div class="stat-label">Kehadiran</div>
            </div>
        </div>
    </div>
    
    <!-- Progress Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold">Persentase Kehadiran</span>
                <span class="badge <?= $persentase >= 80 ? 'bg-success' : ($persentase >= 60 ? 'bg-warning' : 'bg-danger') ?>"><?= $persentase ?>%</span>
            </div>
            <div class="progress" style="height: 12px; border-radius: 6px;">
                <div class="progress-bar <?= $persentase >= 80 ? 'bg-success' : ($persentase >= 60 ? 'bg-warning' : 'bg-danger') ?>" 
                     style="width: <?= $persentase ?>%; border-radius: 6px;"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <?php if ($persentase >= 80): ?>
                    <i class="bi bi-emoji-smile me-1"></i> Kehadiran Anda sangat baik! Pertahankan!
                <?php elseif ($persentase >= 60): ?>
                    <i class="bi bi-emoji-neutral me-1"></i> Cukup baik, tapi bisa ditingkatkan lagi.
                <?php else: ?>
                    <i class="bi bi-emoji-frown me-1"></i> Kehadiran Anda perlu ditingkatkan.
                <?php endif; ?>
            </small>
        </div>
    </div>
    
    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <span><i class="bi bi-list-ul me-2"></i>Detail Kehadiran</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Tanggal</th>
                            <th>Bootcamp</th>
                            <th>Batch</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($absensi_list as $a): ?>
                            <?php
                                switch($a->status_hadir) {
                                    case 'hadir': 
                                        $badge_style = 'background: var(--success-gradient);'; 
                                        $icon = 'check-circle'; 
                                        break;
                                    case 'izin': 
                                        $badge_style = 'background: var(--warning-gradient);'; 
                                        $icon = 'envelope'; 
                                        break;
                                    case 'alpha': 
                                        $badge_style = 'background: var(--danger-gradient);'; 
                                        $icon = 'x-circle'; 
                                        break;
                                    default: 
                                        $badge_style = 'background: #64748b;'; 
                                        $icon = 'question-circle';
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i><?= date('d M Y', strtotime($a->tanggal)) ?></td>
                                <td><strong><?= htmlspecialchars($a->bootcamp_nama) ?></strong></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($a->nama_batch) ?></span></td>
                                <td><span class="badge" style="<?= $badge_style ?>"><i class="bi bi-<?= $icon ?> me-1"></i><?= ucfirst($a->status_hadir) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
