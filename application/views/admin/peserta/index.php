<div class="card">
    <div class="card-header">
        <i class="bi bi-people me-2"></i> Data Peserta
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari peserta..." value="<?= $search ?>">
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
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Terdaftar</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($peserta_list)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($peserta_list as $peserta): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($peserta->name) ?></strong></td>
                                <td><?= htmlspecialchars($peserta->email) ?></td>
                                <td><?= htmlspecialchars($peserta->no_hp) ?></td>
                                <td><?= date('d M Y', strtotime($peserta->created_at)) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/peserta/detail/' . $peserta->id) ?>" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Detail
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
                            <a class="page-link" href="<?= site_url('admin/peserta?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
