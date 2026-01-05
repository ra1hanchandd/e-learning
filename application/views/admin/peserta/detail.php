<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-person me-2"></i> Informasi Peserta
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="100">Nama</td>
                        <td><strong><?= htmlspecialchars($peserta->name) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= htmlspecialchars($peserta->email) ?></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td><?= htmlspecialchars($peserta->no_hp) ?></td>
                    </tr>
                    <tr>
                        <td>Terdaftar</td>
                        <td><?= date('d M Y', strtotime($peserta->created_at)) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-graph-up me-2"></i> Ringkasan Nilai
            </div>
            <div class="card-body text-center">
                <?php if ($nilai_summary && $nilai_summary->rata_rata): ?>
                    <h2 class="text-primary"><?= number_format($nilai_summary->rata_rata, 1) ?></h2>
                    <p class="text-muted mb-0">Rata-rata Nilai</p>
                    <hr>
                    <small><?= $nilai_summary->dinilai ?> dari <?= $nilai_summary->total_tugas ?> tugas dinilai</small>
                <?php else: ?>
                    <p class="text-muted mb-0">Belum ada nilai</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clipboard-check me-2"></i> Pendaftaran Bootcamp
            </div>
            <div class="card-body">
                <?php if (empty($pendaftaran)): ?>
                    <p class="text-muted text-center">Belum mendaftar bootcamp apapun</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bootcamp</th>
                                    <th>Batch</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendaftaran as $p): ?>
                                    <?php 
                                        $today = date('Y-m-d');
                                        if ($p->tanggal_selesai < $today) {
                                            $status = '<span class="badge bg-secondary">Selesai</span>';
                                        } elseif ($p->tanggal_mulai <= $today) {
                                            $status = '<span class="badge bg-success">Aktif</span>';
                                        } else {
                                            $status = '<span class="badge bg-info">Menunggu</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($p->bootcamp_nama) ?></strong></td>
                                        <td><?= htmlspecialchars($p->nama_batch) ?></td>
                                        <td><?= date('d M Y', strtotime($p->tanggal_daftar)) ?></td>
                                        <td><?= $status ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="<?= site_url('admin/peserta') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>
