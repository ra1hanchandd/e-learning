<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-check me-2"></i> Laporan Absensi</span>
        <div class="btn-group">
            <a href="<?= site_url('admin/report/export/absensi') ?>" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel me-1"></i> Excel
            </a>
            <a href="<?= site_url('admin/report/export_pdf/absensi') ?>" class="btn btn-danger btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i> PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Peserta</th>
                        <th>Bootcamp</th>
                        <th>Batch</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($absensi_list)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($absensi_list as $a): ?>
                            <?php 
                                $badge = '';
                                switch ($a->status_hadir) {
                                    case 'hadir': $badge = '<span class="badge bg-success">Hadir</span>'; break;
                                    case 'izin': $badge = '<span class="badge bg-warning">Izin</span>'; break;
                                    case 'alpha': $badge = '<span class="badge bg-danger">Alpha</span>'; break;
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($a->peserta_nama) ?></td>
                                <td><?= htmlspecialchars($a->bootcamp_nama) ?></td>
                                <td><?= htmlspecialchars($a->nama_batch) ?></td>
                                <td><?= date('d M Y', strtotime($a->tanggal)) ?></td>
                                <td><?= $badge ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="<?= site_url('admin/report') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>
