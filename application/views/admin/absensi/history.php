<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-clock-history me-2"></i> 
            Riwayat Absensi: <?= htmlspecialchars($batch->bootcamp_nama) ?> - <?= htmlspecialchars($batch->nama_batch) ?>
        </span>
        <a href="<?= site_url('admin/absensi/batch/' . $batch->id) ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Input Absensi Baru
        </a>
    </div>
    <div class="card-body">
        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3 class="text-success mb-0"><?= $summary['hadir'] ?></h3>
                        <small class="text-muted">Total Hadir</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3 class="text-warning mb-0"><?= $summary['izin'] ?></h3>
                        <small class="text-muted">Total Izin</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3 class="text-danger mb-0"><?= $summary['alpha'] ?></h3>
                        <small class="text-muted">Total Alpha</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3 class="text-primary mb-0"><?= $summary['total'] ?></h3>
                        <small class="text-muted">Total Record</small>
                    </div>
                </div>
            </div>
        </div>

        <?php if (empty($matrix['dates'])): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Belum ada data absensi untuk batch ini.
                <a href="<?= site_url('admin/absensi/batch/' . $batch->id) ?>" class="alert-link">Input absensi sekarang</a>
            </div>
        <?php else: ?>
            <!-- Attendance Matrix Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="sticky-col" style="min-width: 200px;">Nama Peserta</th>
                            <?php foreach ($matrix['dates'] as $date): ?>
                                <th class="text-center" style="min-width: 100px;">
                                    <?= date('d M', strtotime($date->tanggal)) ?><br>
                                    <small><?= date('D', strtotime($date->tanggal)) ?></small>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($matrix['students'] as $pendaftaran_id => $student): ?>
                            <tr>
                                <td class="sticky-col">
                                    <strong><?= htmlspecialchars($student['peserta_nama']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($student['email']) ?></small>
                                </td>
                                <?php foreach ($matrix['dates'] as $date): ?>
                                    <?php $att = $student['dates'][$date->tanggal]; ?>
                                    <td class="text-center">
                                        <?php if ($att === null): ?>
                                            <span class="badge bg-secondary">-</span>
                                        <?php else: ?>
                                            <?php
                                                $badge_class = 'bg-secondary';
                                                $icon = 'question';
                                                if ($att['status'] == 'hadir') {
                                                    $badge_class = 'bg-success';
                                                    $icon = 'check-circle';
                                                } elseif ($att['status'] == 'izin') {
                                                    $badge_class = 'bg-warning text-dark';
                                                    $icon = 'exclamation-circle';
                                                } elseif ($att['status'] == 'alpha') {
                                                    $badge_class = 'bg-danger';
                                                    $icon = 'x-circle';
                                                }
                                            ?>
                                            <a href="<?= site_url('admin/absensi/edit/' . $att['id']) ?>" 
                                               class="badge <?= $badge_class ?> text-decoration-none" 
                                               title="Klik untuk edit">
                                                <i class="bi bi-<?= $icon ?>"></i>
                                                <?= ucfirst($att['status']) ?>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Klik pada status absensi untuk mengedit. 
                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Hadir</span>
                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle"></i> Izin</span>
                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Alpha</span>
                    <span class="badge bg-secondary">- Belum Diabsen</span>
                </small>
            </div>
        <?php endif; ?>

        <hr>
        <a href="<?= site_url('admin/absensi') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Batch
        </a>
    </div>
</div>

<style>
.sticky-col {
    position: sticky;
    left: 0;
    background: white;
    z-index: 1;
}
thead .sticky-col {
    background: #212529;
    z-index: 2;
}
</style>
