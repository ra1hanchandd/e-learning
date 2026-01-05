<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-event me-2"></i> Data Batch</span>
        <a href="<?= site_url('admin/batch/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Batch
        </a>
    </div>
    <div class="card-body">
        <!-- Search -->
        <form method="GET" class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari batch..." value="<?= $search ?>">
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
                        <th>Bootcamp</th>
                        <th>Nama Batch</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($batches)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = ($page - 1) * 10 + 1; ?>
                        <?php foreach ($batches as $batch): ?>
                            <?php 
                                $today = date('Y-m-d');
                                if ($batch->tanggal_selesai < $today) {
                                    $status = '<span class="badge bg-secondary">Selesai</span>';
                                } elseif ($batch->tanggal_mulai <= $today) {
                                    $status = '<span class="badge bg-success">Berjalan</span>';
                                } else {
                                    $status = '<span class="badge bg-info">Akan Datang</span>';
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($batch->bootcamp_nama) ?></strong></td>
                                <td><?= htmlspecialchars($batch->nama_batch) ?></td>
                                <td><?= date('d M Y', strtotime($batch->tanggal_mulai)) ?></td>
                                <td><?= date('d M Y', strtotime($batch->tanggal_selesai)) ?></td>
                                <td><?= $status ?></td>
                                <td>
                                    <a href="<?= site_url('admin/batch/edit/' . $batch->id) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('admin/batch/delete/' . $batch->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus batch ini?')">
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
                            <a class="page-link" href="<?= site_url('admin/batch?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
