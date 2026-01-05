<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-upload me-2"></i> Upload Tugas: <?= htmlspecialchars($tugas->judul) ?>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <strong><i class="bi bi-info-circle me-1"></i> Informasi Tugas:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Bootcamp: <?= htmlspecialchars($tugas->bootcamp_nama) ?> - <?= htmlspecialchars($tugas->nama_batch) ?></li>
                        <li>Deadline: <?= date('d M Y', strtotime($tugas->deadline)) ?></li>
                        <li>Format file: PDF, DOC, DOCX, ZIP, RAR, JPG, JPEG, PNG</li>
                        <li>Maksimal ukuran file: 10 MB</li>
                    </ul>
                </div>
                
                <?php if ($submission): ?>
                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        <strong>Perhatian:</strong> Anda sudah pernah mengumpulkan tugas ini. 
                        Upload ulang akan mengganti file sebelumnya dan nilai akan direset.
                    </div>
                <?php endif; ?>
                
                <?= form_open_multipart('user/tugas/submit') ?>
                    <input type="hidden" name="tugas_id" value="<?= $tugas->id ?>">
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File Tugas <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i> Upload
                        </button>
                        <a href="<?= site_url('user/tugas/detail/' . $tugas->id) ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
