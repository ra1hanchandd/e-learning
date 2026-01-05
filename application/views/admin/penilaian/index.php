<div class="card">
    <div class="card-header">
        <i class="bi bi-award me-2"></i> Penilaian Tugas
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari pengumpulan..." value="<?= $search ?>">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Peserta</th>
                        <th>Tugas</th>
                        <th>Bootcamp / Batch</th>
                        <th>File</th>
                        <th>Nilai</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($submissions)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($submissions as $s): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($s->peserta_nama) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($s->tugas_judul) ?></td>
                                <td>
                                    <small><?= htmlspecialchars($s->bootcamp_nama) ?></small>
                                    <br><small class="text-muted"><?= htmlspecialchars($s->nama_batch) ?></small>
                                </td>
                                <td>
                                    <a href="<?= base_url($s->file_path) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-download"></i>
                                    </a>
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
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= site_url('admin/penilaian?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
