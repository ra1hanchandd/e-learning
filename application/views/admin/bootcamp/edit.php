<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil me-2"></i> Edit Bootcamp
    </div>
    <div class="card-body">
        <?= form_open('admin/bootcamp/update/' . $bootcamp->id) ?>
            <div class="mb-3">
                <label class="form-label">Nama Bootcamp <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $bootcamp->nama) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= set_value('deskripsi', $bootcamp->deskripsi) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="harga" class="form-control" value="<?= set_value('harga', $bootcamp->harga) ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mentor <span class="text-danger">*</span></label>
                <select name="mentor_id" class="form-select" required>
                    <option value="">-- Pilih Mentor --</option>
                    <?php foreach ($mentors as $id => $nama): ?>
                        <option value="<?= $id ?>" <?= $id == $bootcamp->mentor_id ? 'selected' : '' ?>><?= htmlspecialchars($nama) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="<?= site_url('admin/bootcamp') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>
