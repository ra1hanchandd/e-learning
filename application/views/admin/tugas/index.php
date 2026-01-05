<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-file-earmark-text me-2"></i> Data Tugas</span>
        <a href="<?= site_url('admin/tugas/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Tugas
        </a>
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari tugas..." value="<?= $search ?>">
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
                        <th>Judul Tugas</th>
                        <th>Bootcamp / Batch</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tugas_list)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($tugas_list as $tugas): ?>
                            <?php 
                                $today = date('Y-m-d');
                                if ($tugas->deadline < $today) {
                                    $status = '<span class="badge bg-secondary">Berakhir</span>';
                                } else {
                                    $status = '<span class="badge bg-success">Aktif</span>';
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($tugas->judul) ?></strong>
                                    <?php if ($tugas->deskripsi): ?>
                                        <br><small class="text-muted"><?= character_limiter($tugas->deskripsi, 50) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($tugas->bootcamp_nama) ?>
                                    <br><small class="text-muted"><?= htmlspecialchars($tugas->nama_batch) ?></small>
                                </td>
                                <td><?= date('d M Y', strtotime($tugas->deadline)) ?></td>
                                <td><?= $status ?></td>
                                <td>
                                    <a href="<?= site_url('admin/tugas/submissions/' . $tugas->id) ?>" class="btn btn-info btn-sm" title="Lihat Pengumpulan">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= site_url('admin/tugas/edit/' . $tugas->id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('admin/tugas/delete/' . $tugas->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tugas ini?')">
                                        <i class="bi bi-trash"></i>
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
                            <a class="page-link" href="<?= site_url('admin/tugas?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
