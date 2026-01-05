<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-badge me-2"></i> Data Mentor</span>
        <a href="<?= site_url('admin/mentor/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mentor
        </a>
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari mentor..." value="<?= $search ?>">
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
                        <th>Nama</th>
                        <th>Keahlian</th>
                        <th>Dibuat</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($mentors)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($mentors as $mentor): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($mentor->nama) ?></strong></td>
                                <td><?= htmlspecialchars($mentor->keahlian) ?></td>
                                <td><?= date('d M Y', strtotime($mentor->created_at)) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/mentor/edit/' . $mentor->id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('admin/mentor/delete/' . $mentor->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus mentor ini?')">
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
                            <a class="page-link" href="<?= site_url('admin/mentor?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
