<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-award me-2"></i> Beri Nilai
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="120">Peserta</td>
                        <td><strong><?= htmlspecialchars($submission->peserta_nama) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= htmlspecialchars($submission->email) ?></td>
                    </tr>
                    <tr>
                        <td>Tugas</td>
                        <td><?= htmlspecialchars($submission->tugas_judul) ?></td>
                    </tr>
                    <tr>
                        <td>Bootcamp</td>
                        <td><?= htmlspecialchars($submission->bootcamp_nama) ?> - <?= htmlspecialchars($submission->nama_batch) ?></td>
                    </tr>
                    <tr>
                        <td>Deadline</td>
                        <td><?= date('d M Y', strtotime($submission->deadline)) ?></td>
                    </tr>
                    <tr>
                        <td>Dikumpulkan</td>
                        <td>
                            <?= date('d M Y H:i', strtotime($submission->created_at)) ?>
                            <?php if (strtotime($submission->created_at) > strtotime($submission->deadline . ' 23:59:59')): ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php else: ?>
                                <span class="badge bg-success">Tepat Waktu</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>
                            <a href="<?= base_url($submission->file_path) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-download me-1"></i> Download File
                            </a>
                        </td>
                    </tr>
                </table>

                <hr>

                <?= form_open('admin/penilaian/store') ?>
                    <input type="hidden" name="id" value="<?= $submission->id ?>">
                    <div class="mb-3">
                        <label class="form-label">Nilai (0-100) <span class="text-danger">*</span></label>
                        <input type="number" name="nilai" class="form-control form-control-lg" 
                               min="0" max="100" step="0.5"
                               value="<?= $submission->nilai !== null ? $submission->nilai : '' ?>" 
                               required autofocus>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Nilai
                        </button>
                        <a href="<?= site_url('admin/penilaian') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-file-text me-2"></i> Deskripsi Tugas
            </div>
            <div class="card-body">
                <?php if ($submission->tugas_deskripsi): ?>
                    <?= nl2br(htmlspecialchars($submission->tugas_deskripsi)) ?>
                <?php else: ?>
                    <p class="text-muted mb-0"><em>Tidak ada deskripsi</em></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i> Panduan Penilaian
            </div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr>
                        <td><span class="badge bg-success">85-100</span></td>
                        <td>Sangat Baik (A)</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary">70-84</span></td>
                        <td>Baik (B)</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-warning">55-69</span></td>
                        <td>Cukup (C)</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-danger">0-54</span></td>
                        <td>Kurang (D)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
