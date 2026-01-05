<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">📝 Tugas Saya</h4>
        <p class="text-muted mb-0">Kelola dan kumpulkan tugas bootcamp Anda</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($tugas_list)): ?>
            <div class="text-center py-5">
                <div style="font-size: 4rem; margin-bottom: 16px;">✅</div>
                <h5>Tidak Ada Tugas</h5>
                <p class="text-muted">Belum ada tugas untuk bootcamp yang Anda ikuti</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Tugas</th>
                            <th>Bootcamp</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tugas_list as $t): ?>
                            <?php
                                $today = date('Y-m-d');
                                $is_late = ($today > $t->deadline);
                                
                                if ($t->submission_id) {
                                    if ($t->nilai !== null) {
                                        $status = '<span class="badge" style="background: var(--success-gradient);">Dinilai: ' . $t->nilai . '</span>';
                                    } else {
                                        $status = '<span class="badge" style="background: var(--info-gradient);">Sudah Dikumpulkan</span>';
                                    }
                                } elseif ($is_late) {
                                    $status = '<span class="badge" style="background: var(--danger-gradient);">Terlambat</span>';
                                } else {
                                    $status = '<span class="badge" style="background: var(--warning-gradient);">Belum Dikumpulkan</span>';
                                }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($t->judul) ?></strong></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($t->bootcamp_nama) ?></span></td>
                                <td>
                                    <?php if ($is_late && !$t->submission_id): ?>
                                        <span class="text-danger fw-bold"><i class="bi bi-exclamation-circle me-1"></i><?= date('d M Y', strtotime($t->deadline)) ?></span>
                                    <?php else: ?>
                                        <i class="bi bi-calendar3 me-1 text-muted"></i><?= date('d M Y', strtotime($t->deadline)) ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $status ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('user/tugas/detail/' . $t->id) ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
