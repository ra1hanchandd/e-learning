<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-award me-2"></i> Laporan Nilai</span>
        <div class="btn-group">
            <a href="<?= site_url('admin/report/export/nilai') ?>" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel me-1"></i> Excel
            </a>
            <a href="<?= site_url('admin/report/export_pdf/nilai') ?>" class="btn btn-danger btn-sm">
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
                        <th>Tugas</th>
                        <th>Bootcamp</th>
                        <th>Batch</th>
                        <th>Deadline</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($nilai_list)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($nilai_list as $n): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($n->peserta_nama) ?></td>
                                <td><?= htmlspecialchars($n->tugas_judul) ?></td>
                                <td><?= htmlspecialchars($n->bootcamp_nama) ?></td>
                                <td><?= htmlspecialchars($n->nama_batch) ?></td>
                                <td><?= date('d M Y', strtotime($n->deadline)) ?></td>
                                <td>
                                    <?php if ($n->nilai !== null): ?>
                                        <span class="badge bg-<?= $n->nilai >= 70 ? 'success' : ($n->nilai >= 50 ? 'warning' : 'danger') ?>">
                                            <?= $n->nilai ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum dinilai</span>
                                    <?php endif; ?>
                                </td>
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
