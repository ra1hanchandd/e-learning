<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book me-2"></i> Data Bootcamp</span>
        <a href="<?= site_url('admin/bootcamp/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Bootcamp
        </a>
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari bootcamp..." value="<?= $search ?>">
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
                        <th>Nama Bootcamp</th>
                        <th>Mentor</th>
                        <th>Harga</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bootcamps)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($bootcamps as $bootcamp): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($bootcamp->nama) ?></strong>
                                    <?php if ($bootcamp->deskripsi): ?>
                                        <br><small class="text-muted"><?= character_limiter($bootcamp->deskripsi, 50) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($bootcamp->mentor_nama) ?></td>
                                <td>Rp <?= number_format($bootcamp->harga, 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= site_url('admin/bootcamp/edit/' . $bootcamp->id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('admin/bootcamp/delete/' . $bootcamp->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus bootcamp ini?')">
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
                            <a class="page-link" href="<?= site_url('admin/bootcamp?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
