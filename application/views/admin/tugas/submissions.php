<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-file-earmark-text me-2"></i> Detail Tugas
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <td width="150">Judul</td>
                <td><strong><?= htmlspecialchars($tugas->judul) ?></strong></td>
            </tr>
            <tr>
                <td>Bootcamp</td>
                <td><?= htmlspecialchars($tugas->bootcamp_nama) ?> - <?= htmlspecialchars($tugas->nama_batch) ?></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td><?= date('d M Y', strtotime($tugas->deadline)) ?></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><?= $tugas->deskripsi ? nl2br(htmlspecialchars($tugas->deskripsi)) : '<em class="text-muted">Tidak ada deskripsi</em>' ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-collection me-2"></i> Pengumpulan Tugas (<?= count($submissions) ?> peserta)
    </div>
    <div class="card-body">
        <?php if (empty($submissions)): ?>
            <div class="alert alert-info mb-0">Belum ada yang mengumpulkan tugas ini.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Peserta</th>
                            <th>File</th>
                            <th>Waktu Submit</th>
                            <th>Nilai</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($submissions as $s): ?>
                            <?php 
                                $late = strtotime($s->created_at) > strtotime($tugas->deadline . ' 23:59:59');
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($s->peserta_nama) ?></strong>
                                    <br><small class="text-muted"><?= htmlspecialchars($s->email) ?></small>
                                </td>
                                <td>
                                    <a href="<?= base_url($s->file_path) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-download me-1"></i> Download
                                    </a>
                                </td>
                                <td>
                                    <?= date('d M Y H:i', strtotime($s->created_at)) ?>
                                    <?php if ($late): ?>
                                        <br><span class="badge bg-danger">Terlambat</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($s->nilai !== null): ?>
                                        <span class="badge bg-<?= $s->nilai >= 70 ? 'success' : ($s->nilai >= 50 ? 'warning' : 'danger') ?>" style="font-size: 1rem;">
                                            <?= $s->nilai ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum dinilai</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/penilaian/nilai/' . $s->id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Nilai
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="mt-3">
    <a href="<?= site_url('admin/tugas') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>
