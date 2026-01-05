<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-calendar-check me-2"></i> 
            Input Absensi: <?= htmlspecialchars($batch->bootcamp_nama) ?> - <?= htmlspecialchars($batch->nama_batch) ?>
        </span>
        <a href="<?= site_url('admin/absensi/history/' . $batch->id) ?>" class="btn btn-outline-info btn-sm">
            <i class="bi bi-clock-history me-1"></i> Lihat Riwayat
        </a>
    </div>
    <div class="card-body">
        <!-- Date Selector -->
        <div class="row mb-4">
            <div class="col-md-3">
                <form method="GET">
                    <label class="form-label">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>" onchange="this.form.submit()">
                </form>
            </div>
            <div class="col-md-9 d-flex align-items-end">
                <a href="<?= site_url('admin/absensi/auto-alpha/' . $batch->id . '?tanggal=' . $tanggal) ?>" 
                   class="btn btn-outline-danger btn-sm"
                   onclick="return confirm('Tandai semua peserta yang belum diabsen sebagai ALPHA untuk tanggal <?= $tanggal ?>?')">
                    <i class="bi bi-exclamation-triangle me-1"></i> Auto Alpha (Yg Belum Diabsen)
                </a>
            </div>
        </div>

        <?php if (empty($pendaftaran_list)): ?>
            <div class="alert alert-info">Belum ada peserta yang terdaftar di batch ini.</div>
        <?php else: ?>
            <?= form_open('admin/absensi/store') ?>
                <input type="hidden" name="batch_id" value="<?= $batch->id ?>">
                <input type="hidden" name="tanggal" value="<?= $tanggal ?>">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th width="300">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pendaftaran_list as $p): ?>
                                <?php $current_status = isset($absensi_data[$p->id]) ? $absensi_data[$p->id] : 'hadir'; ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= htmlspecialchars($p->peserta_nama) ?></strong></td>
                                    <td><?= htmlspecialchars($p->email) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="absensi[<?= $p->id ?>]" id="hadir_<?= $p->id ?>" value="hadir" <?= $current_status == 'hadir' ? 'checked' : '' ?>>
                                            <label class="btn btn-outline-success btn-sm" for="hadir_<?= $p->id ?>">Hadir</label>

                                            <input type="radio" class="btn-check" name="absensi[<?= $p->id ?>]" id="izin_<?= $p->id ?>" value="izin" <?= $current_status == 'izin' ? 'checked' : '' ?>>
                                            <label class="btn btn-outline-warning btn-sm" for="izin_<?= $p->id ?>">Izin</label>

                                            <input type="radio" class="btn-check" name="absensi[<?= $p->id ?>]" id="alpha_<?= $p->id ?>" value="alpha" <?= $current_status == 'alpha' ? 'checked' : '' ?>>
                                            <label class="btn btn-outline-danger btn-sm" for="alpha_<?= $p->id ?>">Alpha</label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Absensi
                    </button>
                    <a href="<?= site_url('admin/absensi') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
</div>
