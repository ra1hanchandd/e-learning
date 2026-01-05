<div class="card">
    <div class="card-header">
        <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-check text-primary" style="font-size: 3rem;"></i>
                        <h5 class="mt-3">Laporan Pendaftaran</h5>
                        <p class="text-muted">Data pendaftaran peserta ke bootcamp</p>
                        <div class="d-grid gap-2">
                            <a href="<?= site_url('admin/report/pendaftaran') ?>" class="btn btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> Lihat
                            </a>
                            <div class="btn-group">
                                <a href="<?= site_url('admin/report/export/pendaftaran') ?>" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-excel me-1"></i> Excel
                                </a>
                                <a href="<?= site_url('admin/report/export_pdf/pendaftaran') ?>" class="btn btn-danger">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check text-success" style="font-size: 3rem;"></i>
                        <h5 class="mt-3">Laporan Absensi</h5>
                        <p class="text-muted">Data kehadiran peserta bootcamp</p>
                        <div class="d-grid gap-2">
                            <a href="<?= site_url('admin/report/absensi') ?>" class="btn btn-outline-success">
                                <i class="bi bi-eye me-1"></i> Lihat
                            </a>
                            <div class="btn-group">
                                <a href="<?= site_url('admin/report/export/absensi') ?>" class="btn btn-success">
                                    <i class="bi bi-file-earmark-excel me-1"></i> Excel
                                </a>
                                <a href="<?= site_url('admin/report/export_pdf/absensi') ?>" class="btn btn-danger">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-award text-warning" style="font-size: 3rem;"></i>
                        <h5 class="mt-3">Laporan Nilai</h5>
                        <p class="text-muted">Data nilai tugas peserta bootcamp</p>
                        <div class="d-grid gap-2">
                            <a href="<?= site_url('admin/report/nilai') ?>" class="btn btn-outline-warning">
                                <i class="bi bi-eye me-1"></i> Lihat
                            </a>
                            <div class="btn-group">
                                <a href="<?= site_url('admin/report/export/nilai') ?>" class="btn btn-warning">
                                    <i class="bi bi-file-earmark-excel me-1"></i> Excel
                                </a>
                                <a href="<?= site_url('admin/report/export_pdf/nilai') ?>" class="btn btn-danger">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
