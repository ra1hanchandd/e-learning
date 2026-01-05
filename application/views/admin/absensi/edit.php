<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil-square me-2"></i> Edit Absensi
    </div>
    <div class="card-body">
        <!-- Info Card -->
        <div class="alert alert-info mb-4">
            <div class="row">
                <div class="col-md-6">
                    <strong>Peserta:</strong> <?= htmlspecialchars($info->peserta_nama) ?><br>
                    <strong>Bootcamp:</strong> <?= htmlspecialchars($info->bootcamp_nama) ?> - <?= htmlspecialchars($info->nama_batch) ?>
                </div>
                <div class="col-md-6">
                    <strong>Tanggal:</strong> <?= date('d M Y', strtotime($absensi->tanggal)) ?> (<?= date('l', strtotime($absensi->tanggal)) ?>)<br>
                    <strong>Status Saat Ini:</strong> 
                    <?php
                        $badge_class = 'bg-secondary';
                        if ($absensi->status_hadir == 'hadir') $badge_class = 'bg-success';
                        elseif ($absensi->status_hadir == 'izin') $badge_class = 'bg-warning text-dark';
                        elseif ($absensi->status_hadir == 'alpha') $badge_class = 'bg-danger';
                    ?>
                    <span class="badge <?= $badge_class ?>"><?= ucfirst($absensi->status_hadir) ?></span>
                </div>
            </div>
        </div>

        <?= form_open('admin/absensi/update/' . $absensi->id) ?>
            <div class="mb-4">
                <label class="form-label">Ubah Status Kehadiran:</label>
                <div class="d-flex gap-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_hadir" id="hadir" value="hadir" 
                               <?= $absensi->status_hadir == 'hadir' ? 'checked' : '' ?>>
                        <label class="form-check-label text-success fw-bold" for="hadir">
                            <i class="bi bi-check-circle me-1"></i> Hadir
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_hadir" id="izin" value="izin"
                               <?= $absensi->status_hadir == 'izin' ? 'checked' : '' ?>>
                        <label class="form-check-label text-warning fw-bold" for="izin">
                            <i class="bi bi-exclamation-circle me-1"></i> Izin
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_hadir" id="alpha" value="alpha"
                               <?= $absensi->status_hadir == 'alpha' ? 'checked' : '' ?>>
                        <label class="form-check-label text-danger fw-bold" for="alpha">
                            <i class="bi bi-x-circle me-1"></i> Alpha
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
                <a href="<?= site_url('admin/absensi/history/' . $info->batch_id) ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
                <a href="<?= site_url('admin/absensi/delete/' . $absensi->id) ?>" 
                   class="btn btn-outline-danger ms-auto"
                   onclick="return confirm('Hapus data absensi ini?')">
                    <i class="bi bi-trash me-1"></i> Hapus
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>
