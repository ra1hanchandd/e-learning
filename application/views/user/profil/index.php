<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">👤 Profil Saya</h4>
        <p class="text-muted mb-0">Kelola informasi akun dan keamanan Anda</p>
    </div>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center py-5">
                <div class="avatar mx-auto mb-4" style="width: 100px; height: 100px; background: var(--primary-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: white;">
                    <?= strtoupper(substr($peserta->name, 0, 1)) ?>
                </div>
                <h4 class="mb-1"><?= htmlspecialchars($peserta->name) ?></h4>
                <p class="text-muted mb-3"><?= htmlspecialchars($peserta->email) ?></p>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-primary"><i class="bi bi-person me-1"></i>Student</span>
                </div>
                <hr class="my-4">
                <div class="text-start">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3" style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent-color);">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Nomor HP</small>
                            <span class="fw-semibold"><?= htmlspecialchars($peserta->no_hp) ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent-color);">
                            <i class="bi bi-calendar"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Bergabung Sejak</small>
                            <span class="fw-semibold"><?= date('d M Y', strtotime($peserta->created_at)) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Profile Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-pencil-square me-2"></i>Edit Profil</span>
            </div>
            <div class="card-body">
                <?= form_open('user/profil/update') ?>
                    <div class="mb-4">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="name" 
                                   value="<?= htmlspecialchars($peserta->name) ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" value="<?= htmlspecialchars($peserta->email) ?>" readonly disabled>
                        </div>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Email tidak dapat diubah</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control" name="no_hp" 
                                   value="<?= htmlspecialchars($peserta->no_hp) ?>" required>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="mb-3"><i class="bi bi-shield-lock me-2"></i>Ubah Password</h6>
                    
                    <div class="mb-4">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" 
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Minimal 6 karakter</small>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="<?= site_url('user/dashboard') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
