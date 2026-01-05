<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle me-2"></i> Tambah Batch
    </div>
    <div class="card-body">
        <?= form_open('admin/batch/store') ?>
            <div class="mb-3">
                <label class="form-label">Bootcamp <span class="text-danger">*</span></label>
                <select name="bootcamp_id" class="form-select" required>
                    <option value="">-- Pilih Bootcamp --</option>
                    <?php foreach ($bootcamps as $id => $nama): ?>
                        <option value="<?= $id ?>" <?= set_select('bootcamp_id', $id) ?>><?= htmlspecialchars($nama) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Batch <span class="text-danger">*</span></label>
                <input type="text" name="nama_batch" class="form-control" value="<?= set_value('nama_batch') ?>" required>
                <small class="text-muted">Contoh: Batch 1 - Januari 2026</small>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="<?= set_value('tanggal_mulai') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="<?= set_value('tanggal_selesai') ?>" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="<?= site_url('admin/batch') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>
