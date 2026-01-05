<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clipboard-check me-2"></i> Laporan Pendaftaran</span>
        <div class="btn-group">
            <a href="<?= site_url('admin/report/export/pendaftaran') ?>" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel me-1"></i> Excel
            </a>
            <a href="<?= site_url('admin/report/export_pdf/pendaftaran') ?>" class="btn btn-danger btn-sm">
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
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Bootcamp</th>
                        <th>Batch</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftaran_list)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($pendaftaran_list as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($p->peserta_nama) ?></td>
                                <td><?= htmlspecialchars($p->email) ?></td>
                                <td><?= htmlspecialchars($p->no_hp) ?></td>
                                <td><?= htmlspecialchars($p->bootcamp_nama) ?></td>
                                <td><?= htmlspecialchars($p->nama_batch) ?></td>
                                <td><?= date('d M Y', strtotime($p->tanggal_daftar)) ?></td>
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
