<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book me-2"></i> Detail Bootcamp
            </div>
            <div class="card-body">
                <h4><?= htmlspecialchars($batch->bootcamp_nama) ?></h4>
                <h6 class="text-muted"><?= htmlspecialchars($batch->nama_batch) ?></h6>
                
                <hr>

                <table class="table table-borderless">
                    <tr>
                        <td width="150"><i class="bi bi-person-badge me-2"></i> Mentor</td>
                        <td><strong><?= htmlspecialchars($batch->mentor_nama) ?></strong></td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-calendar me-2"></i> Tanggal Mulai</td>
                        <td><?= date('d M Y', strtotime($batch->tanggal_mulai)) ?></td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-calendar-check me-2"></i> Tanggal Selesai</td>
                        <td><?= date('d M Y', strtotime($batch->tanggal_selesai)) ?></td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-cash me-2"></i> Harga</td>
                        <td><strong class="text-primary">Rp <?= number_format($batch->harga, 0, ',', '.') ?></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clipboard-check me-2"></i> Pendaftaran
            </div>
            <div class="card-body text-center">
                <?php if ($is_registered): ?>
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 text-success">Anda Sudah Terdaftar!</h5>
                    <p class="text-muted">Anda telah terdaftar di batch ini.</p>
                    <a href="<?= site_url('user/pendaftaran') ?>" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-1"></i> Lihat Pendaftaran
                    </a>
                <?php else: ?>
                    <i class="bi bi-book text-primary" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Daftar Sekarang!</h5>
                    <p class="text-muted">Daftar untuk mengikuti bootcamp ini.</p>
                    <a href="<?= site_url('user/daftar/' . $batch->id) ?>" class="btn btn-primary btn-lg w-100" onclick="return confirm('Yakin ingin mendaftar ke bootcamp ini?')">
                        <i class="bi bi-check-circle me-1"></i> Daftar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="<?= site_url('user/bootcamp') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>
