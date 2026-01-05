<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle me-2"></i> Tambah Mentor
    </div>
    <div class="card-body">
        <?= form_open('admin/mentor/store') ?>
            <div class="mb-3">
                <label class="form-label">Nama Mentor <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keahlian <span class="text-danger">*</span></label>
                <input type="text" name="keahlian" class="form-control" value="<?= set_value('keahlian') ?>" required>
                <small class="text-muted">Contoh: Web Development, PHP, MySQL</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="<?= site_url('admin/mentor') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>
