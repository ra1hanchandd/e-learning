<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
    </div>
    <div class="card-body">
        <?= form_open('admin/tugas/store') ?>
            <div class="mb-3">
                <label class="form-label">Batch <span class="text-danger">*</span></label>
                <select name="batch_id" class="form-select" required>
                    <option value="">-- Pilih Batch --</option>
                    <?php foreach ($batches as $id => $nama): ?>
                        <option value="<?= $id ?>" <?= set_select('batch_id', $id) ?>><?= htmlspecialchars($nama) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Judul Tugas <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control" value="<?= set_value('judul') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"><?= set_value('deskripsi') ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Deadline <span class="text-danger">*</span></label>
                <input type="date" name="deadline" class="form-control" value="<?= set_value('deadline') ?>" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="<?= site_url('admin/tugas') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>
